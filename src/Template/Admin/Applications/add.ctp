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
 * @var       \Core\View\AppView $this
 * @var       \JBZoo\Data\Data $params
 * @var       \Cck\Model\Entity\Application $app
 */

use JBZoo\Utils\Arr;
use Core\Toolbar\ToolbarHelper;

ToolbarHelper::apply();
ToolbarHelper::save();
ToolbarHelper::cancel();

echo $this->Form->create($app, ['jsForm' => true]);
?>
<div class="row">
    <div class="col s5">
        <?php
        echo $this->Form->hidden('app_group', ['value' => $app->app_group]);
        echo $this->Form->control('name', ['title' => __d('cck', 'Application name')]);
        echo $this->Form->control('alias', ['alias' => __d('cck', 'Application alias')]);
        echo $this->Form->control('template', [
            'empty' => __d('cck', '-=Choose template=-'),
            'alias' => __d('cck', 'Application template')
        ]);
        ?>
    </div>
    <div class="col s7">
        <ul class="collapsible" data-collapsible="accordion">
            <?php foreach ($params as $paramGroup => $param) :
                list ($icon, $paramGroupName) = pluginSplit($paramGroup);
                ?>
            <li>
                <div class="collapsible-header">
                    <?php
                    if ($icon !== null) {
                        echo $this->Html->icon($icon);
                    }
                    echo __d('cck', 'Params {0}', $paramGroupName);
                    ?>
                </div>
                <div class="collapsible-body">
                    <?php
                    foreach ((array) $param as $inputName => $options) {
                        if (Arr::key('type', $options)) {
                            $type = $options['type'];
                            unset($options['type']);
                            echo $this->Form->{$type}('params.' . $inputName, $options);
                        }
                    }
                    ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php echo $this->Form->end();
