<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<section class="content">
<div class="box box-warning">
  <div class="box-header with-border">
    <label class="box-title">Users</label>
  </div>
  <div class="box-body">
    <div class="col-md-5 col-lg-5 float-right mt-5">

        <?= $this->Form->create("",['type'=>'get']) ?>
            <?= $this->Form->control('key',['default'=>$key = $this->request->query('key'), 'class'=>'form-control ']); ?>
            
        <?= $this->Form->end() ?>
    </div>
        
    <table cellpadding="0" cellspacing="0"  class="table table-striped table-hover table-bordered mt-3">
        <thead >
            <tr>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->phone) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <a href="<?= $this->Url->build(['action' => 'view', $user->id]); ?>">
                    <button type="View" class="btn  btn-sm view-button "><i class="fa fa-eye"></i> View</button></a>
                    <a href="<?= $this->Url->build(['action' => 'edit', $user->id]); ?>">
                    <button type="View" class="btn btn-sm edit-button"><i class="fa fa-pencil"></i> Edit</button></a>
                    <?= $this->Form->postLink('<button class="btn btn-delete btn-sm">
                         <i class="fa fa-trash"></i> Delete</button>', ['action' => 'delete', $user->id], ['class'    => 'tip','escape'   => false,'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
</div>
</section>
