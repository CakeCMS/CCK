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
use Cake\ORM\TableRegistry;
use Cck\Model\Entity\Application;
use Cck\Model\Table\ApplicationsTable;
use Core\TestSuite\IntegrationTestCase;

/**
 * Class ApplicationsControllerTest
 *
 * @package Cck\Test\TestCase\Controller\Admin
 */
class ApplicationsControllerTest extends IntegrationTestCase
{

    public $fixtures       = ['plugin.cck.applications'];
    protected $_corePlugin = 'Cck';

    /**
     * @var array
     */
    protected $_data = [
        'name'      => 'New application',
        'alias'     => 'new-app',
        'template'  => 'default',
        'app_group' => 'catalog',
        'params'    => [
            'application' => [
                'order' => [
                    'type' => 'control'
                ]
            ]
        ],
        'action'    => 'save'
    ];

    public function setUp()
    {
        parent::setUp();
        Plugin::load('Backend');
        $this->_url = $this->_getUrl([
            'prefix'     => 'admin',
            'controller' => 'Applications',
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
        $url = $this->_getUrl(['action' => 'add', 'catalog']);
        $this->_data['alias'] = null;

        $this->post($url, $this->_data);

        $this->assertNoRedirect();
        $this->assertResponseContains(__d('cck', 'The application could not been saved.'));
    }

    public function testAddNoFoundGroups()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url = $this->_getUrl(['action' => 'add']);

        $this->get($url);
        $this->assertRedirect([
            'prefix'     => 'admin',
            'plugin'     => $this->_corePlugin,
            'controller' => 'Applications',
            'action'     => 'newApp'
        ]);
        $this->assertResponseSuccess();

        $this->post($url, ['test']);
        $this->assertRedirect([
            'prefix'     => 'admin',
            'plugin'     => $this->_corePlugin,
            'controller' => 'Applications',
            'action'     => 'newApp'
        ]);
        $this->assertResponseSuccess();
    }

    public function testAddSuccess()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url = $this->_getUrl(['action' => 'add', 'catalog']);

        /** @var ApplicationsTable $table */
        $table = TableRegistry::get($this->_corePlugin . '.Applications');
        $beforeCount = $table->find()->count();

        $this->post($url, $this->_data);

        /** @var \Cake\ORM\Query  $apps */
        $apps = $this->_controller->Applications->find()->count();
        self::assertTrue(($beforeCount !== $apps));

        $this->assertRedirect([
            'prefix'     => 'admin',
            'plugin'     => $this->_corePlugin,
            'controller' => 'Applications',
            'action'     => 'index'
        ]);
    }

    public function testEditFail()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url = $this->_getUrl(['action' => 'edit', 1]);
        $this->_data['alias'] = null;
        $this->post($url, $this->_data);

        $this->assertNoRedirect();
        $this->assertResponseSuccess();
        $this->assertResponseContains(__d('cck', 'The application could not been updated.'));
    }

    public function testEditSuccess()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url = $this->_getUrl(['action' => 'edit', 1]);

        $appId  = 1;
        $table  = TableRegistry::get($this->_corePlugin . '.Applications');
        /** @var Application $entity */
        $entity = $table->get($appId);

        self::assertSame('Profiles', $entity->name);
        self::assertSame('community', $entity->app_group);

        $this->_data['action'] = 'apply';
        $this->post($url, $this->_data);
        $this->assertRedirect([
            'prefix'     => 'admin',
            'plugin'     => $this->_corePlugin,
            'controller' => 'Applications',
            'action'     => 'edit',
            $appId
        ]);

        $entity = $table->get($appId);

        self::assertSame('New application', $entity->name);
        self::assertSame('catalog', $entity->app_group);
    }

    public function testIndexAction()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url = $this->_getUrl(['action' => 'index']);
        $this->get($url);

        $viewVars = $this->_controller->viewVars;

        $this->assertNoRedirect();
        $this->assertResponseSuccess();
        self::assertTrue(Arr::key('page_title', $viewVars));
        self::assertTrue(Arr::key('apps', $viewVars));
    }

    public function testNewAppAction()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $url = $this->_getUrl(['action' => 'newApp']);
        $this->get($url);

        $viewVars = $this->_controller->viewVars;

        $this->assertNoRedirect();
        $this->assertResponseSuccess();
        self::assertTrue(Arr::key('page_title', $viewVars));
        self::assertTrue(Arr::key('apps', $viewVars));
    }
}
