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
use Cake\Validation\Validator;

/**
 * Class ApplicationsTable
 *
 * @package Cck\Model\Table
 */
class ApplicationsTable extends Table
{

    /**
     * Initialize a table instance. Called after the constructor.
     *
     * @param array $config
     * @return void
     */
    public function initialize(array $config = [])
    {
        parent::initialize($config);
        $this
            ->setPrimaryKey(TABLE_PRIMARY_KEY)
            ->setTable(CMS_TABLE_APPLICATIONS);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('name')
            ->notEmpty('name', __d('cck', 'Please, setup application name'))

            ->requirePresence('alias')
            ->notEmpty('alias', __d('cck', 'Please, setup application alias'))

            ->requirePresence('template')
            ->notEmpty('template', __d('cck', 'Please, choose application template'));

        return $validator;
    }
}
