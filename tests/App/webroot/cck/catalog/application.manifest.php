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

return [
    'meta' => [
        'name'          => 'Test application',
        'group'         => 'catalog',
        'version'       => '1.0.0',
        'creationDate'  => 'May 2017',
        'author'        => 'Sergey Kalistratov',
        'authorEmail'   => 'kalistratov.s.m@gmail.com',
        'authorUrl'     => '',
        'copyright'     => 'Copyright (C) Sergey Kalistratov'
    ],
    'params' => [
        'cog.application' => [
            'order' => [
                'type' => 'control',
                'default' => '15',
                'title' => 'Order page'
            ]
        ],
        'item' => [

        ]
    ]
];
