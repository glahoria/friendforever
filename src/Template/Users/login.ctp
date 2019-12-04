
<div class="login col-md-4 col-lg-4 m-auto">
        <?= $this->Form->create('user') ?>
            <fieldset>
                <h1 class="text-center "><?= __('Login') ?></h1>
                <?= $this->Form->control('email') ?>
                <?= $this->Form->control('password') ?>
                <?= $this->Form->button(__('Login'),['class'=>'btn btn-primary form-control mt-3']) ?>
                <?= $this->Html->link('Forgot password',['controller'=>'users','action'=>'logout']) ?>
            </fieldset>

        <?= $this->Form->end() ?>
</div>

