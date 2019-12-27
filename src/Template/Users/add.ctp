<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<style>
    fieldset{
        background-color: white;
    }
    .btn{
        width: 200px;
        float: right;
    }
</style>
<div class="col-md-10 col-lg-10 background">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <h1 class="text-center font-weight-bold"><?= __('Create account') ?></h1>
        <?= $this->Form->control('first_name') ?>
        <?= $this->Form->control('last_name') ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Form->control('phone') ?>
        <?= $this->Form->control('active') ?>
        <?= $this->Form->button(__('Submit'),['class'=>'btn']) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
