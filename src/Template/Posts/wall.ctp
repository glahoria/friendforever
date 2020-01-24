<style>
    .button-style {
        border-radius: 1px;
        background: #004ea6;
        color: white;
    }

    .comment-button {
        border-radius: 1px;
        background: #004ea6;
        color: white;
    }

    .post-margin {
        width: 100%;
        height: 20px;
        background: rgb(192, 208, 214);
    }

    #imagePreview {
        display: block;
        width: auto;
        height: 200px;
        float: left;
    }
    .post-image{
        width: 50%;
        height: 50%;
        float: left;
    }
</style>
<section class="content">

    <!-------------post upload div ----------------------->

    <div class="box box-success">
        <!-- <div class="box-header" style="background: #B8BFC5;color: black">
            <h3 class="box-title">Create Post</h3>
        </div> -->
        <div class="box-body">
            <?= $this->Form->create('', ['id' => 'savePost', 'enctype' => 'multipart/form-data']) ?>
            <div>
                <?= $this->Form->textarea('content', ['type' => 'textarea', 'label' => false, 'placeholder' => 'what is in your mind...', 'escape' => false, 'style' => 'width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;', 'id' => 'content','name'=>'content']) ?>
            </div>

            <div class="box-footer clearfix">
                <?= $this->Form->button(__('post <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'pull-right btn button-style', 'type' => 'submit']) ?>
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

<!-------------post loader div ----------------------->

    <div id="postLoader"><h4 class="text-center" style="padding: 20px; color: #225DDB;"><i
                    class="fa fa-spin fa-spinner"></i>
            Loading ...</h4>
    </div>

<!-------------- Modal content--------------------------->

    <!-- <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn button-style">Save</button>
                </div>
            </div>
        </div>
    </div> -->
 
<!-------------latest post div ----------------------->
    <section class="content">
        <div id="latestPosts" class="row"></div>
    </section>
    <!--        <div class="row">-->
    <!--            <div class="col-md-12"><button class="btn btn-primary w-100" style="width: 100%;"><i class="fa fa-refresh"></i> Load More</button> </div>-->
    <!--        </div>-->

    </div>
</section>

<script type="text/javascript">

    //---------------------upload post function ----------------------------

    $(document).ready(function () {
        $('#savePost').submit(function () {
            var postData = $(this).serialize();
            var post = $('#content').val();

            // if (post == '') {
            //
            // } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= SITE_URL; ?>posts/save',
                    data: postData,
                    dataType: "JSON",
                    success: function (resp) {
                        var post = resp.post;
                        var p = `<div style="padding: 50px;background:white;">
                                        <h4 style="text-transform:uppercase; font-weight:bold;color:#4D3F3F; ">
                                                <span class="pull-left">
                                                    ${post.user.first_name} ${post.user.last_name}
                                                </span>
                                        </h4>
                                        <span class="pull-right">
                                            ${post.user_id == <?= $authUser['id'] ?> ?
                                                `<a href="<?= SITE_URL; ?>posts/edit/${post.id}" style="padding:7px;color:#F6BC64;"><i class="fa fa-pencil" id="edit_${post.id}"></i></a><a href="#" style="padding:7px;color:#D45C4A;"><i class="fa fa-trash delete" id="delete_${post.id}"></i></a><a href="#" style="padding:7px;color:#3289F5;"><i class="fa fa-share"></i> </a>`
                                                : `<a href="#" style="color:#3289F5;"><i class="fa fa-share"></i></a>`
                                            }
                                        </span>
                                        <br /><br />
                                        <div class="post-image1" style="display: ${post.post_images.length > 0 ? 'block': 'none'}">
                                        ${post.post_images.map(function (postImage) {
                            return "<img src='<?= SITE_URL; ?>" + postImage.image.image + "' style='height:300px;' />"
                        }).join("")}
</div>
<br />
                                        <p class"message" style="text-align:justify;font-family:'Montserrat', sans-serif;color:#686868;">${post.content}</p>
                                        <br/>
                                        <p>
                                            <span title="No. of Likes" class="like-me" id="like_${post.id}" style="color:#2C6FAE; font-size: 30px; cursor: pointer;" ><i class="fa fa-thumbs${post.likes.length > 0 ? '' : '-o'}-up"></i> <span id="like_count_${post.id}" style="font-size: 16px;color:black;">${post.no_of_likes} </span></span>
                                            <span class="open-comments" id="comment_${post.id}" style="color:red;font-size: 30px; cursor: pointer;"><i class="fa fa-comment-o " id="comment"></i> <span style="font-size: 16px;color:black;" title="No. of Comments" id="comment_count_${post.comment}"> ${post.no_of_comments} </span> </span>
                                        </p>
                                        <small class=" pull-right" style="color: #999999"><i class="fa fa-clock-o"></i>
                                                    ${post.created}
                                        </small>
                                        <hr>
                                        <div class="commentWrapper_${post.id}" style="display: none;">
                                            <div id="commentSection_${post.id}">
                                             </div>
                                        <form method="post" accept-charset="utf-8" id="saveComment_${post.id}" class="comment-form">
                                            <div class="input-group" style="width:100%;">
                                              <input name="post_id" value="${post.id}" type="hidden" class="form-control" style="border-radius:0px;"/>
                                             <input name="comment" type="text" id="commentInput_${post.id}" class="form-control" placeholder="comment..." style="border-radius:0px;"/>
                                             <span class="input-group-btn">
                                             <button class="btn  pull-right form-control comment-button" id="commentBtn_${post.id}"><i class="fa fa-arrow-circle-right"></i></botton>
                                             </span>
                                            </div> 
                                             </form>
                                        </div>
                                        </div>
                                    <div class="post-margin"></div>`;

                        $('#latestPosts').prepend(p);
                    }

                });
            //}
            $('#content').val(" ");
             $('#imagePreview').hide();
            return false;

        });

        setTimeout(function () {
            getPosts();
        }, 1000);

//------------------- get post function script -----------------------

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
                            var p = `<div id="postWrapper_${post.id}" style="padding: 50px;background:white;">
                                        <h4 style="text-transform:uppercase; font-weight:bold;color:#4D3F3F; ">
                                                <span class="pull-left">
                                                    ${post.user.first_name} ${post.user.last_name}
                                                </span>
                                        </h4>
                                        <span class="pull-right">
                                            ${post.user_id == <?= $authUser['id'] ?> ?
                                                `<a href="<?= SITE_URL; ?>posts/edit/${post.id}" style="padding:7px;color:#F6BC64;"><i class="fa fa-pencil" id="edit_${post.id}"></i></a><a href="#" style="padding:7px;color:#D45C4A;"><i class="fa fa-trash delete" id="delete_${post.id}"></i></a><a href="#" style="padding:7px;color:#3289F5;"><i class="fa fa-share"></i> </a>`
                                                : `<a href="#" style="color:#3289F5;"><i class="fa fa-share"></i></a>`
                                            }
                                        </span>
                                        <br /><br />
                                        <div class="post-image1" style="display: ${post.post_images.length > 0 ? 'block': 'none'}">
                                        ${post.post_images.map(function (postImage) {
                            return "<img src='<?= SITE_URL; ?>" + postImage.image.image + "' style='height:300px;' />"
                        }).join("")}
</div>
<br />
                                        <p class"message" style="text-align:justify;font-family:'Montserrat', sans-serif;color:#686868;">${post.content}</p>
                                        <br/>
                                        <p>
                                            <span title="No. of Likes" class="like-me" id="like_${post.id}" style="color:#2C6FAE; font-size: 30px; cursor: pointer;" ><i class="fa fa-thumbs${post.likes.length > 0 ? '' : '-o'}-up"></i> <span id="like_count_${post.id}" style="font-size: 16px;color:black;">${post.no_of_likes} </span></span>
                                            <span class="open-comments" id="comment_${post.id}" style="color:red;font-size: 30px; cursor: pointer;"><i class="fa fa-comment-o " id="comment"></i> <span style="font-size: 16px;color:black;" title="No. of Comments" id="comment_count_${post.comment}"> ${post.no_of_comments} </span> </span>
                                        </p>
                                        <small class=" pull-right" style="color: #999999"><i class="fa fa-clock-o"></i>
                                                    ${post.created}
                                        </small>
                                        <hr>
                                        <div class="commentWrapper_${post.id}" style="display: none;">
                                            <div id="commentSection_${post.id}">
                                             </div>
                                        <form method="post" accept-charset="utf-8" id="saveComment_${post.id}" class="comment-form">
                                            <div class="input-group" style="width:100%;">
                                              <input name="post_id" value="${post.id}" type="hidden" class="form-control" style="border-radius:0px;"/>
                                             <input name="comment" type="text" id="commentInput_${post.id}" class="form-control" placeholder="comment..." style="border-radius:0px;"/>
                                             <span class="input-group-btn">
                                             <button class="btn  pull-right form-control comment-button" id="commentBtn_${post.id}"><i class="fa fa-arrow-circle-right"></i></botton>
                                             </span>
                                            </div> 
                                             </form>
                                        </div>
                                        </div>
                                    <div class="post-margin"></div>`;

                            $('#latestPosts').append(p);

                        });
                    }
                }

            });
        }

