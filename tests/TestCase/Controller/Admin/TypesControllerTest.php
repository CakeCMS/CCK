<?php
/**
 * CakeCMS CCK
 *
 * This file is part of the of the simple cms based on CakePHP 3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   CCK
 * @license   MIT
 * @copyright MIT License http://www.opensource.org/licenses/mit-license.php
 * @link      https://github.com/CakeCMS/CCK".
 * @author    Sergey Kalistratov <kalistratov.s.m@gmail.com>
 */

namespace Cck\Test\TestCase\Controller\Admin;

use JBZoo\Utils\Arr;
use Cake\Core\Plugin;
use Cake\Utility\Hash;
use Cake\ORM\TableRegistry;
use Cck\Model\Entity\Type;
use Core\TestSuite\IntegrationTestCase;

/**
 * Class TypesControllerTest
 *
 * @package Cck\Test\TestCase\Controller\Admin
 */
class TypesControllerTest extends IntegrationTestCase
{

    public $fixtures = ['plugin.cck.types'];
    protected $_corePlugin   = 'Cck';
    protected $_defaultTable = 'Types';

    public function setUp()
    {
        parent::setUp();
        Plugin::load('Backend');
        $this->_url = $this->_getUrl([
            'prefix'     => 'admin',
            'controller' => 'Types',
            'plugin'     => $this->_corePlugin
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
        Plugin::unload('Backend');
    }

    public function testAddFail()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url  = $this->_getUrl(['action' => 'add']);
        $data = $this->_getData(['slug' => null]);

        $this->post($url, $data);

        $this->assertNoRedirect();
        $this->assertResponseContains(__d('cck', 'The type could not been saved.'));
    }

    public function testAddSuccess()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url  = $this->_getUrl(['action' => 'add']);
        $data = $this->_getData();

        $table = $this->_getTable();
        $beforeCount = $table->find()->count();

        $this->post($url, $data);

        $this->assertRedirect([
            'prefix'     => 'admin',
            'plugin'     => $this->_corePlugin,
            'controller' => 'Types',
            'action'     => 'index'
        ]);

        $afterCount = $this->_controller->Types->find()->count();
        self::assertNotEquals($beforeCount, $afterCount);
    }


    public function testEditFail()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $groupId = 1;
        $url = $this->_getUrl(['action' => 'edit', $groupId]);
        $data = $this->_getData([
            'id'   => $groupId,
            'slug' => null
        ]);

        $this->post($url, $data);

        $this->assertNoRedirect();
        $this->assertResponseContains(__d('cck', 'The type could not been updated.'));
    }

    public function testEditSuccess()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $groupId = 1;
        $url = $this->_getUrl(['action' => 'edit', $groupId]);
        $data = $this->_getData([
            'id'   => $groupId,
            'name' => 'New name'
        ]);

        /** @var Type $entity */
        $entity = $this->_getTable()->get($groupId);
        self::assertSame('Profiles', $entity->get('name'));

        $this->post($url, $data);
        $this->assertRedirect([
            'prefix'     => 'admin',
            'plugin'     => $this->_corePlugin,
            'controller' => 'Types',
            'action'     => 'index'
        ]);

        $entity = $this->_getTable()->get($groupId);
        self::assertSame('New name', $entity->get('name'));
    }

    public function testIndexAction()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url = $this->_getUrl(['action' => 'index']);
        $this->get($url);

        self::assertTrue(Arr::key('page_title', $this->_controller->viewVars));
        self::assertTrue(Arr::key('types', $this->_controller->viewVars));
    }

    /**
     * Get or set default data.
     *
     * @param array $data
     * @return array
     */
    protected function _getData(array $data = [])
    {
        return Hash::merge([
            'name'   => 'Test type',
            'slug'   => 'test-type',
            'params' => [
                'application' => [
                    'order' => [
                        'type' => 'control'
                    ]
                ]
            ],
            'action' => 'save'
        ], $data);
    }
}
