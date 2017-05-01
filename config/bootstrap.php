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

use Core\Cms;
use Core\Plugin;
use JBZoo\Utils\FS;
use Cake\Core\Configure;

if (!defined('CCK_APP_DIR')) {
    define('CCK_APP_DIR', 'cck');
}

if (!defined('CMS_TABLE_APPLICATIONS')) {
    define('CMS_TABLE_APPLICATIONS', 'cck_applications');
}
if (!defined('CMS_TABLE_TYPES')) {
    define('CMS_TABLE_TYPES', 'cck_types');
}

$cms     = Cms::getInstance();
$plugins = (array) Plugin::loaded();

$cms['path']->set('applications', FS::clean(WWW_ROOT, '/') . '/' . CCK_APP_DIR);
foreach ($plugins as $plugin) {
    $path = Plugin::path($plugin) . '/' . Configure::read('App.webroot') . '/' . CCK_APP_DIR;
    $path = FS::clean($path, '/');
    $cms['path']->set('applications', $path);
}
