<style>
    .post-button {
        border-radius: 1px;
        background: #004ea6;
        color: white;
    }
</style>
<section class="content">
    <div class="box box-success">
        <!-- <div class="box-header" style="background: #B8BFC5;color: black">
            <h3 class="box-title">Create Post</h3>
        </div> -->
        <div class="box-body">
            <?= $this->Form->create('', ['id' => 'savePost']) ?>
            <div>
                <?= $this->Form->textarea('content', ['type' => 'textarea', 'label' => false, 'placeholder' => 'what is in your mind...', 'escape' => false, 'class' => 'comment', 'style' => 'width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;', 'id' => 'content']) ?>
            </div>

            <div class="box-footer clearfix">
                <?= $this->Form->button(__('post <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'pull-right btn post-button', 'type' => 'submit']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <div id="latestPosts" class="row">
        </div>
        <div id="postLoader"><h4 class="text-center" style="padding: 20px;"><i class="fa fa-spin fa-spinner"></i> Loading ...</h4></div>
        <!--        <div class="row">-->
        <!--            <div class="col-md-12"><button class="btn btn-primary w-100" style="width: 100%;"><i class="fa fa-refresh"></i> Load More</button> </div>-->
        <!--        </div>-->

    </div>
</section>
<script type="text/javascript">


    $(document).ready(function () {
        $('#savePost').submit(function () {
            var postData = $(this).serialize();
            var post = $('#content').val(); 
            if (post == '') {

            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= SITE_URL; ?>posts/save',
                    data: postData,
                    dataType: "JSON",
                    success: function (resp) {
                        var post = resp.post;
                        var p = `<section class="content">
                                    <div class="col-md-12 p-5 box-footer" style="padding: 50px;">
                                        <h4 class="text-primary" style="text-transform:uppercase; font-weight:bold; ">
                                                <span class="pull-left">
                                                    ${post.user.first_name} ${post.user.last_name}
                                                </span>
                                                <span class="pull-right" style="color:#939DA5">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </span>
                                        </h4><br /><br />
                                        <p class="message">${post.content}</p>
                                        <br/>
                                        <p style="font-size: 16px;">
                                            <span title="No. of Likes" style="color:#2C6FAE;"><i class="fa fa-thumbs-o-up"></i> ${post.no_of_likes} </span>
                                            <span title="No. of Comments" style="color:red;"><i class="fa fa-comment-o"></i> ${post.no_of_comments} </span>
                                            <small class="text-muted pull-right" style="color: #999999"><i class="fa fa-clock-o"></i>
                                                    ${post.created}
                                                </small>
                                        </p>
                                    </div>
                                </section>`;

                        $('#latestPosts').prepend(p);
                    }

                });
            }
            this.reset();
            return false;

        });

        setTimeout(function () {
            getPosts();
        }, 1000);

        function getPosts() {
            $.ajax({
                type: 'GET',
                url: '<?= SITE_URL; ?>posts/get-posts',
                dataType: "JSON",
                beforeSend: function () {
                    $('#postLoader').show();
                },
                success: function (resp) {
                    $('#postLoader').fadeOut();
                    if (resp.posts.length > 0) {
                        $.each(resp.posts, function (ind, post) {
                            // console.log(post);
                            var p = `<section class="content">
                                        <div class="col-md-12 p-5 box-footer" style="padding: 50px;">
                                        <h4 class="text-primary" style="text-transform:uppercase; font-weight:bold; ">
                                                <span class="pull-left">
                                                    ${post.user.first_name} ${post.user.last_name}
                                                </span>
                                        </h4><br /><br />
                                        <p >${post.content}</p>
                                        <br/>
                                        <p style="font-size: 16px; color:red;">
                                            <span title="No. of Likes" style="color:#2C6FAE;"><i class="fa fa-thumbs-o-up"></i> ${post.no_of_likes} </span>
                                            <span title="No. of Comments" style="color:red;"><i class="fa fa-comment-o"></i> ${post.no_of_comments} </span>
                                            <small class="text-muted pull-right" style="color: #999999"><i class="fa fa-clock-o"></i>
                                                    ${post.created}
                                            </small>
                                        </p>
                                        </div>
                                    </section>`;

                            $('#latestPosts').append(p);

                        });
                    }
                }

            });
        }
        

    });
</script>

