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
    'ionicons.min',
    'AdminLTE.min',
    '_all-skins.min',
    'morris',
    'jquery-jvectormap',
    'bootstrap-datepicker.min',
    'daterangepicker',
    'bootstrap3-wysihtml5.min',
    'bootstrap3-wysihtml5.min',
    'bootstrap.min',
    'base',
    'style'
    ]); ?>
    <?= $this->Html->script([
    'jquery.min.js',
    'jquery-ui.min.js',
    'bootstrap.min.js',
    'raphael.min.js',
    'morris.min.js',
    'jquery.sparkline.min.js',
    'jquery-jvectormap-1.2.2.min.js',
    'jquery-jvectormap-world-mill-en.js',
    'jquery.knob.min.js',
    'moment.min.js',
    'daterangepicker.js',
    'bootstrap-datepicker.min.js',
    'bootstrap3-wysihtml5.all.min.js',
    'jquery.slimscroll.min.js',
    'fastclick.js',
    'adminlte.min.js',
    'dashboard.js',
    'demo.js'
    
    ]); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->element('inner_navigation') ?>
    <?= $this->Flash->render() ?>
    <div class="row clearfix">
        <div class="col-md-12">
        <?= $this->fetch('content') ?>
    </div>
    </div>
    <footer>
    </footer>
</body>
</html>
