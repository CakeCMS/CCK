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

namespace Cck\Test\TestCase;

use Cck\Manager;
use Core\TestSuite\TestCase;

/**
 * Class ManagerTest
 *
 * @package Cck\Test\TestCase
 */
class ManagerTest extends TestCase
{
    
    public function testGetInstances()
    {
        $cck = Manager::getInstance();
        self::assertInstanceOf('CCK\Manager', $cck);
        self::assertInstanceOf('CCK\Type\Manager', $cck->getTypeManager());
        self::assertInstanceOf('CCK\Element\Manager', $cck->getElementManager());
    }
}
