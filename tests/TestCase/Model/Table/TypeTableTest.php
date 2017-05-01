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
 * Class TypesTableTest
 *
 * @package Cck\Test\TestCase\Model\Table
 */
class TypesTableTest extends TestCase
{

    public $fixtures = ['plugin.cck.types'];

    protected $_defaultTable = 'Types';
    protected $_corePlugin   = 'Cck';

    public function testClassName()
    {
        $table = $this->_getTable();
        self::assertInstanceOf('Cck\Model\Table\TypesTable', $table);
        self::assertSame(CMS_TABLE_TYPES, $table->getTable());
    }

    public function testValidation()
    {
        $this->assertFieldErrorValidation('name', '', [
            '_empty' =>  __d('cck', 'Please, setup application name')
        ]);

        $this->assertFieldErrorValidation('slug', '', [
            '_empty' =>  __d('cck', 'Please, setup application alias')
        ]);
    }
}
