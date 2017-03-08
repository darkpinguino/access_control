<?php 
  $controller = $this->request->params['controller']; 
  $userRole_id = $userAuth->userRole_id;
?>

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">Navegación Principal</li>
    <li>
    <?= $this->Html->link('<i class="fa fa-hand-stop-o"></i> <span>Autorización</span>', '/authorization/authorization', ['escape' => false]) ?>
    </li>
    <?= '<li class="treeview'. ((strcmp($controller, 'AccessRequest') and strcmp($controller, 'VehicleAccessRequest')) ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-share"></i> <span>Registro de acceso</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Registro de acceso', '/access-request/index', ['escape' => false]) ?>
        </li>
         <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i>Listar Registro de acceso <br> vehículos', '/vehicle-access-request/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Peticiones de acceso <br> pendientes', '/access-request/pending-access', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
  </ul>
</section>