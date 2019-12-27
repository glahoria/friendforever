
<div class="login col-md-4 col-lg-4 m-auto">
        <?= $this->Form->create('user') ?>
            <fieldset style="background-color: white;box-shadow: 0 10px 15px rgba(0,0,0,0.3);">
                <h1 class="text-center "><?= __('Login') ?></h1>
                <?= $this->Form->control('email') ?>
                <?= $this->Form->control('password') ?>
                <?= $this->Form->button(__('Login'),['class'=>'btn btn-primary form-control mt-3']) ?>
                <?= $this->Html->link('Forgot password',['controller'=>'users','action'=>'forgot_password']) ?>
            </fieldset>

        <?= $this->Form->end() ?>
</div>

