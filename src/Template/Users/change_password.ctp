<section class="content ">
<div class="box box-warning">
  <div class="box-header with-border">
    <label class="box-title">Change Password</label>
  </div>
  <?= $this->Form->create('user') ?>
        <div class="box-body ">
          <div class="form-group">
            <?= $this->Form->control(
              'Current Password',
            [ 
              'class' => 'form-control',
              'placeholder' => 'Current Password'
            ]) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->control(
              'New Password',
            [ 
              'class' => 'form-control',
              'placeholder' => 'New Password'
            ]) ?>
          </div>
          <div class="form-group">
              <?= $this->Form->control(
                'Confirm Password',
              [ 
                'class' => 'form-control',
                'placeholder' => 'Confirm Password',
              ]) ?>
          </div>
        </div>
        <div class="box-footer">
          <?= $this->Form->button(__('Change Password'),['class'=>'btn  pull-right mt-3 profile-button' ]) ?>
          
        </div>
  <?= $this->Form->end() ?>
</div>
</section>
