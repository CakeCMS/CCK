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

namespace CCK\Type;

use JBZoo\Utils\Str;

/**
 * Class TypeAbstract
 *
 * @package CCK\Type
 */
abstract class TypeAbstract
{

    /**
     * Type id.
     *
     * @var string
     */
    public $id;

    /**
     * Group id.
     *
     * @var string
     */
    public $groupId;

    /**
     * Type constructor.
     *
     * @param string $typeId
     * @param string $groupId
     */
    public function __construct($typeId, $groupId)
    {
        $this->id      = Str::low($typeId);
        $this->groupId = Str::low($groupId);
        $this->initialize();
    }

    /**
     * Initialize hook method.
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * Get required/core elements.
     *
     * @return array
     */
    abstract public function getRequiredElements();
}
