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
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
        <div class="box-body">
            <?= $this->Form->create('user') ?>
                <div>
                	<textarea class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="box-footer clearfix">
                    <button type="button" class="pull-right btn post-button" id="uploadPost">Post<i class="fa fa-arrow-circle-right"></i></button>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section> 
