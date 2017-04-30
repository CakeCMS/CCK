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

namespace Cck\Model\Entity;

use Cck\Template;
use JBZoo\Data\Data;
use Core\ORM\Entity\Entity;
use Cck\Helper\ApplicationHelper;

/**
 * Class Application
 *
 * @package Cck\Model\Entity
 * @property string $alias
 * @property string $app_group
 * @property string $name
 * @property string $template
 */
class Application extends Entity
{

    const APP_ICON = 'application.png';

    /**
     * Check manifest file include.
     *
     * @var bool
     */
    protected static $_isManifestIncluded = false;

    /**
     * Manifest data.
     *
     * @var Data
     */
    protected static $_metaData;

    /**
     * Application params.
     *
     * @var Data
     */
    protected static $_params;

    /**
     * Hold available templates of application.
     *
     * @var array
     */
    protected static $_templates = [];

    /**
     * Get the url to the icon of the application.
     *
     * @return null|string
     */
    public function getIcon()
    {
        $icon = $this->hasIcon() ? $this->getResource() .  self::APP_ICON : 'webroot:img/cck.png';
        return $this->cms['path']->url($icon);
    }

    /**
     * Get manifest file.
     *
     * @return string
     */
    public function getManifestFile()
    {
        return $this->getPath() . '/' . ApplicationHelper::APP_MANIFEST;
    }

    /**
     * Get application meta data.
     *
     * @param mixed $key
     * @param mixed $default
     * @return Data
     */
    public function getMetaData($key, $default = null)
    {
        $manifest = $this->getManifestFile();
        if (count(self::$_metaData) === 0) {
            /** @noinspection PhpIncludeInspection */
            $data = include $manifest;
            self::$_metaData = new Data($data['meta']);
        }

        return self::$_metaData->get($key, $default);
    }

    /**
     * Get the parameter form object.
     *
     * @return Data
     */
    public function getParamsForm()
    {
        $manifest = $this->getManifestFile();
        if (count(self::$_params) === 0) {
            /** @noinspection PhpIncludeInspection */
            $data = include $manifest;
            self::$_params = new Data($data['params']);
        }

        return self::$_params;
    }

    /**
     * Retrieve the application path.
     *
     * @return null|string
     */
    public function getPath()
    {
        return $this->cms['path']->get($this->getResource());
    }

    /**
     * Get the application resource path.
     *
     * @return string
     */
    public function getResource()
    {
        return "applications:{$this->app_group}/";
    }

    /**
     * Get the available templates for this application.
     *
     * @return array
     */
    public function getTemplates()
    {
        if (!count(self::$_templates)) {
            $folders = (array) $this->cms['path']->dirs($this->getResource() . 'templates');
            if (count($folders)) {
                foreach ($folders as $folder) {
                    self::$_templates[$folder] = new Template($folder, $this->getResource() . 'templates/' . $folder);
                }
            }
        }

        return self::$_templates;
    }

    /**
     * Get template array list.
     *
     * @return array
     */
    public function getTemplatesList()
    {
        $list = [];
        $templates = $this->getTemplates();
        /** @var Template $template */
        foreach ($templates as $key => $template) {
            $list[$key] = $template->name;
        }

        return $list;
    }

    /**
     * Check if the application icon exists.
     *
     * @return bool
     */
    public function hasIcon()
    {
        return (bool) $this->cms['path']->get($this->getResource() . self::APP_ICON);
    }
}
