<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $accessRolePerson->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $accessRolePerson->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Access Role People'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="accessRolePeople form large-9 medium-8 columns content">
    <?= $this->Form->create($accessRolePerson) ?>
    <fieldset>
        <legend><?= __('Edit Access Role Person') ?></legend>
        <?php
            echo $this->Form->input('people_id');
            echo $this->Form->input('access_role');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
