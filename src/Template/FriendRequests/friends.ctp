<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FriendRequest $friendRequest
 */

?>
<style>
    .remove-button {
        border-radius: 1px;
        background: #736363;
        color: white;
    }

    .add-button {
        border-radius: 1px;
        background: #004ea6;
        color: white;
        margin-left: 5px;
    }
</style>
<section class="content">
    <div class="row">
        <section class="col-lg-7 connectedSortable">
            <?= $this->Form->create("", ['type' => 'get', 'id' => 'friendSearch']) ?>
            <?= $this->Form->control('friend_search', ['default' => $key = $this->request->query('key'), 'class' => 'form-control ', 'placeholder' => 'Search Friends..... ']); ?>
            <?= $this->Form->end() ?>
            <br/>
            <!-------------New Add Friends --------------------------->

            <div style="background: white;">
                <div id="addFriends"></div>
            </div>
            <br/>
            <!------------------- Friend Requests ------------->

            <div id="friendRequests" style="background: white;">
            </div>


        </section>

        <!------------friends list------------------------------------------>

        <section class="col-lg-4 connectedSortable">  <!-- Chat box -->
            <div id="friendsList" style="background: white;">
                <div>
                    <div class="box-header" style="background: white;">
                        <h3 class="box-title" style="background: white;color: black;font-weight: bold; width: 100%">
                            Friends</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            <li>
                                <img src="<?= SITE_URL; ?>img/user1-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Alexander Pierce</a>
                                <span class="users-list-date">Today</span>
                            </li>
                            <li>
                                <img src="<?= SITE_URL; ?>img/user8-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Norman</a>
                                <span class="users-list-date">Yesterday</span>
                            </li>
                            <li>
                                <img src="<?= SITE_URL; ?>img/user7-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Jane</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="<?= SITE_URL; ?>img/user6-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">John</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="<?= SITE_URL; ?>img/user2-160x160.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Alexander</a>
                                <span class="users-list-date">13 Jan</span>
                            </li>
                            <li>
                                <img src="<?= SITE_URL; ?>img/user5-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Sarah</a>
                                <span class="users-list-date">14 Jan</span>
                            </li>
                            <li>
                                <img src="<?= SITE_URL; ?>img/user4-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Nora</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                            <li>
                                <img src="<?= SITE_URL; ?>img/user3-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Nadia</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="javascript:void(0)" class="uppercase">View All Friends</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        </section>
        <!-- /.box (chat box) -->
    </div>
</section>

<script>
    $(document).ready(function () {

        $('#friendSearch').keyup(function () {
            var friendsData = $(this).serialize();
            $.ajax({
                type: 'GET',
                url: '<?= SITE_URL; ?>friend-requests/get-friends',
                data: friendsData,
                dataType: "JSON",
                beforeSend: function () {
                    $('#addFriends').html("");
                },
                success: function (resp) {

                    $.each(resp.users, function (ind, user) {
                        var c = `<div class="user-block" style="padding:10px;">
                        <span class="username">
                        <a href="#" style="text-transform:uppercase; font-weight:bold;color:#4D3F3F;">${user.first_name} ${user.last_name}</a>
                    <span class="pull-right">
                        <button class="btn btn-sm  add-button"  id="add_${user.id}">Add Friend</i></button>

                    </span>
                    </div>`;
                        $('#addFriends').append(c);

                    });

                }
            });
        });

        $('#addFriends').on('click', '.add-button', function (e) {
            e.preventDefault();
            var id = $(this).attr('id').split('_')[1];
            var requestData = {request_to_id: id};
            $.ajax({
                type: 'POST',
                url: '<?= SITE_URL; ?>friend-requests/send-request',
                data: requestData,
                dataType: "JSON",
                success: function (resp) {
                    var user = resp.friendRequest;
                    var r = `<div class="box-header" style="background: white;">
                    <h3 class="box-title" style="background: white;color: #9B9696;font-weight: bold; width: 100%">Friend
                        Requests
                        <hr>
                    </h3>
                </div>
<div class="user-block" style="padding:10px;">
                        <span class="username">
                        <a href="#" style="text-transform:uppercase; font-weight:bold;color:#4D3F3F;">${user.first_name} ${user.last_name}</a>
                    <span class="pull-right">
                        <button class="btn btn-sm  add-button"   id="confirm_${user.id}">Confirm</i></button>
                        <button class="btn btn-sm remove-button">Cancel</button>
                    </span>
                    </div>`;

                    $('#friendRequests').append(r);
                }

            });
        });

        setTimeout(function () {
            getRequests();
        }, 1000);

        function getRequests() {
            $.ajax({
                type: 'GET',
                url: '<?= SITE_URL; ?>friend-requests/get-requests',
                dataType: "JSON",
                success: function (resp) {
                    if (resp.friendRequests.length > 0) {
                        $.each(resp.friendRequests, function (ind, friendRequest) {
                                 console.log(friendRequest);
                                var f = `<div class="box-header" style="background: white;">
                    <h3 class="box-title" style="background: white;color: #9B9696;font-weight: bold; width: 100%">Friend
                        Requests
                        <hr>
                    </h3>
                </div>
<div class="user-block" style="padding:10px;">
                        <span class="username">
                        <a href="#" style="text-transform:uppercase; font-weight:bold;color:#4D3F3F;">${friendRequest.user.first_name} ${friendRequest.user.last_name}</a>
                    <span class="pull-right">
                        <button class="btn btn-sm  add-button"   id="confirm_${friendRequest.request_from_id}">Confirm</i></button>
                        <button class="btn btn-sm remove-button">Cancel</button>
                    </span>
                    </div>`;

                    $('#friendRequests').append(f);

                });
        }
    }

    })
    ;
    }
    })
    ;
</script>
