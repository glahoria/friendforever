<div class=" login col-md-4 col-lg-4 m-auto">
    <?php echo $this->Form->create('user', ['id'=>'resetPassword']) ?>
    <fieldset style="background-color: white;">
        <h3 class="text-center" style="font-weight: bold; color: orange; font-size: 30px;">Reset Password</h3>
    <?php
        echo $this->Form->input('password', ['required' => true, 'autofocus' => true]); ?>
    <?php 
        echo $this->Form->input('confirm_password', ['type' => 'password', 'required' => true]);
    ?>
    <?php echo $this->Form->button(__('Submit')); ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<script>
    $(function () {
        $('#resetPassword').validate({
            rules:{
                password:{
                    required:true,
                },
                confirm_password:{
                    required:true,
                    equalTo: password
                }
            },
            messages:{
                password:{
                    required:'Please enter password',
                },
                confirm_password:{
                    required:'Please enter confirm password',
                    equalTo: 'Password does not match'
                }
            },
        });
    });

</script>