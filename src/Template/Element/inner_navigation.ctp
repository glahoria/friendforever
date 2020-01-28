<?php
// pr($authUser);
?>
<style>
    .cancel-button {
        border-radius: 1px;
        background: #736363;
        color: white;
        margin-left: 5px;
    }

    .confirm-button {
        border-radius: 1px;
        background: #004ea6;
        color: white;

    }
</style>
<header class="main-header">
    <!-- Logo -->
    <a href="<?= SITE_URL; ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>FF</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?= SITE_TITLE; ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa  fa-user-plus"></i>
                        <span class="label label-success">1</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Friend Requests</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#" id="requests">

                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a
                                    href="<?= $this->Url->build(['controller' => 'friend_requests', 'action' => 'friends']); ?>">See
                                All Requests</a></li>
                    </ul>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may
                                        not fit into the
                                        page and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <li class="<?= $this->request->getParam('action') == "login" ? "active" : ""; ?>"><?= $this->Html->link('Wall', ['controller' => 'posts', 'action' => 'wall']) ?></li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= SITE_URL; ?>img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $authUser['first_name'] . " " . $authUser['last_name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= SITE_URL; ?>img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                                <?= $authUser['first_name'] . " " . $authUser['last_name']; ?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 pull-left">
                                    <a href="#">Friends</a>
                                </div>
                                <div class="col-xs-7 pull-right">
                                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'change_password']); ?> ">Change
                                        Password</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']); ?>">
                                    <button class="btn btn-default btn-flat">Profile</button>
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>">
                                    <button class="btn btn-default btn-flat">Logout</button>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>


<script>
    $(document).ready(function () {

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
                            var f = `<div class="pull-left">
    <img src="<?= SITE_URL; ?>img/user_icon.png" class="img-circle" alt="User Image">
</div>
<h4 style="margin-bottom:5px;font-weight: bold; ">
    ${friendRequest.user.first_name} ${friendRequest.user.last_name}
</h4>
<button class="pull-left btn btn-sm confirm-button" id="confirm_${friendRequest.request_from_id}">Confirm</button>
<button class="pull-left btn btn-sm cancel-button">Cancel</button>`;

                            $('#requests').append(f);

                        });
                    }
                }

            })
            ;
        }
    })
    ;
</script>

