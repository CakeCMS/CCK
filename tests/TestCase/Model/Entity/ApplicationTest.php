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

namespace Cck\Test\TestCase\Model\Entity;

use JBZoo\Utils\FS;
use JBZoo\Utils\Arr;
use Cake\ORM\TableRegistry;
use Core\TestSuite\TestCase;
use Cck\Helper\ApplicationHelper;
use Cck\Model\Entity\Application;
use Cck\Model\Table\ApplicationsTable;

/**
 * Class ApplicationTest
 *
 * @package Cck\Test\TestCase\Model\Entity
 * @property ApplicationsTable $Application
 */
class ApplicationTest extends TestCase
{

    public $fixtures       = ['plugin.cck.applications'];
    protected $_corePlugin = 'Cck';

    public function setUp()
    {
        parent::setUp();
        $this->Application = TableRegistry::get($this->_corePlugin . '.Applications');
    }

    public function testClassName()
    {
        $entity = $this->Application->getEntityClass();
        self::assertSame('Cck\Model\Entity\Application', $entity);
    }

    public function testGetIcon()
    {
        $app = $this->Application->get(1);
        self::assertSame('/webroot/img/cck.png', $app->getIcon());
        self::assertSame('/tests/App/webroot/cck/catalog/application.png', $this->_getApplication()->getIcon());
    }

    public function testGetManifestFile()
    {
        $expected = WWW_ROOT . 'cck/catalog/' . ApplicationHelper::APP_MANIFEST;
        self::assertSame(FS::clean($expected, '/'),  $this->_getApplication()->getManifestFile());
    }

    public function testGetMetaData()
    {
        $app = $this->_getApplication();
        self::assertSame('Test application', $app->getMetaData('name'));
        self::assertSame([], $app->getMetaData('no-exist', []));
    }

    public function testGetParamsForm()
    {
        $app = $this->_getApplication();
        $params = $app->getParamsForm();
        self::assertInstanceOf('JBZoo\Data\Data', $params);
        self::assertSame([
            'order' => [
                'type'    => 'control',
                'default' => '15',
                'title'   => 'Order page'
            ]
        ], $params->get('cog.application'));
    }

    public function testGetPath()
    {
        $expected = WWW_ROOT . 'cck/catalog';
        self::assertSame(FS::clean($expected, '/'), $this->_getApplication()->getPath());
    }

    public function testGetResource()
    {
        self::assertSame('applications:catalog/', $this->_getApplication()->getResource());
    }

    public function testGetTemplates()
    {
        $templates = $this->_getApplication()->getTemplates();
        self::assertTrue(Arr::key('default', $templates));
        self::assertInstanceOf('Cck\Template', $templates['default']);
    }

    public function testGetTemplatesList()
    {
        self::assertSame(['default' => 'default'], $this->_getApplication()->getTemplatesList());
    }

    /**
     * Get test application.
     *
     * @return \Cake\Datasource\EntityInterface|Application
     */
    protected function _getApplication()
    {
        return $this->Application->get(2);
    }
}
