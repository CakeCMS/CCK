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

namespace CCK\Test\TestCase\Cck\Type;

use CCK\Type\Type;
use Core\TestSuite\TestCase;

/**
 * Class TypeTest
 *
 * @package CCK\Test\TestCase\Cck\Type
 */
class TypeTest extends TestCase
{

    public function testClassName()
    {
        $type = new Type('custom', 'order');
        self::assertInstanceOf('CCK\Type\Type', $type);
    }

    public function testCreateType()
    {
        $type = new Type('custom', 'order');
        self::assertSame('custom', $type->id);
        self::assertSame('order', $type->groupId);

        $type = new Type('Name', 'Item');
        self::assertSame('name', $type->id);
        self::assertSame('item', $type->groupId);
    }

    public function testDefaultGetRequiredElements()
    {
        $type = new Type('custom', 'order');
        self::assertSame([], $type->getRequiredElements());
    }
}
