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
 * @var       \Cck\Model\Entity\Type $entity
 */

use Core\Toolbar\ToolbarHelper;

ToolbarHelper::apply();
ToolbarHelper::save();
ToolbarHelper::cancel();

echo $this->Form->create($entity, ['jsForm' => true]);
?>
<div class="row">
    <div class="page-header">
        <h1 class="title"><?= $this->get('page_title') ?></h1>
    </div>
    <div class="col s6">
        <?php
        echo $this->Form->control('id');
        echo $this->Form->control('name');
        echo $this->Form->control('slug');
        ?>
    </div>
</div>
<?php
echo $this->Form->end();
