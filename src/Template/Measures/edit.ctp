<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $measure->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $measure->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Measures'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="measures form large-9 medium-8 columns content">
    <?= $this->Form->create($measure) ?>
    <fieldset>
        <legend><?= __('Edit Measure') ?></legend>
        <?php
            echo $this->Form->control('measure');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
