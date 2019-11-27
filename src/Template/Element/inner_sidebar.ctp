
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= SITE_URL; ?>img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $authUser['first_name']." ".$authUser['last_name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'dashboard']); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>  
          </a>
        </li>
        <li class="active">
          <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'index']); ?>">
            <i class="fa fa-users"></i> <span>Users</span>
          </a>
        </li>
        <li class="active">
          <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'profile']); ?>">
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
        </li>
        <li class="active">
          <a href="#">
            <i class="fa fa-users"></i> <span>Friends</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
