<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Login'), ['action' => 'login']) ?></li>
    </ul>
</nav>
<div class="row">
    <div class="col-md-6 col-lg-6 m-auto bg-light rounded">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <h1 class="text-center font-weight-bold"><?= __('Create account') ?></h1>
        <?php
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('phone');
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success mb-3']) ?>
    <?= $this->Form->end() ?>
    </div>
</div>
