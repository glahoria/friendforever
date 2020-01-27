<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FriendRequest $friendRequest
 */
?>
<style>
    .remove-button{
    border-radius: 1px;
    background: #736363;
    color: white;
  }
  .add-button{
    border-radius: 1px;
    background: #004ea6;
    color: white;
    margin-left: 5px;
  }
</style>
<section class="content">
    <div class="row">
        <section class="col-lg-7 connectedSortable">

<!------------------- Friend Requests ------------->

           <div id="friendRequests" style="background: white;">
                <div class="box-header" style="background: white;">
                  <h3 class="box-title" style="background: white;color: #9B9696;font-weight: bold; width: 100%">Friend Requests <hr></h3>
                </div>
                <form method="post" accept-charset="utf-8" id="saveFriend_${user.id}" class="save-friend"> 
                <div class="user-block" style="padding:10px;">
                    <img class="img-circle img-bordered-sm" src="<?= SITE_URL; ?>img/user_icon.png" alt="User Image"> 
                    <span class="username">
                        <a href="#" style="text-transform:uppercase; font-weight:bold;color:#4D3F3F;">Manpreet Singh</a>
                        <input name="post_id" value="${post.id}" type="hidden" class="form-control" style="border-radius:0px;"/>
                    <span class="pull-right">
                        <button class="btn btn-sm remove-button" id="remove_${friend.id}">Cancel</button>
                        <button class="btn btn-sm  add-button" id="add_${friend.id}">Confirm</i></button>
                    </span>
                    </span>
                </div><hr>  
            </form>
          </div>

<!-------------New Add Friends --------------------------->  

          <div id="addFriends" style="background: white;">
            <div class="box-header" style="background: white;">
                  <h3 class="box-title" style="background: white;color: #9B9696;font-weight: bold; width: 100%">Add Friends <hr></h3>
                </div>
            <form method="post" accept-charset="utf-8" id="addFriend_${user.id}" class="add-friend">
                <div class="user-block" style="padding:10px;">
                    <img class="img-circle img-bordered-sm" src="<?= SITE_URL; ?>img/user_icon.png" alt="User Image"> 
                    <span class="username">
                        <a href="#" style="text-transform:uppercase; font-weight:bold;color:#4D3F3F;">Mandeep Singh</a>
                        <input name="request_to_id" value="${user.id}" type="hidden" class="form-control" style="border-radius:0px;"/>
                    <span class="pull-right">
                        <button class="btn btn-sm remove-button" id="remove_${friend.id}">Remove</button>
                        <button class="btn btn-sm  add-button" id="add_${friend.id}">Add Friend</i></button>
                    </span>
                    </span>
                </div>
            </form>
          </div><br />
        </section>

<!------------friends list------------------------------------------>

         <section class="col-lg-4 connectedSortable">  <!-- Chat box -->
          <div id="friendsList" style="background: white;">
            <div>
                <div class="box-header" style="background: white;">
                  <h3 class="box-title" style="background: white;color: black;font-weight: bold; width: 100%">Friends</h3>
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
