<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FriendRequest $friendRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Friend Request'), ['action' => 'edit', $friendRequest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Friend Request'), ['action' => 'delete', $friendRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $friendRequest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Friend Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Friend Request'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="friendRequests view large-9 medium-8 columns content">
    <h3><?= h($friendRequest->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($friendRequest->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($friendRequest->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request From Id') ?></th>
            <td><?= $this->Number->format($friendRequest->request_from_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request To Id') ?></th>
            <td><?= $this->Number->format($friendRequest->request_to_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($friendRequest->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($friendRequest->modified) ?></td>
        </tr>
    </table>
</div>
