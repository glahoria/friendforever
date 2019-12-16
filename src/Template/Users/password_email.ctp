
<div class="login col-md-4 col-lg-4 m-auto">
    
  <?= $this->Form->create()?>
<fieldset style="background-color: white;">
                <h3 class="text-center" style="font-weight: bold; color: orange; font-size: 30px;">Forgot Password</h3>
                <p>if you've lost your password or wish to reset it, enter  your valid email</p>
    <?= $this->Form->input('Enter valid email', ['class' => 'form-group','autocomplete' => 'off' ,'required' => 'required'])?>    
    <?= $this->Form->button(__('Login'),['class'=>'mt-3']) ?>
</fieldset>

        <?= $this->Form->end() ?>
</div>