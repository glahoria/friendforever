<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<section class="content">
<div class="box box-warning">
    <div class="box-header with-border">
        <label class="box-title">View</label>
    </div>
    <div class="box-body">
        <table class="table">
            <tr>
                <th scope="row"><?= __('First Name') ?></th>
                <td><?= h($user->first_name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Last Name') ?></th>
                <td><?= h($user->last_name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Email') ?></th>
                <td><?= h($user->email) ?></td>
            </tr>
            <!--tr>
                <th scope="row"><?= __('Password') ?></th>
                <td><?= h($user->password) ?></td>
            </tr-->
            <tr>
                <th scope="row"><?= __('Phone') ?></th>
                <td><?= h($user->phone) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($user->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($user->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Active') ?></th>
                <td><?= $user->active ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
        <div class="box-footer">
            <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'index']); ?>"><button class="btn  pull-right mt-3 profile-button">Back</button></a> 
        </div>
    </div>
</div>
</section>