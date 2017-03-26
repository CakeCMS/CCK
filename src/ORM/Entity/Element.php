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

namespace CCK\Entity;

use JBZoo\Data\Data;
use Core\ORM\Entity\Entity;

/**
 * Class Element
 *
 * @package CCK\Entity
 */
abstract class Element extends Entity
{

    /**
     * List of elements.
     *
     * @var Data
     */
    public $elements;
}
