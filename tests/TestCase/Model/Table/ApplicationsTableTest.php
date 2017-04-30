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

namespace Cck\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Core\TestSuite\TestCase;

/**
 * Class ApplicationsTableTest
 *
 * @package Cck\Test\TestCase\Model\Table
 */
class ApplicationsTableTest extends TestCase
{

    protected $_corePlugin = 'Cck';
    public $fixtures       = ['plugin.cck.applications'];

    public function testClassName()
    {
        $table = TableRegistry::get('Cck.Applications');
        self::assertInstanceOf('Cck\Model\Table\ApplicationsTable', $table);
        self::assertSame(CMS_TABLE_APPLICATIONS, $table->getTable());
    }

    public function testSave()
    {
        $table  = TableRegistry::get('Cck.Applications');
        $entity = $table->newEntity([
            'name'     => '',
            'alias'    => '',
            'template' => ''
        ]);

        $result = $table->save($entity);
        self::assertFalse($result);
        self::assertSame(['_empty' => __d('cck', 'Please, setup application name')], $entity->getError('name'));
        self::assertSame(['_empty' => __d('cck', 'Please, setup application alias')], $entity->getError('alias'));
        self::assertSame(['_empty' => __d('cck', 'Please, choose application template')], $entity->getError('template'));
    }
}
