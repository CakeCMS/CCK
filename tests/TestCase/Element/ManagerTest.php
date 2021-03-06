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

namespace Cck\Test\TestCase\Element;

use Cake\I18n\I18n;
use Cck\Element\Manager;
use Core\TestSuite\TestCase;
use Cck\ORM\Entity\Element as ElementEntity;

/**
 * Class ManagerTest
 *
 * @package Cck\Test\TestCase\Element
 */
class ManagerTest extends TestCase
{

    public function tearDown()
    {
        parent::tearDown();
        I18n::clear();
    }

    public function testClassName()
    {
        self::assertInstanceOf('Cck\Element\Manager', $this->_getManager());
    }

    /**
     * @expectedException \Cck\Element\Exception\ElementException
     */
    public function testCreateTypeIsEmpty()
    {
        $this->_getManager()->create('');
    }

    /**
     * @expectedException \Cck\Element\Exception\ElementException
     */
    public function testCreateGroupIsEmpty()
    {
        $this->_getManager()->create('Custom', '');
    }

    /**
     * @expectedException \Cck\Element\Exception\ElementException
     */
    public function testNotFoundElementClass()
    {
        $this->_getManager()->create('NotFound');
    }

    public function testSuccessCreateElement()
    {
        $element = $this->_getManager()->create('Title', 'Item', [], new CustomEntity());

        self::assertSame('_title', $element->id);
        self::assertSame('Item', $element->config->get('group'));
        self::assertSame('Title', $element->config->get('type'));
        self::assertSame('Item Title', $element->config->get('name'));

        self::assertInstanceOf('JBZoo\Data\JSON', $element->config);
        self::assertInstanceOf('Elements\Item\TitleElement', $element);
        self::assertInstanceOf('JBZoo\Data\PHPArray', $element->loadMeta());
        self::assertInstanceOf('CCK\Test\TestCase\Element\CustomEntity', $element->getEntity());
    }

    /**
     * @return Manager
     */
    protected function _getManager()
    {
        return new Manager();
    }
}

/**
 * Class CustomEntity
 *
 * @package Cck\Test\TestCase\Element
 */
class CustomEntity extends ElementEntity
{
}