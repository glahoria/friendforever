<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<section class="content">
<div class="box box-warning">
    <div class="box-header with-border">
        <label class="box-title">Edit User</label>
    </div>
    <div class="box-body">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <?php
                echo $this->Form->control('first_name',['class'=>'form-control']);
                echo $this->Form->control('last_name',['class'=>'form-control']);
                echo $this->Form->control('email',['class'=>'form-control']);
                echo $this->Form->control('phone',['class'=>'form-control']);
                echo $this->Form->control('active');
            ?>
        </fieldset>
        <div class="box-footer">
            <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'index']); ?>"><button class="btn  pull-left mt-3 profile-button">Back</button></a>
            <?= $this->Form->button(__('Update'),['class'=>'btn  pull-right mt-3 btn-success']) ?> 
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
</section>

