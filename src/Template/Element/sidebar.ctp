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
    <?php if ($userRole_id == 1): ?>
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
    <?php endif; ?>
    <?php if ($userRole_id == 1 || $userRole_id == 2 || $userRole_id == 3): ?>
      <?= '<li class="treeview'. (strcmp($controller, 'ContractorCompanies') ? '' : ' active').'">' ?> 
        <a href="#">
          <i class="fa fa-industry"></i> <span>Empresas Contratistas</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <!-- <a href="index.html"><i class="fa fa-circle-o"></i> Listar Empresas</a></li> -->

            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Empresas', '/contractorCompanies/index', ['escape' => false]) ?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Nueva Empresa', '/contractorCompanies/add', ['escape' => false]) ?>
          </li>
        </ul>
      </li>
    <?php endif ?>
    <?php if ($userRole_id == 1 || $userRole_id == 2 || $userRole_id == 3): ?>
      <?= '<li class="treeview'. (strcmp($controller, 'WorkAreas') ? '' : ' active').'">' ?> 
        <a href="#">
          <i class="fa fa-briefcase"></i> <span>Áreas de Trabajo</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <!-- <a href="index.html"><i class="fa fa-circle-o"></i> Listar Empresas</a></li> -->

            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Áreas de trabajo', '/workAreas/index', ['escape' => false]) ?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Nueva Área de trabajo', '/workAreas/add', ['escape' => false]) ?>
          </li>
        </ul>
      </li>
    <?php endif ?>
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
      </ul>
    </li>
    <?= '<li class="treeview'. (strcmp($controller, 'Profiles') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-users"></i> <span>Perfiles</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Perfiles', '/profiles/index', ['escape' => false]) ?>
        </li>
        <?php if ($userRole_id == 1): ?>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Perfil', '/profiles/add', ['escape' => false]) ?>
          </li>
        <?php endif ?>
        
      </ul>
    </li>

    <?php if ($userRole_id == 1 || $userRole_id == 2): ?>
      <?= '<li class="treeview'. ((strcmp($controller, 'UserRoles') and strcmp($controller, 'Users')) ? '' : ' active').'">' ?>
        <a href="#">
          <i class="fa fa-users"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Usuarios', '/users/index', ['escape' => false]) ?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Usuario', '/users/add', ['escape' => false]) ?>
          </li>

          <?php if ($userRole_id == 1): ?>

            <li>
              <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Roles', '/userRoles/index', ['escape' => false]) ?>
            </li>
             <li>
              <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Rol', '/userRoles/add', ['escape' => false]) ?>
            </li>

          <?php endif; ?>

        </ul>
      </li>
    <?php endif ?>

    <?php if ($userRole_id == 1 || $userRole_id == 2): ?>
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
          </li>
        </ul>
      </li>
    <?php endif ?>

    <?php if ($userRole_id == 1 || $userRole_id == 2): ?>
      <?= '<li class="treeview'. (strcmp($controller, 'Enclosures') ? '' : ' active').'">' ?>
        <a href="#">
          <i class="fa fa-building-o"></i> <span>Recintos</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Recintos', '/enclosures/index', ['escape' => false]) ?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Recinto', '/enclosures/add', ['escape' => false]) ?>
          </li>
        </ul>
      </li>  
    <?php endif ?>

    <?php if ($userRole_id == 1 || $userRole_id == 2): ?>
      <?= '<li class="treeview'. (strcmp($controller, 'Forms') ? '' : ' active').'">' ?>
        <a href="#">
          <i class="fa fa-file-text"></i> <span>Formularios</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Formularios', '/forms/index', ['escape' => false]) ?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Crear Nuevo Formulario', '/forms/add', ['escape' => false]) ?>
          </li>
        </ul>
      </li>  
    <?= '<li class="treeview'. (strcmp($controller, 'Measures') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-balance-scale"></i> <span>Medidas</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Tipos de Medidas', '/measures/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Crear Nueva Medida', '/measures/add', ['escape' => false]) ?>
        </li>
      </ul>
    </li>   
    <?php endif ?>

    <?php if ($userRole_id == 1): ?>
      
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

    <?php endif ?>

    <?= '<li class="treeview'. ((strcmp($controller, 'Vehicles') and strcmp($controller, 'VehicleTypes') and strcmp($controller, 'VehicleProfiles') and strcmp($controller, 'VehicleAuthorizations')) ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-car"></i> <span>Vehiculos</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Vehículos', '/vehicles/index', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Vehículos', '/vehicles/add', ['escape' => false]) ?>
        </li>
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Autorización Vehiculos', '/vehicleAuthorizations/index', ['escape' => false]) ?>
        </li>
        <?php if ($userRole_id == 1): ?>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar tipos de Vehículos', '/vehicleTypes/index', ['escape' => false])?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar tipos de Vehículos', '/vehicleTypes/add', ['escape' => false]) ?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Perfiles Vehiculos', '/VehicleProfiles/index', ['escape' => false]) ?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Perfiles Vehiculos', '/VehicleProfiles/add', ['escape' => false]) ?>
          </li>
        <?php endif ?>
      </ul>
    </li>

    <?php if ($userRole_id == 1): ?>
      <?= '<li class="treeview'. (strcmp($controller, 'ReasonVisits') ? '' : ' active').'">' ?>
        <a href="#">
          <i class="fa fa-book"></i> <span>Motivos de visita</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Motivos de visita', '/ReasonVisits/index', ['escape' => false]) ?>
          </li>
          <li>
            <?= $this->Html->link('<i class="fa fa-circle-o"></i> Agregar Motivos de visita', '/ReasonVisits/add', ['escape' => false]) ?>
          </li>
        </ul>
      </li>
    <?php endif ?>

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

    <?php if ($userRole_id == 1): ?>
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
    <?php endif ?>

    <?= '<li class="treeview'. (strcmp($controller, 'Alerts') ? '' : ' active').'">' ?>
      <a href="#">
        <i class="fa fa-exclamation"></i> <span>Alertas</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li>
          <?= $this->Html->link('<i class="fa fa-circle-o"></i> Listar Alertas', '/alerts/index', ['escape' => false]) ?>
        </li>
      </ul>
    </li>
  </ul>
</section>
<!-- /.sidebar -->