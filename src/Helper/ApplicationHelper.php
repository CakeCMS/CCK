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

namespace Cck\Helper;

use Core\Helper\AppHelper;
use Cck\Model\Entity\Application;

/**
 * Class ApplicationHelper
 *
 * @package Cck\Helper
 */
class ApplicationHelper extends AppHelper
{

    /**
     * Application manifest filename.
     */
    const APP_MANIFEST = 'application.manifest.php';

    /**
     * Get all application groups.
     *
     * @return array
     */
    public function groups()
    {
        $apps = [];
        /** @var \Core\Path\Path $path */
        $path = $this->cms['path'];
        if ($folders = $path->dirs('applications:')) {
            foreach ($folders as $folder) {
                if ($path->get('applications:' . $folder . '/' . self::APP_MANIFEST)) {
                    $app = new Application();
                    $app->set('app_group', $folder);
                    $apps[$folder] = $app;
                }
            }
        }

        return $apps;
    }
}
