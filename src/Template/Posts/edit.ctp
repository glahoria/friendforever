<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */

?>
<style>
    .button-style {
        border-radius: 1px;
        background: #004ea6;
        color: white;
    }
</style>
<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <div class="row">
                  <?= $this->Form->create($post) ?>
                      <div class="col-md-12">
                          <img src='<?= SITE_URL.$post->post_images[0]->image->image; ?>'  id="image" style="height:200px; "/>
                      <br />
                          <?= $this->Form->textarea('content', ['type' => 'textarea', 'label' => false, 'escape' => false, 'style' => 'width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;', 'id' => 'content','name'=>'content']) ?>
            <div class="box-footer clearfix">
                <?= $this->Form->button(__('save <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'pull-right btn button-style', 'type' => 'submit']) ?>
                           <img src="" id="imagePreview" style="display:none"/>
                <input type="file" name="image" class="form-control" id="choiceFile" style="display: none;">
                <input type="hidden" name="image_data" class="form-control" id="imageData" style="display: none;">
                <input type="hidden" name="image_type" class="form-control" id="imageType" style="display: none;">
                <span class="btn  pull-right" style="margin-right:2%;border-radius:15px;background: #D5D3D3;" id="photoButton"><i
                            class="fa fa-camera"></i> Photo
                </span>

            </div>
                          <?= $this->Form->end() ?>
                      </div>
</div>
    </div>
    </div>
</section>