//--------------- likes function script-------------------------------

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

//-------------------show comment-wrapper function-----------------------------------

        $("#latestPosts").on('click', '.open-comments', function () {
            var postId = $(this).attr('id').split('_')[1];
            $(".commentWrapper_" + postId).show();
            getComments($(this).attr('id').split('_')[1]);
        });

//------------------- post comments function -----------------------------------------

        $('#latestPosts').on('click', '.comment-button', function (e) {
            e.preventDefault();
            var postId = $(this).attr('id').split('_')[1];
            var commentData = $('#saveComment_' + postId).serialize();
            var commentType = $('#commentInput_' + postId).val();
            //console.log(comment);
            if (commentType == '') {

            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= SITE_URL; ?>posts/comment',
                    data: commentData,
                    dataType: "JSON",
                    success: function (resp) {
                        var comment = resp.comment;
                        var c = `
                                    <div class="row" style="padding:5px;">
                                        <div class="col-md-11">
                                            <span>
                                                <span class="pull-left" style="color:#4D3F3F;font-size:15px;font-weight:bold;text-transform:uppercase;">
                                                    ${comment.user.first_name} ${comment.user.last_name}
                                                </span>
                                                <p class="pull-left" style="font-family:'Montserrat', sans-serif;color:black; font-size:13px; margin-left:1%;font-weight:bold; padding:2px;">${comment.comment}
                                                </p>
                                            </span>
                                            <p class="pull-left" style="color:#999999;font-size:12px;width:100% ;"><i class="fa fa-clock-o"></i>
                                                    ${comment.created}
                                            </p>
                                        </div>
                                    </div>`;
                        $('#commentSection_' + postId).append(c);

                    }
                });
            }
            $('#commentInput_' + postId).val("");
            return false;
        });

