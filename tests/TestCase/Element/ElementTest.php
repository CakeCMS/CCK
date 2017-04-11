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

namespace CCK\Test\TestCase\Cck\Element;

use JBZoo\Utils\FS;
use JBZoo\Utils\Str;
use Cake\Core\Configure;
use CCK\Element\Element;
use Core\TestSuite\TestCase;
use CCK\ORM\Entity\Element as ElementEntity;

/**
 * Class ElementTest
 *
 * @package CCK\Test\TestCase\Cck\Element
 */
class ElementTest extends TestCase
{

    public function testClassName()
    {
        $element = new TestElement('Title', 'Item');
        self::assertInstanceOf('CCK\Test\TestCase\Cck\Element\TestElement', $element);
    }

    public function testGetPath()
    {
        $element = new TestElement('Title', 'Item');
        $path = $element->getPath();

        self::assertNotFalse($path);

        $expected = FS::clean(WWW_ROOT . 'elements/Item/Title', '/');
        self::assertSame($expected, $path);

        $element = new TestElement('Title', 'NotFound');
        self::assertFalse($element->getPath());

        // TODO add custom element path to test
    }

    public function testLoadMeta()
    {
        $element = new TestElement('Title', 'Item');
        $meta = $element->loadMeta();

        self::assertInstanceOf('JBZoo\Data\PHPArray', $meta);
        self::assertSame('Item Title', $meta->find('meta.name'));
        self::assertTrue($meta->find('meta.core'));
    }

    public function testGetMetaData()
    {
        $element = new TestElement('Title', 'Item');
        self::assertSame('Item Title', $element->getMetaData('name'));
        self::assertTrue($element->getMetaData('core'));
        self::assertNull($element->getMetaData('not-found'));
        self::assertFalse($element->getMetaData('not-found', false));
    }

    public function testIsCore()
    {
        $element = new TestElement('Title', 'Item');
        self::assertTrue($element->isCore());

        $element = new TestElement('Custom', 'Item');
        self::assertFalse($element->isCore());
    }

    public function testSetConfig()
    {
        $element = new TestElement('Title', 'Item');
        self::assertNull($element->config);
        $element->setConfig([
            'description' => '',
            'name'        => $element->getName(),
            'id'          => '_' . Str::low('Title'),
        ]);

        self::assertInstanceOf('JBZoo\Data\JSON', $element->config);
        self::assertSame('_title', $element->config->get('id'));
        self::assertSame('', $element->config->get('description'));
        self::assertSame('Item Title', $element->config->get('name'));
    }

    public function testSetEntity()
    {
        $element = new TestElement('Title', 'Item');
        self::assertNull($element->getEntity());

        $element->setEntity(new TestEntity());
        self::assertInstanceOf('CCK\Test\TestCase\Cck\Element\TestEntity', $element->getEntity());
    }
}

/**
 * Class TestElement
 *
 * @package CCK\Test\TestCase\Cck\Element
 */
class TestElement extends Element
{
}

/**
 * Class TestEntity
 *
 * @package CCK\Test\TestCase\Cck\Element
 */
class TestEntity extends ElementEntity
{
}
