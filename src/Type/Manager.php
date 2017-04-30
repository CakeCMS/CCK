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

namespace Cck\Type;

use Cake\Core\App;
use JBZoo\Utils\Arr;
use Cake\Utility\Inflector;

/**
 * Class Manager
 *
 * @package CCK\Type
 */
class Manager
{

    /**
     * Hold loaded types.
     *
     * @var array
     */
    protected static $_loadedList = [];

    /**
     * Setup new type.
     *
     * @param string $type
     * @param string $group
     * @return \CCK\Type\Type
     */
    public function set($type, $group)
    {
        $hash = implode('///', [$type, $group]);
        if ($class = App::className($this->_getClassName($type), 'Type/' . Inflector::camelize($group))) {
            $typeObject = new $class($type, $group);
        } else {
            $typeObject = new Type($type, $group);
        }

        if (!Arr::key($hash, self::$_loadedList)) {
            self::$_loadedList[$hash] = $typeObject;
        }

        return self::$_loadedList[$hash];
    }

    /**
     * Get type.
     *
     * @param string $typeId
     * @param string $groupId
     * @return array|null
     */
    public function get($typeId, $groupId)
    {
        $hash = implode('///', [$typeId, $groupId]);
        if (Arr::key($hash, self::$_loadedList)) {
            return self::$_loadedList[$hash];
        }

        return null;
    }

    /**
     * Get current class name.
     *
     * @param string $type
     * @return string
     */
    protected function _getClassName($type)
    {
        list ($plugin, $className) = pluginSplit($type);
        $return = Inflector::camelize($className);
        if ($plugin !== null) {
            $return = Inflector::camelize($plugin) . '.' . $return;
        }

        return $return;
    }
}
