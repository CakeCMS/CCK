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

use Cck\Template;
use JBZoo\Utils\FS;
use Core\TestSuite\TestCase;

/**
 * Class TemplateTest
 *
 * @package Cck\Test\TestCase
 */
class TemplateTest extends TestCase
{

    public function testClassName()
    {
        $template = new Template('test', __DIR__);
        self::assertInstanceOf('Cck\Template', $template);
        self::assertInstanceOf('Core\Cms', $template->cms);
        self::assertSame('test', $template->name);
        self::assertSame(FS::clean(__DIR__, '/'), $template->resource);
    }
}
