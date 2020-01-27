<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Friend $friend
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $friend->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $friend->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Friends'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Friends'), ['controller' => 'Friends', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Friend'), ['controller' => 'Friends', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="friends form large-9 medium-8 columns content">
    <?= $this->Form->create($friend) ?>
    <fieldset>
        <legend><?= __('Edit Friend') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('friend_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
