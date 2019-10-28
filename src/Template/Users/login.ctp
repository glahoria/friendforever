<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Signup'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
 
 <?= $this->Form->create('user') ?>
<fieldset>
   <legend><?= __('Login') ?></legend>
   <?= $this->Form->control('email') ?>
   <?= $this->Form->control('password') ?>
   <?= $this->Form->button(__('Login')) ?>
</fieldset>
<?= $this->Form->end() ?>
