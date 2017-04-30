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
 * @var       \Cck\Model\Entity\Application $app
 */

?>
<div class="cck-app-list">
    <div class="page-header">
        <h1 class="title"><?= __d('cck', 'Select an application to create a new catalog') ?></h1>
    </div>
    <div class="row">
        <?php foreach ($this->get('apps') as $app) : ?>
            <div class="col s2">
                <div class="card z-depth-3">
                    <div class="card-image">
                        <?= $this->Html->image($app->getIcon(), [
                            'alt'   => $app->app_group,
                            'title' => $app->app_group
                        ]); ?>
                        <?= $this->Html->link('', [
                            'controller' => 'Applications',
                            'action' => 'add',
                            $app->app_group
                        ], [
                            'class' => 'btn-floating red btn-large halfway-fab',
                            'icon'  => 'plus',
                            'title' => __d('cck', 'Create new catalog')
                        ]) ?>
                    </div>
                    <div class="card-content">
                            <span class="card-title">
                                <?= $app->getMetaData('name') ?>
                            </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