//-----------------------get Comment function script-----------------------------

        function getComments(postId) {
            $.ajax({
                type: 'GET',
                url: '<?= SITE_URL; ?>posts/get-comments/' + postId,
                dataType: 'JSON',
                success: function (resp) {
                    if (resp.comments.length > 0) {
                        $.each(resp.comments, function (ind, comment) {
                            var c = `
                                    <div class="row" style="padding:5px;">
                                        <div class="col-md-11">
                                            <span>
                                                <span class="pull-left" style="color:#4D3F3F;font-size:15px;font-weight:bold;text-transform:uppercase;">
                                                    ${comment.user.first_name} ${comment.user.last_name}
                                                </span>
                                                <p class="pull-left" style="font-family:'Montserrat', sans-serif;color:black; font-size:13px; margin-left:1%;font-weight:bold; padding:2px;">${comment.comment}
                                                </p>
                                            </span>
                                            <p class="pull-left" style="color:#999999;font-size:12px;width:100%; "><i class="fa fa-clock-o"></i>
                                                    ${comment.created}
                                            </p>
                                        </div>
                                    </div>`;
                            $('#commentSection_' + postId).append(c);
                        });

                    }
                }
            })
        }

//----------------------image upload function on wall------------------------------------

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
            $('#imageType').val(input.files[0].type);
            console.log(input.files[0]);
        }

        $("#choiceFile").change(function () {
            readURL(this);
        });

//----------------------image upload function on wall------------------------------------

        $('#latestPosts').on('click', '.delete', function (e) {
            e.preventDefault();
            var id = $(this).attr('id').split('_')[1];
            if(confirm("Are you sure you want to delete post?")){
                $.ajax({
                    type: 'POST',
                    url: '<?= SITE_URL; ?>posts/delete/'+id,
                    success: function(resp){   

                    }
                });
                $(this).parents('#postWrapper_'+id).animate({ backgroundColor: "#F0B78F" }, "fast")
                .animate({ opacity: "hide" }, "slow");
            }
            return false;
        });

    });
</script>

