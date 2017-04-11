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

use CCK\Manager;
use Core\Plugin;
use Core\TestSuite\TestCase;

/**
 * Class Manager
 *
 * @package CCK\Test\TestCase\Cck\Type
 */
class ManagerTest extends TestCase
{

    public function testClassName()
    {
        $manager = Manager::getInstance();
        self::assertInstanceOf('CCK\Type\Manager', $manager->getTypeManager());
    }

    public function testSetCustomType()
    {
        $manager = Manager::getInstance()->getTypeManager();
        self::assertInstanceOf('CCK\Type\Type', $manager->set('user', 'community'));
        self::assertInstanceOf('CCK\Type\Type', $manager->get('user', 'community'));
    }

    public function testGetEmpty()
    {
        $manager = Manager::getInstance()->getTypeManager();
        self::assertNull($manager->get('no-exist', 'community'));
    }

    public function testSetNewType()
    {
        $manager = Manager::getInstance()->getTypeManager();
        $type    = $manager->set('payment', 'catalog');

        self::assertSame('payment', $type->id);
        self::assertSame('catalog', $type->groupId);
        self::assertInstanceOf('Test\App\Type\Catalog\Payment', $type);
    }

    public function testSetTypeFromPlugin()
    {
        Plugin::load('Custom', ['autoload' => true]);

        $manager = Manager::getInstance()->getTypeManager();

        $type    = $manager->set('custom.gallery', 'catalog');
        self::assertInstanceOf('Custom\Type\Catalog\Gallery', $type);
        self::assertSame('custom.gallery', $type->id);
        self::assertSame('catalog', $type->groupId);
        self::assertSame([], $type->getRequiredElements());

        $type = $manager->set('Custom.Camel', 'catalog');
        self::assertInstanceOf('Custom\Type\Catalog\Camel', $type);
        self::assertSame('custom.camel', $type->id);
        self::assertSame('catalog', $type->groupId);
        self::assertSame(['id', 'alias'], $type->getRequiredElements());

        Plugin::unload('Custom');
    }
}
