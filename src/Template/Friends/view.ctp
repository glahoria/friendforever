<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Friend $friend
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Friend'), ['action' => 'edit', $friend->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Friend'), ['action' => 'delete', $friend->id], ['confirm' => __('Are you sure you want to delete # {0}?', $friend->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Friends'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Friend'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Friends'), ['controller' => 'Friends', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Friend'), ['controller' => 'Friends', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="friends view large-9 medium-8 columns content">
    <h3><?= h($friend->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $friend->has('user') ? $this->Html->link($friend->user->id, ['controller' => 'Users', 'action' => 'view', $friend->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($friend->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Friend Id') ?></th>
            <td><?= $this->Number->format($friend->friend_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($friend->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($friend->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Friends') ?></h4>
        <?php if (!empty($friend->friends)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Friend Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($friend->friends as $friends): ?>
            <tr>
                <td><?= h($friends->id) ?></td>
                <td><?= h($friends->user_id) ?></td>
                <td><?= h($friends->friend_id) ?></td>
                <td><?= h($friends->created) ?></td>
                <td><?= h($friends->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Friends', 'action' => 'view', $friends->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Friends', 'action' => 'edit', $friends->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Friends', 'action' => 'delete', $friends->id], ['confirm' => __('Are you sure you want to delete # {0}?', $friends->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
