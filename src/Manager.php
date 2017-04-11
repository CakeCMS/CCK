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

namespace CCK;

use CCK\Type\Manager as TypeManager;
use CCK\Element\Manager as ElementManager;

/**
 * Class Manager
 *
 * @package CCK
 */
class Manager
{

    /**
     * Application Init flag.
     *
     * @var bool
     */
    protected $_isInit = false;

    /**
     * @var ElementManager
     */
    protected $_eManager;

    /**
     * @var TypeManager
     */
    protected $_tManager;

    /**
     * Hold class name map.
     *
     * @var array
     */
    protected static $_classNameMap = [];

    /**
     * Get CCK instance.
     *
     * @return Manager
     */
    public static function getInstance()
    {
        static $instance;
        if ($instance === null) {
            $instance = new self();
            $instance->initialize();
        }

        return $instance;
    }

    /**
     * CCK initialization.
     *
     * @return bool
     */
    public function initialize()
    {
        if ($this->_isInit) {
            return false;
        }

        $this->_isInit   = true;
        $this->_eManager = new ElementManager();
        $this->_tManager = new TypeManager();
    }

    /**
     * Get element manager object.
     *
     * @return ElementManager
     */
    public function getElementManager()
    {
        return $this->_eManager;
    }

    /**
     * Get type manager object.
     *
     * @return TypeManager
     */
    public function getTypeManager()
    {
        return $this->_tManager;
    }
}
