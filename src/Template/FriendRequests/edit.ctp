<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FriendRequest $friendRequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $friendRequest->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $friendRequest->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Friend Requests'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="friendRequests form large-9 medium-8 columns content">
    <?= $this->Form->create($friendRequest) ?>
    <fieldset>
        <legend><?= __('Edit Friend Request') ?></legend>
        <?php
            echo $this->Form->control('request_from_id');
            echo $this->Form->control('request_to_id');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
