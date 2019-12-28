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
            <?= $this->Form->create('post') ?>
                <div>
                	<?= $this->Form->textarea('content', ['type' => 'textarea', 'label' => false, 'placeholder'=> 'what is your mind...', 'escape' => false,'class' =>'comment', 'style' => 'width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']); ?>
                </div>
                <div class="box-footer clearfix">
                    <button type="button" class="pull-right btn post-button" id="uploadPost">Post<i class="fa fa-arrow-circle-right"></i></button>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section> 
