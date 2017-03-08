<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Measure'), ['action' => 'edit', $measure->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Measure'), ['action' => 'delete', $measure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $measure->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Measures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Measure'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="measures view large-9 medium-8 columns content">
    <h3><?= h($measure->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Measure') ?></th>
            <td><?= h($measure->measure) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($measure->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($measure->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($measure->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Questions') ?></h4>
        <?php if (!empty($measure->questions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Question Text') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Form Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Placeholder') ?></th>
                <th scope="col"><?= __('Measure Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($measure->questions as $questions): ?>
            <tr>
                <td><?= h($questions->id) ?></td>
                <td><?= h($questions->question_text) ?></td>
                <td><?= h($questions->type) ?></td>
                <td><?= h($questions->form_id) ?></td>
                <td><?= h($questions->created) ?></td>
                <td><?= h($questions->modified) ?></td>
                <td><?= h($questions->placeholder) ?></td>
                <td><?= h($questions->measure_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Questions', 'action' => 'view', $questions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Questions', 'action' => 'edit', $questions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Questions', 'action' => 'delete', $questions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
