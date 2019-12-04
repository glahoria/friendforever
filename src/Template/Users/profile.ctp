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
  <?= $this->Form->create($user, ['id'=>'profileForm']) ?>
        <div class="box-body col-md-6">
          <div class="form-group">
            <?= $this->Form->control('first_name',['class' => 'form-control','placeholder' => 'First Name']) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->control('email',[ 'class' => 'form-control','placeholder' => 'Email']) ?>
          </div>
          </div>
        <div class="box-body col-md-6">
          <div class="form-group">
              <?= $this->Form->control('last_name', [ 'class' => 'form-control', 'placeholder' => 'Last Name']) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->control('phone',['class' => 'form-control','placeholder' => 'Phone']) ?>
          </div>   
        </div>
        <div class="box-footer">
          <?= $this->Form->button(__('Save'),['class'=>'btn  pull-right mt-3 profile-button' ]) ?>
          
        </div>
  <?= $this->Form->end() ?>
</div>
</section>
<script>
    $(function () {
        $('#profileForm').validate({
            rules:{

            },
            messages:{

            }
        });
    });
</script>