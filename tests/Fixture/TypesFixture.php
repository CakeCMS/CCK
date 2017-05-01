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

namespace Cck\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Class TypesFixture
 *
 * @package Cck\Test\Fixture
 */
class TypesFixture extends TestFixture
{

    /**
     * Table fields.
     *
     * @var array
     */
    public $fields = [
        'id'  => [
            'type'   => 'integer',
            'length' => 11,
            'null'   => false
        ],
        'name' => [
            'type'   => 'string',
            'length' => 255,
            'null'   => false
        ],
        'slug' => [
            'type'   => 'string',
            'length' => 255,
            'null'   => false
        ],
        'params' => 'text',
        '_constraints' => [
            'primary' => [
                'type'    => 'primary',
                'columns' => ['id']
            ]
        ]
    ];

    /**
     * TypesFixture constructor.
     */
    public function __construct()
    {
        $this->records = [
            [
                'id'     => 1,
                'name'   => 'Profiles',
                'slug'   => 'user',
                'params' => json_encode([
                    'test'   => [
                        'id'      => '_test',
                        'name'    => 'Test',
                        'options' => true
                    ],
                    'custom' => [
                        'id'      => '_custom',
                        'name'    => 'Custom',
                        'options' => false
                    ]
                ], JSON_PRETTY_PRINT)
            ]
        ];

        $this->table = 'cck_types';

        parent::__construct();
    }
}
