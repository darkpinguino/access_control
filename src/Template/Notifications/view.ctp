<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Notifications'), ['controller' => 'UserNotifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Notification'), ['controller' => 'UserNotifications', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notifications view large-9 medium-8 columns content">
    <h3><?= h($notification->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Notification') ?></th>
            <td><?= h($notification->notification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $notification->has('company') ? $this->Html->link($notification->company->name, ['controller' => 'Companies', 'action' => 'view', $notification->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($notification->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($notification->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($notification->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User Notifications') ?></h4>
        <?php if (!empty($notification->user_notifications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Notification Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($notification->user_notifications as $userNotifications): ?>
            <tr>
                <td><?= h($userNotifications->id) ?></td>
                <td><?= h($userNotifications->user_id) ?></td>
                <td><?= h($userNotifications->notification_id) ?></td>
                <td><?= h($userNotifications->created) ?></td>
                <td><?= h($userNotifications->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserNotifications', 'action' => 'view', $userNotifications->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserNotifications', 'action' => 'edit', $userNotifications->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserNotifications', 'action' => 'delete', $userNotifications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userNotifications->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
