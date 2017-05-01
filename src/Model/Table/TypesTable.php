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

namespace Cck\Model\Table;

use Core\ORM\Table;
use JBZoo\Data\Data;
use JBZoo\Utils\Arr;
use Cake\Event\Event;
use Cake\Validation\Validator;

/**
 * Class TypesTable
 *
 * @package Cck\Model\Table
 */
class TypesTable extends Table
{

    /**
     * Initialize a table instance. Called after the constructor.
     *
     * @param array $config
     * @return void
     * @SuppressWarnings("unused")
     */
    public function initialize(array $config = [])
    {
        $this
            ->setPrimaryKey(TABLE_PRIMARY_KEY)
            ->setTable(CMS_TABLE_TYPES);
    }

    /**
     * Default validate rules.
     *
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('name')
            ->notEmpty('name', __d('cck', 'Please, setup application name'))

            ->requirePresence('slug')
            ->notEmpty('slug', __d('cck', 'Please, setup application alias'));

        return $validator;
    }
}
