<?php $controller = $this->request->params['controller']; ?>

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <?= '<li class="treeview'. (strcmp($controller, 'Companies') ? '' : ' active').'">' ?> 
      <a href="#">
        <i class="fa fa-industry"></i> <span>Empresas</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <!-- <a href="index.html"><i class="fa fa-circle-o"></i> Listar Empresas</a></li> -->

          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Empresas', '/companies/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Nueva Empresa', '/companies/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. ((strcmp($controller, 'People') and strcmp($controller, 'AccessRolePeople')) ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-users"></i> <span>Personas</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Personas', '/people/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Persona', '/people/add', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Rol de Acceso', '/accessRolePeople/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. ((strcmp($controller, 'Doors') and strcmp($controller, 'AccessRoleDoors')) ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-sign-in"></i> <span>Puertas</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Puertas', '/doors/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Puerta', '/doors/add', ['escape' => false]) ?>
        </li><li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Rol de Acceso', '/accessRoleDoors/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. (strcmp($controller, 'Enclosures') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-building-o"></i> <span>Recintos</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Recintos', '/enclosures/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Receinto', '/enclosures/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>  
    <?= '<li class="treeview'. (strcmp($controller, 'Sensors') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Sensores</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Sensores', '/sensors/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Sensor', '/sensors/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. (strcmp($controller, 'SensorTypes') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Tipos de Sensores</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Sensores', '/sensor-types/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Sensor', '/sensor-types/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. (strcmp($controller, 'SensorData') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-database"></i> <span>Datos de Sensores</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Datos', '/sensor-data/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Datos', '/sensor-data/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. (strcmp($controller, 'Vehicles') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-car"></i> <span>Vehiculos</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Vehiculos', '/vehicles/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Vehiculos', '/vehicles/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. (strcmp($controller, 'AccessRoles') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-key"></i> <span>Roles de acceso</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Roles de acceso', '/access-roles/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Roles de acceso', '/access-roles/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. (strcmp($controller, 'AccessRequest') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-share"></i> <span>Peticiones de acceso</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Peticiones de acceso', '/access-request/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Peticiones de acceso', '/access-request/add', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Peticiones de acceso pendientes', '/access-request/pending-access', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <?= '<li class="treeview'. (strcmp($controller, 'AccessStatus') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-exclamation"></i> <span>Estados de acceso</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Estados de acceso', '/access-status/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Estados de acceso', '/access-status/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
    <li>
    <?= $this->Html->link('<i class="fa fa-circle-o text-red"></i> <span>Autorización</span>', '/people/authorization', ['escape' => false]) ?>
    </li>
  </ul>
</section>
<!-- /.sidebar -->