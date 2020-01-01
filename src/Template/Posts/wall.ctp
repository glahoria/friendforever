<style>
  .post-button{
    border-radius:1px;
    background: #004ea6;
    color: white;
  }
</style>
<section class="content">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Create Post</h3>
        </div>
        <div class="box-body">
            <?= $this->Form->create('',['id'=>'savePost','action'=>'wall']) ?>
                <div>
                    <?= $this->Form->textarea('content', ['type' => 'textarea', 'label' => false, 'placeholder'=> 'what is your mind...', 'escape' => false,'class' =>'comment', 'style' => 'width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;border-radius:5px;','id'=>'content']) ?>
                </div>
                
                <div class="box-footer clearfix">
                <?= $this->Form->button(__('post <i class="fa fa-arrow-circle-right"></i>'),['class'=>'pull-right btn post-button','type'=>'submit'])?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section> 
<script type="text/javascript">
    $(document).ready(function () {
        $('#savePost').submit(function(){
            var formData = $(this).serialize();
            var formUrl = $(this).attr('action');
            // var post = $('#content').val();
            $.ajax({
                type: 'POST',
                url: formUrl,
                data: formData,
            }); 
            return false;
        });
    });
</script>

