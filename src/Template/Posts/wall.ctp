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
                <?= $this->Form->textarea('content', ['type' => 'textarea', 'label' => false, 'placeholder' => 'what is in your mind...', 'escape' => false,  'style' => 'width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;', 'id' => 'content']) ?>
            </div>

            <div class="box-footer clearfix">
                <?= $this->Form->button(__('post <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'pull-right btn post-button', 'type' => 'submit']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
        </div>
        <div id="postLoader"><h4 class="text-center" style="padding: 20px; color: #225DDB;"><i class="fa fa-spin fa-spinner"></i>
                Loading ...</h4></div>
        <div id="post_comment"></div>
        <?= $this->Form->create('', ['id' => 'comment_form']) ?>
            <input type="text" name="comment" id="comment" />
                <?= $this->Form->button(__('save <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'pull-right btn post-button', 'type' => 'submit', 'id'=>'submit']) ?>
        <?= $this->Form->end() ?>        
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
                                            <span title="No. of Likes" class="like-me" id="like_${post.id}" style="color:#2C6FAE; font-size: 30px; cursor: pointer;" ><i class="fa fa-thumbs${post.likes.length > 0 ? '' : '-o'}-up"></i> <span id="like_count_${post.id}" style="font-size: 16px;color:black;">${post.no_of_likes} </span></span>
                                            <span title="No. of Comments" id="comment_${post.id}"  style="color:red;font-size: 30px; cursor: pointer;"><i class="fa fa-comment-o comment"></i> <span style="font-size: 16px;color:black;" id="comment_count_${post.comment}"> ${post.no_of_comments} </span> </span>
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
                type: 'POST',
                url: '<?= SITE_URL; ?>posts/like',
                dataType: "JSON",
                data: {post_id: id, action: action},
                beforeSend: function () {
                    //$('#postLoader').show();
                },
                success: function (resp) {

                    var currentCount = parseInt($('#like_count_'+id).html());
                    if(resp.current_status == "liked"){
                        $('#like_'+id).children('i').removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up');
                        currentCount = currentCount +1;

                    } else {
                        $('#like_'+id).children('i').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
                        currentCount = currentCount -1;
                    }

                    $('#like_count_'+id).html(currentCount);
                }
            });


        });
        $('#comment_form').on('click','#submit', function(e){
        e.preventDefault();
            var commentData = $(this).serialize();
            var comment = $('#Comment').val();
            //console.log(comment)
            if (comment == '') {

            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= SITE_URL; ?>posts/comment',
                    data: commentData,
                    dataType: "JSON",
                    success: function (resp) {
                         //console.log(resp);
                        var comment = resp.comment;
                        var p =  `<div class="col-md-12">
                                    <p>${post.comment.comment}</p>
                                    </div>`;

                        $('#post_comment').prepend(p);
                    }
                });
            }
        });
// function get_comment(){
//   $.ajax({
//     type:"GET",
//     url:'<?= SITE_URL; ?>posts/get-comment',
//     dataType: "JSON",
//     success:function(resp)
//    {
//     $.each(resp.comment, function (ind, comment) {
//                              console.log(comment);
//                             var p = $('#display_comment').html(resp);
//                             $('#post_comment').append(p);

//                         });
//                     }

//     });
// }
});
</script>

