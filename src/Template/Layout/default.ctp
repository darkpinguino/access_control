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
$controller = $this->request->params['controller'];
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
  <?= $this->Html->css('font-awesome/font-awesome.min', ['block' => true]) ?>  
  <!-- bootstrap datepicker -->
  <?= $this->Html->css('plugins/datepicker/datepicker3', ['block' => true])?>
  <!-- Theme style -->
  <?= $this->Html->css('adminLTE/AdminLTE.min', ['block' => true]) ?>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <?= $this->Html->css('adminLTE/skins/_all-skins.min', ['block' => true]) ?>
  <!-- Colored Modal Headings -->
  <?= $this->Html->css('custom') ?>

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

  <?= $this->Html->script('utility/getURLParameters', ['block' => true]) ?>
  <?= $this->Html->script('utility/paginatorSearch', ['block' => true]) ?>

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
  		  <span class="logo-mini">
          <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Control de Acceso</span>
  		</a>

  		<!-- Header Navbar: style can be found in header.less -->
  		<nav class="navbar navbar-static-top" role="navigation">
  		  <!-- Sidebar toggle button-->
  		  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
  		    <span class="sr-only">Toggle navigation</span>
  		  </a>
  		  <div class="navbar-custom-menu">
  		    <ul class="nav navbar-nav">
          <?php if (!strcmp($controller, 'Authorization')): ?>


            <li class="dropdown notifications-menu">
              <a id="notifications-menu2" href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
              </a>
              <ul id="notifications-dropdown2" class="dropdown-menu">
              </ul>
            </li>


            <li class="dropdown notifications-menu">
              <a id="notifications-menu" href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
              </a>
              <ul id="notifications-dropdown" class="dropdown-menu">
              </ul>
            </li>
            <li class="dropdown notifications-menu">
              <a id="people-count-menu" href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-male"></i>
              </a>
              <ul id="people-count-dropdown" class="dropdown-menu">
              </ul>
            </li>
            <li class="dropdown notifications-car">
              <a id="notifications-menu" href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-car"></i>
              </a>
              <ul id="notifications-dropdown" class="dropdown-menu">
              </ul>
            </li>
          <?php endif ?>
  		      <!-- User Account: style can be found in dropdown.less -->
  		      <li class="dropdown user-menu">
  		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
  		          <!-- <img src="webroot/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
  		          <span><?= $userAuth->company->name ?>|</span>
  		          <span class="hidden-xs"><?= $userAuth->person->name." ".$userAuth->person->lastname?></span>
  		        </a>
  		        <ul class="dropdown-menu">
  		          <!-- Menu Footer-->
  		          <li class="user-footer">
  		            <div >
  		              <!-- <a href="#" class="btn btn-default btn-flat">Perfil</a> -->
                    <?= $this->Html->link(
                      'Perfil',
                      '/users/editMin/'. $userAuth->id,
                      ['class' => 'btn btn-default btn-flat']
                    )?>
                    <?= $this->Html->link(
                      'Cerrar Sesión', 
                      '/users/logout',
                      ['class' => 'btn btn-default btn-flat pull-right']
                    )?>
  		            </div>
  		          </li>
  		        </ul>
  		      </li>
  		    </ul>
  		  </div>
  		</nav>
	  </header>

	  <!-- Left side column. contains the logo and sidebar -->
    
    <?php if ($userAuth->userRole_id == 4): ?>
      <aside class="main-sidebar">
        <?= $this->element('sidebar_min') ?>
      </aside>
    <?php elseif ($userAuth->userRole_id != 5): ?>
      <aside class="main-sidebar">
        <?= $this->element('sidebar') ?>
      </aside>
    <?php endif ?>


	  <!-- Content Wrapper. Contains page content -->

    <?php if (!($userAuth->userRole_id == 5)): ?>
      <div class="content-wrapper">
    <?php else: ?>
      <div class="content-wrapper" style="margin-left: 0px">
    <?php endif ?>
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
        <?php if (!($userAuth->userRole_id == 5)): ?>
          <div class="col-md-12">
        <?php else: ?>
  	      <div class="col-md-10 col-md-offset-1">
        <?php endif ?>
          <?= $this->Flash->render() ?>
	      	<?= $this->fetch('content') ?>
	      </div>
      	</div>
      </section>	

    <footer>
    </footer>
	</div>

<div id="myModalDelete" class="modal fade">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Estado Actual</h4>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
    <?= $this->Html->link(__('Exportar'), ['action' => 'exportActualState', '_ext' => 'pdf'], ['class' => 'btn btn-primary']); ?>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
  </div>
</div>


</body>
</html>
