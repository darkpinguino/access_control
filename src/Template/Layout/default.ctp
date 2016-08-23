<?php
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @since         0.10.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>
      Control de acceso:
      <?= $this->fetch('title') ?>
  </title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?= $this->Html->meta('icon') ?>
  <!-- Bootstrap 3.3.5 -->
  <?= $this->Html->css('bootstrap/bootstrap.min', ['block' => true]) ?>
  <!-- Font Awesome -->
  <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', ['block' => true]) ?>
  <!-- Ionicons -->
  <?= $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', ['block' => true])?>
  <!-- bootstrap datepicker -->
  <?= $this->Html->css('plugins/datepicker/datepicker3', ['block' => true])?>
  <!-- Theme style -->
  <?= $this->Html->css('adminLTE/AdminLTE.min', ['block' => true]) ?>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <?= $this->Html->css('adminLTE/skins/_all-skins.min', ['block' => true]) ?>

  <!-- jQuery 2.1.4 -->
  <?= $this->Html->script('plugins/jQuery/jQuery-2.1.4.min', ['block' => true]) ?>
  <!-- jQuery UI 1.11.4 -->
  <?= $this->Html->script('plugins/jQueryUI/jquery-ui.min', ['block' => true]) ?>
  <!-- Booststrap 3.3.5 -->
  <?= $this->Html->script('bootstrap/bootstrap.min', ['block' => true]) ?>
  <!-- bootstrap datepicker -->
  <?= $this->Html->script('plugins/datepicker/bootstrap-datepicker', ['block' => true])?>
  <?= $this->Html->script('plugins/locales/bootstrap-datepicker.es', ['block' => true])?>
  <!-- AdminLTE App -->
  <?= $this->Html->script('app.min', ['block' => true]) ?>  

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('cssView') ?>
  <?= $this->fetch('script') ?>
  <?= $this->fetch('scriptView') ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  	<header class="main-header">
  		<!-- Logo -->
  		<a href="index2.html" class="logo">
  		  <!-- mini logo for sidebar mini 50x50 pixels -->
  		  <span class="logo-mini"><b>A</b>LT</span>
  		  <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
  		</a>

  		<!-- Header Navbar: style can be found in header.less -->
  		<nav class="navbar navbar-static-top" role="navigation">
  		  <!-- Sidebar toggle button-->
  		  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
  		    <span class="sr-only">Toggle navigation</span>
  		  </a>
  		  <div class="navbar-custom-menu">
  		    <ul class="nav navbar-nav">
  		      <!-- User Account: style can be found in dropdown.less -->
  		      <li class="dropdown user-menu">
  		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
  		          <!-- <img src="webroot/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
  		          
  		          <span class="hidden-xs"><?= $userAuth->person->name." ".$userAuth->person->lastname?></span>
  		        </a>
  		        <ul class="dropdown-menu">
  		          <!-- Menu Footer-->
  		          <li class="user-footer">
  		            <div >
                    <?= $this->Html->link(
                      'Cerrar Sesión', 
                      '/users/logout',
                      ['class' => 'btn btn-default btn-flat']
                    )?>
  		              <!-- <a href="#" class="btn btn-default btn-flat">Sign out</a> -->
  		            </div>
  		          </li>
  		        </ul>
  		      </li>
  		    </ul>
  		  </div>
  		</nav>
	  </header>

	  <!-- Left side column. contains the logo and sidebar -->
	  <aside class="main-sidebar">
	    <?= $this->element('sidebar') ?>
	  </aside>


	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <!-- <h1>
	        Dashboard
	        <small>Control panel</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class="active">Dashboard</li>
	      </ol> -->
	    </section>

	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
	      <div class="col-md-12">
          <?= $this->Flash->render() ?>
	      	<?= $this->fetch('content') ?>
	      </div>
      	</div>
      </section>	

    <footer>
    </footer>
	</div>
</body>
</html>
