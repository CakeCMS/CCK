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

namespace Cck;

use Core\Cms;
use JBZoo\Utils\FS;

/**
 * Class Template
 *
 * @package Cck
 */
class Template
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $resource;

    /**
     * Hold CMS object.
     *
     * @var Cms
     */
    public $cms;

    /**
     * Template constructor.
     *
     * @param string $name
     * @param string $resource
     */
    public function __construct($name, $resource)
    {
        $this->name     = $name;
        $this->resource = FS::clean($resource, '/');
        $this->cms      = Cms::getInstance();
    }
}
