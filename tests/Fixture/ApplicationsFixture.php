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
 * Class ApplicationsFixture
 *
 * @package Cck\Test\Fixture
 */
class ApplicationsFixture extends TestFixture
{

    /**
     * Table fields.
     *
     * @var array
     */
    public $fields = [
        'id'  => [
            'type'   => 'integer',
            'length' => 12,
            'null'   => false
        ],
        'name' => [
            'type'   => 'string',
            'length' => 255,
            'null'   => false
        ],
        'alias' => [
            'type'   => 'string',
            'length' => 255,
            'null'   => false
        ],
        'template' => [
            'type'   => 'string',
            'length' => 255,
            'null'   => false
        ],
        'app_group' => [
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
     * ConfigsFixture constructor.
     */
    public function __construct()
    {
        $this->records = [
            [
                'id'        => 1,
                'name'      => 'Profiles',
                'alias'     => 'user',
                'template'  => 'default',
                'app_group' => 'community',
                'params'    => json_encode([
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
            ],
            [
                'id'        => 2,
                'name'      => 'Test application',
                'alias'     => 'tester',
                'template'  => 'default',
                'app_group' => 'catalog',
                'params'    => json_encode([
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

        $this->table = 'cck_applications';

        parent::__construct();
    }
}
