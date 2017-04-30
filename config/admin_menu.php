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

use Core\Nav;

Nav::add('sidebar', 'cck', [
    'title' =>__d('cck', 'CCK'),
    'weight'=> 20,
    'icon' => 'cog',
    'url' => '#',
    'children' => [
        'list' => [
            'title' => __d('cck', 'Applications'),
            'weight' => 10,
            'url' => [
                'plugin' => 'Cck',
                'controller' => 'Applications',
                'action' => 'index'
            ]
        ],
        'new' => [
            'title' => __d('cck', 'New application'),
            'weight' => 10,
            'url' => [
                'plugin' => 'Cck',
                'controller' => 'Applications',
                'action' => 'newApp'
            ]
        ],
    ]
]);
