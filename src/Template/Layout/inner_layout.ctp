<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'friends-forever';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <?= $this->Html->css([
    //'plugins/ionicons/ionicons.min',
    'plugins/admin/AdminLTE.min',
    'plugins/all-skins/_all-skins.min',
    'plugins/morris/morris',
    'plugins/jquery-jvectormap/jquery-jvectormap',
    'plugins/bootstrap/bootstrap-datepicker.min',
    'plugins/daterangepicker/daterangepicker',
    //'plugins/bootstrap/bootstrap3-wysihtml5.min',
    'plugins/bootstrap/bootstrap.min',
    
    
    
    ]); ?>
    <?= $this->Html->script([
    'plugins/jquery/jquery.min.js',
    'plugins/jquery/jquery-ui.min.js',
    'plugins/bootstrap/bootstrap.min.js',
    'plugins/raphael/raphael.min.js',
    'plugins/morris/morris.min.js',
    'plugins/jquery/jquery.sparkline.min.js',
    'plugins/jquery/jquery-jvectormap-1.2.2.min.js',
    'plugins/jquery/jquery-jvectormap-world-mill-en.js',
    'plugins/jquery/jquery.knob.min.js',
    'plugins/moment/moment.min.js',
    'plugins/daterangepicker/daterangepicker.js',
    'plugins/bootstrap/bootstrap-datepicker.min.js',
    'plugins/bootstrap/bootstrap3-wysihtml5.all.min.js',
    'plugins/jquery/jquery.slimscroll.min.js',
    'plugins/fastclick/fastclick.js',
    'plugins/adminlte/adminlte.min.js',
    
    ]); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<?= $this->Flash->render() ?>
    <?= $this->element('inner_navigation') ?>
    <?= $this->element('inner_sidebar') ?>
    <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>	
        <?= $this->fetch('content') ?>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.18
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">Friends Forever</a>.</strong> All rights reserved.
    </footer>
    <div class="control-sidebar-bg"></div>
</div>
</body>
</html>
