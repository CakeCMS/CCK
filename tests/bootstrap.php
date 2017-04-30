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

use Core\Theme;
use Core\Plugin;
use Cake\Mailer\Email;
use Cake\Core\Configure;
use Cake\Network\Request;
use Cake\Routing\DispatcherFactory;
use Cake\Datasource\ConnectionManager;

//  Composer autoload.
if ($autoload = realpath('./vendor/autoload.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once $autoload;
} else {
    echo 'Please execute "composer update" !' . PHP_EOL;
    exit(1);
}

//  Include test app paths.
require_once __DIR__ . '/paths.php';

date_default_timezone_set('UTC');
mb_internal_encoding('UTF-8');

//  Include CakePHP framework.
/** @noinspection PhpIncludeInspection */
require_once CAKE_CORE_INCLUDE_PATH . '/config/bootstrap.php';

//  Include test app configuration.
require_once __DIR__ . '/config.php';

//  Configure the mbstring extension to use the correct encoding.
mb_internal_encoding(Configure::read('App.encoding'));

//  Ensure default test connection is defined.
if (!getenv('db_dsn')) {
    putenv('db_dsn=sqlite:///:memory:');
}

ConnectionManager::setConfig('test', [
    'timezone' => 'UTC',
    'url'      => getenv('db_dsn'),
]);

Email::setConfig(Configure::consume('Email'));
Email::setConfigTransport(Configure::consume('EmailTransport'));

DispatcherFactory::add('Routing');
DispatcherFactory::add('ControllerFactory');

//  Setup detector of theme.
Request::addDetector('theme', function ($request) {
    /** @var Cake\Network\Request $request */
    $theme = Theme::setup($request->param('prefix'));
    $request->offsetSet('theme', $theme);
    return Plugin::loaded($theme);
});
