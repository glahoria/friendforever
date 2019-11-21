
<div class="col-md-7 col-lg-6  bg-light login">
        <?= $this->Form->create('user') ?>
            <fieldset>
                <h1 class="text-center"><?= __('Login') ?></h1>
                <?= $this->Form->control('email') ?>
                <?= $this->Form->control('password') ?>
   <?= $this->Form->button(__('Login'),['class'=>'btn btn-primary form-control mb-3']) ?>
</fieldset>
<?= $this->Form->end() ?>
</div>

