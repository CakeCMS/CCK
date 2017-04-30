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

namespace Cck\Test\TestCase\Helper;

use Core\Cms;
use Core\TestSuite\TestCase;
use Cck\Helper\ApplicationHelper;

/**
 * Class ApplicationHelperTest
 *
 * @package Cck\Test\TestCase\Helper
 */
class ApplicationHelperTest extends TestCase
{

    public function testClassName()
    {
        $cms = Cms::getInstance();
        self::assertInstanceOf('Cck\Helper\ApplicationHelper', $cms['helper']['cck.application']);
    }

    public function testGetGroup()
    {
        $cms = Cms::getInstance();
        /** @var ApplicationHelper $helper */
        $helper = $cms['helper']['cck.application'];
        $apps = $helper->groups();
        self::assertInstanceOf('Cck\Model\Entity\Application', $apps['system']);
    }
}
