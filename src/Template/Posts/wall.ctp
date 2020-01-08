<style>
    .post-button {
        border-radius: 1px;
        background: #004ea6;
        color: white;
    }
    .post-margin{
        width: 100%;
        height: 20px;
        background: rgb(192, 208, 214);
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
        </div>
        <div id="postLoader"><h4 class="text-center" style="padding: 20px; color: #225DDB;"><i class="fa fa-spin fa-spinner"></i>
                Loading ...</h4></div>
        <section class="content">
        <div id="latestPosts" class="row">
        </div>
        </section>
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
                        var p = `
                                    <div class="box-footer" style="padding: 50px;">
                                        <h4 class="text-primary" style="text-transform:uppercase; font-weight:bold; ">
                                                <span class="pull-left">
                                                    ${post.user.first_name} ${post.user.last_name}
                                                </span>
                                        </h4><br /><br />
                                        <p class"message" style="text-align:justify;font-family:'Montserrat', sans-serif;color:#686868;">${post.content}</p>
                                        <br/>
                                        <p>
                                            <span title="No. of Likes" class="like-me" id="like_${post.id}" style="color:#2C6FAE; font-size: 30px; cursor: pointer;" ><i class="fa fa-thumbs-o-up"></i> <span id="like_count_${post.id}" style="font-size: 16px;color:black;">${post.no_of_likes} </span></span>
                                            <span title="No. of Comments" style="color:red;font-size: 30px; cursor: pointer;"><i class="fa fa-comment-o"></i> <span style="font-size: 16px;color:black;"> ${post.no_of_comments} </span> </span>
                                            <small class=" pull-right" style="color: #999999"><i class="fa fa-clock-o"></i>
                                                    ${post.created}
                                            </small>
                                        </p>

                                    </div>
                                    <div class="post-margin"></div>`;

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
                            var p = `
                                        <div class="box-footer" style="padding: 50px;">
                                        <h4 class="text-primary" style="text-transform:uppercase; font-weight:bold; ">
                                                <span class="pull-left">
                                                    ${post.user.first_name} ${post.user.last_name}
                                                </span>
                                        </h4><br /><br />
                                        <p class"message" style="text-align:justify;font-family:'Montserrat', sans-serif;color:#686868;">${post.content}</p>
                                        <br/>
                                        <p>
                                            <span title="No. of Likes" class="like-me" id="like_${post.id}" style="color:#2C6FAE; font-size: 30px; cursor: pointer;" ><i class="fa fa-thumbs-o-up"></i> <span id="like_count_${post.id}" style="font-size: 16px;color:black;">${post.no_of_likes} </span></span>
                                            <span title="No. of Comments"  style="color:red;font-size: 30px; cursor: pointer;"><i class="fa fa-comment-o"></i> <span style="font-size: 16px;color:black;"> ${post.no_of_comments} </span> </span>
                                            <small class=" pull-right" style="color: #999999"><i class="fa fa-clock-o"></i>
                                                    ${post.created}
                                            </small>
                                        </p>
                                        </div>
                                    <div class="post-margin"></div>`;

                            $('#latestPosts').append(p);

                        });
                    }
                }

            });
        }

        $('#latestPosts').on('click', '.like-me', function (e) {
            e.preventDefault();
            var id = $(this).attr('id').split('_')[1];
            var action = $(this).children('i').hasClass('fa-thumbs-o-up') ? "like" : "unlike";
            $.ajax({
                type: 'GET',
                url: '<?= SITE_URL; ?>posts/like',
                dataType: "JSON",
                data: {id: id, action: action},
                beforeSend: function () {
                    $('#postLoader').show();
                },
                success: function (resp) {

                }
            });


        })


    });
</script>

