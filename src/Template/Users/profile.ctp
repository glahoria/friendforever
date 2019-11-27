<section class="content">
<div class="box box-warning">
  <div class="box-header with-border">
    <label class="box-title">Profile</label>
  </div>
  <div class="container">
        <div class="h-100">
          <div class="image_outer_container">
            <div class="image_inner_container">
              <img src="<?= SITE_URL; ?>img/user2-160x160.jpg" class="user-image" alt="User Image">
            </div>
          </div>
        </div>
  </div>
  <?= $this->Form->create('user') ?>
        <div class="box-body col-md-6">
          <div class="form-group">
            <?= $this->Form->control(
              'First Name',
            [ 
              'class' => 'form-control',
              'placeholder' => 'First Name',
              'name' => 'first_name'
            ]) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->control(
              'email',
            [ 
              'class' => 'form-control',
              'placeholder' => 'Email',
              'name' => 'email'
            ]) ?>
          </div>
          </div>
        <div class="box-body col-md-6">
          <div class="form-group">
              <?= $this->Form->control(
                'Last Name',
              [ 
                'class' => 'form-control',
                'placeholder' => 'Last Name',
                'name' => 'last_name'
              ]) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->control(
              'Phone',
            [ 
              'class' => 'form-control',
              'placeholder' => 'Phone',
              'name' => 'Phone'
            ]) ?>
          </div>   
        </div>
        <div class="box-footer">
          <?= $this->Form->button(__('Save'),['class'=>'btn  pull-right mt-3 profile-button' ]) ?>
          
        </div>
  <?= $this->Form->end() ?>
</div>
</section>