<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Signup'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="row">
	<div class="col-md-4 m-auto bg-light">
        <?= $this->Form->create('user') ?>
            <fieldset>
                <h1 class="text-center"><?= __('Login') ?></h1>
                <?= $this->Form->input('username') ?>
                <?= $this->Form->input('password') ?>
   <?= $this->Form->button(__('Login'),['class'=>'btn btn-primary form-control mb-3']) ?>
</fieldset>
<?= $this->Form->end() ?>
</div>
</div>
