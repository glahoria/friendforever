<style>
  .form-control{
    background-color:#ECECEC;
    border-radius:1px;
    border:1px solid #2E6A07;
  }
  .btn{
    border-radius:1px;
  }
</style>
<section class="content ">
<div class="box box-warning">
  <div class="box-header with-border">
    <label class="box-title">Change Password</label>
  </div>
  <?= $this->Form->create('user', ['id'=>'changePasswordForm']) ?>
        <div class="box-body ">
          <div class="form-group">
            <?= $this->Form->control('current_password',[ 'class' => 'form-control', 'placeholder' => 'Current Password' ]) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->control('password',[  'class' => 'form-control', 'placeholder' => 'New Password' ]) ?>
          </div>
          <div class="form-group">
              <?= $this->Form->control(
                'confirm_password', [  'class' => 'form-control', 'placeholder' => 'Confirm Password' ]) ?>
          </div>
        </div>
        <div class="box-footer">
          <?= $this->Form->button(__('Change Password'),['class'=>'btn  pull-right mt-3 profile-button' ]) ?>
          
        </div>
  <?= $this->Form->end() ?>
</div>
</section>
<script>
    $(function () {
            $('#changePasswordForm').validate({
                rules:{
                    current_password:{
                        required:true,
                    },
                    password:{
                        required:true,
                    },
                    confirm_password:{
                        required:true,
                    }
                },
                messages:{
                    current_password:{
                        required:"please enter current password.",       
                    },
                    password:{
                        required:"please enter password.",       
                    },
                    confirm_password:{
                        required:"please confirm password.",      
                    }
                },  
            });            
        });

</script>

