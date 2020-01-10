<style>
    .post-button {
        border-radius: 1px;
        background: #004ea6;
        color: white;
    }

    .post-margin {
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
                <?= $this->Form->textarea('content', ['type' => 'textarea', 'label' => false, 'placeholder' => 'what is in your mind...', 'escape' => false, 'style' => 'width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;', 'id' => 'content']) ?>
            </div>

            <div class="box-footer clearfix">
                <?= $this->Form->button(__('post <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'pull-right btn post-button', 'type' => 'submit']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div id="postLoader"><h4 class="text-center" style="padding: 20px; color: #225DDB;"><i
                    class="fa fa-spin fa-spinner"></i>
            Loading ...</h4></div>
    <section class="content">
        <div id="latestPosts" class="row"></div>
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
            console.log(post);
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
                                            <span title="No. of Likes" class="like-me" id="like_${post.id}" style="color:#2C6FAE; font-size: 30px; cursor: pointer;" ><i class="fa fa-thumbs${post.likes.length > 0 ? '' : '-o'}-up"></i> <span id="like_count_${post.id}" style="font-size: 16px;color:black;">${post.no_of_likes} </span></span>
                                            <span title="No. of Comments" id="comment_${post.id}" style="color:red;font-size: 30px; cursor: pointer;"><i class="fa fa-comment-o " id="comment"></i> <span style="font-size: 16px;color:black;" id="comment_count_${post.comment}"> ${post.no_of_comments} </span> </span>
                                            <small class=" pull-right" style="color: #999999"><i class="fa fa-clock-o"></i>
                                                    ${post.created}
                                            </small>
                                        </p><hr>
                                        <div class="comment_wrapper" style="display: none;">
                                            <?= $this->Form->create('', ['id' => 'save_comment']) ?>
                                              <div class="col-md-11">
                                              <input name="post_id" value="${post.id}" type="hidden" class="form-control" style="border-radius:0px;"/>
                                             <input name="comment" type="text" id="comment_input" class="form-control" placeholder="comment..." style="border-radius:0px;"/>
                                             </div>
                                             <div class="col-md-1">
                                             <button class="btn btn-primary pull-right form-control post-button" id="send"><i class="fa fa-arrow-circle-right"></i></botton>
                                             </div>
                                             <?= $this->Form->end() ?>
                                             <div class="post_comment">
                                             
                                             </div>
                                        </div>
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
                                            <span title="No. of Likes" class="like-me" id="like_${post.id}" style="color:#2C6FAE; font-size: 30px; cursor: pointer;" ><i class="fa fa-thumbs${post.likes.length > 0 ? '' : '-o'}-up"></i> <span id="like_count_${post.id}" style="font-size: 16px;color:black;">${post.no_of_likes} </span></span>
                                            <span title="No. of Comments" class="open-comments" id="comment_${post.id}" style="color:red;font-size: 30px; cursor: pointer;"><i class="fa fa-comment-o " id="comment"></i> <span style="font-size: 16px;color:black;" id="comment_count_${post.comment}"> ${post.no_of_comments} </span> </span>
                                            <small class=" pull-right" style="color: #999999"><i class="fa fa-clock-o"></i>
                                                    ${post.created}
                                            </small>
                                        </p><hr>
                                        <div class="comment_wrapper" style="display: none;">
                                        <form method="post" accept-charset="utf-8" id="saveComment_${post.id}" class="comment-form">
                                        <div style="display:none;">
                                        <input type="hidden" name="_method" value="POST"/></div>
                                              <div class="col-md-11">
                                              <input name="post_id" value="${post.id}" type="hidden" class="form-control" style="border-radius:0px;"/>
                                             <input name="comment" type="text" id="commentInput_${post.id}" class="form-control" placeholder="comment..." style="border-radius:0px;"/>
                                             </div>
                                             <div class="col-md-1">
                                             <button class="btn btn-primary pull-right form-control comment-button" id="commentBtn_${post.id}"><i class="fa fa-arrow-circle-right"></i></botton>
                                             </div>
                                             </form>
                                             <div class="post_comments" id="comment_${post.id}">
                                             </div>
                                        </div>
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
                type: 'POST',
                url: '<?= SITE_URL; ?>posts/like',
                dataType: "JSON",
                data: {post_id: id, action: action},
                beforeSend: function () {
                    //$('#postLoader').show();
                },
                success: function (resp) {

                    var currentCount = parseInt($('#like_count_' + id).html());
                    if (resp.current_status == "liked") {
                        $('#like_' + id).children('i').removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up');
                        currentCount = currentCount + 1;

                    } else {
                        $('#like_' + id).children('i').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
                        currentCount = currentCount - 1;
                    }

                    $('#like_count_' + id).html(currentCount);
                }
            });


        });
        $("#latestPosts").on('click', '.open-comments', function () {
            $(".comment_wrapper").show();
            getComments($(this).attr('id').split('_')[1]);
        });
        $('#latestPosts').on('click', '.comment-button', function (e) {
            e.preventDefault();
            var postId  = $(this).attr('id').split('_')[1];
            var commentData = $('#saveComment_'+postId).serialize();
            var comment = $('#commentInput_'+postId).val();
            //console.log(comment);
            if (comment == '') {

            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= SITE_URL; ?>posts/comment',
                    data: commentData,
                    dataType: "JSON",
                    success: function (resp) {

                    }
                });
            }
            $('#commentInput_'+postId).val("");
            return false;
        });

        //getComments();

        function getComments(postId) {
            $.ajax({
                type: 'GET',
                url: '<?= SITE_URL; ?>posts/get-comments/' + postId,
                dataType: 'JSON',
                success: function (resp) {

                    if (resp.comments.length > 0) {
                        $.each(resp.comments, function (ind, comment) {


                            var c = `
                                        <div class="box-footer" style="padding: 50px;">
                                        <h5 class="text-primary pull-left" style="text-transform:uppercase; font-weight:bold; ">
                                                <span class="pull-left">
                                                    ${comment.user.first_name} ${comment.user.last_name}
                                                </span>
                                        </h5>
                                        <p class"pull-right" style="text-align:center;font-family:'Montserrat', sans-serif;color:#686868; font-size:15px;">${comment.comment}</p>
                                        <br/>

                                            <small class=" pull-right" style="color: #999999 "><i class="fa fa-clock-o"></i>
                                                    ${comment.created}
                                            </small>

                                        </div>`;

                            $('#comment_' + postId).append(c);

                        });
                    }

                }
            })
        }
    });
</script>

