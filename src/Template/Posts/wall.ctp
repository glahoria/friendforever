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
            <?= $this->Form->create($post) ?>
                <div>
                    <?= $this->Form->control('user_id', ['options' => $users,'type'=>'hidden']) ?>
                	<?= $this->Form->textarea('content', ['type' => 'textarea', 'label' => false, 'placeholder'=> 'what is your mind...', 'escape' => false,'class' =>'comment', 'style' => 'width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;border-radius:5px;']) ?>
                    <?= $this->Form->control('post_type',['type'=>'hidden']) ?>
                    <?= $this->Form->control('no_of_comments',['type'=>'hidden']) ?>
                    <?= $this->Form->control('no_of_likes',['type'=>'hidden']) ?>
                    <?= $this->Form->control('status',['type'=>'hidden']) ?>
                </div>
                <!--div class="box-footer clearfix">
                    <button type="hidden" class="pull-right btn post-button" id="uploadPost">Post<i class="fa fa-arrow-circle-right"></i></button>
                </div-->
                <div class="box-footer clearfix">
                <?= $this->Form->button(__('post <i class="fa fa-arrow-circle-right"></i>'),['class'=>'pull-right btn post-button'])?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section> 
