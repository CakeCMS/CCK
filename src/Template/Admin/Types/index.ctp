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
 */

use Core\Toolbar\ToolbarHelper;

ToolbarHelper::add(__d('cck', 'New type'));

echo $this->Form->create(null, ['jsForm' => true]);
?>
<div class="page-header">
    <h1 class="title"><?= $this->get('page_title') ?></h1>
</div>
<table class="ckTableProcess striped highlight responsive-table">
    <?php
    $tHeaders = $this->Html->tableHeaders([
        [$this->Form->checkAll() => ['class' => 'center ck-hide-label']],
        __d('community', 'Type name'),
        __d('community', 'Site templates'),
        __d('community', 'Extension layouts')
    ]);

    echo $this->Html->tag('thead', $tHeaders);

    $rows = [];
    /** @var \Cck\Model\Entity\Type $type */
    foreach ($this->get('types') as $type) {

        $title = $this->Html->link($type->name, [
            'action' => 'edit',
            $type->id
        ]);

        $editElements = $this->Html->link(null, [
            'action' => 'editElements',
            $type->id
        ], ['icon' => 'cubes']);

        $rows[] = [
            [$this->Form->processCheck('group', $type->id), ['class' => 'center ck-hide-label']],
            $editElements . '&nbsp;|&nbsp;' . $title,
            '',
            ''
        ];
    }
    echo $this->Html->tableCells($rows);
    ?>
</table>
<?php echo $this->Form->end();
