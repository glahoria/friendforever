<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
 //pr($user);
?>
<style>
    .button-style {
        border-radius: 1px;
        background: #004ea6;
        color: white;
    }
    .img-wrapper {
        position: relative;
        width: 350px;
    }
    .img-wrapper .close {
        position: absolute;
    top: 5px;
    right: 8px;
    z-index: 100;
    background-color: #FFF;
    padding: 4px 3px;
    
    color: #000;
    font-weight: bold;
    cursor: pointer;
   
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
    border:1px solid red;  
    }
    #imagePreview {
        display: block;
        width: auto;
        height: 200px;
        float: left;
    }
</style>
<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <div class="row">
                  <?= $this->Form->create($post) ?>
                      <div class="col-md-12">
                        <--?=
                           $image = $post->post_images[0];
                           pr($image);
                           if ($image > 0) { ?>
                           <div class="img-wrapper">
                               <span class="close">&times;</span>
                               <img src='<?= SITE_URL.$post->post_images[0]->image->image; ?>'  id="image" style="height:200px; "/>
                           </div> 
                         <--?= }
                           ?>     
                      <br /> <br />
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
<script>
  $(document).ready(function(){
   $('.close').click(function(){
    var id = '<?= $post->post_images[0]->id; ?>'
    console.log(id);
                $.ajax({
                    type: 'POST',
                    url: '<?= SITE_URL; ?>posts/image-delete/'+id,
                    success: function(resp){   

                    }
                });
                $(this).parents('#postWrapper_'+id).animate({ backgroundColor: "#F0B78F" }, "fast")
                .animate({ opacity: "hide" }, "slow");
            
            return false;
   });
   $("#photoButton").click(function () {
            $("#choiceFile").click();
        });
   function readURL(input) {
            var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
                var reader = new FileReader();
            reader.onload = function (input) {
                $('#imagePreview').attr('src', input.target.result);
                $('#imageData').val(input.target.result);
                $('#imagePreview').show();
            }
            reader.readAsDataURL(input.files[0]);
            console.log(input.files[0]);
            $('#imageType').val(input.files[0].type);
            console.log(input.files[0]);
        }

        $("#choiceFile").change(function () {
            readURL(this);
        });
  });
</script>
