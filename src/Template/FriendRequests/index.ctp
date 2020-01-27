<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FriendRequest[]|\Cake\Collection\CollectionInterface $friendRequests
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Friend Request'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="friendRequests index large-9 medium-8 columns content">
    <h3><?= __('Friend Requests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_from_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('request_to_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($friendRequests as $friendRequest): ?>
            <tr>
                <td><?= $this->Number->format($friendRequest->id) ?></td>
                <td><?= $this->Number->format($friendRequest->request_from_id) ?></td>
                <td><?= $this->Number->format($friendRequest->request_to_id) ?></td>
                <td><?= h($friendRequest->status) ?></td>
                <td><?= h($friendRequest->created) ?></td>
                <td><?= h($friendRequest->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $friendRequest->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $friendRequest->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $friendRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $friendRequest->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
