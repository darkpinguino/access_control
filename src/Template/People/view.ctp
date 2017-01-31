<div class="box">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="box-header">
				<h3><?= h($person->name).' '.h($person->lastname) ?></h3>
			</div>
			<div class="box-body">
			  <table class="table">
				<tr>
				  <th><?= __('Rut') ?></th>
				  <td><?= h($person->rut) ?></td>
				</tr>
				<tr>
				  <th><?= __('Nombre') ?></th>
				  <td><?= h($person->name) ?></td>
				</tr>
				<tr>
				  <th><?= __('Apellido') ?></th>
				  <td><?= h($person->lastname) ?></td>
				</tr>
				<?php if ($userRole_id == 1): ?>
					<tr>
					  <th><?= __('ID') ?></th>
					  <td><?= h($person->id) ?></td>
					</tr>
				<?php endif ?>
				<tr>
				  <th><?= __('Telefono') ?></th>
				  <td><?= h($person->phone) ?></td>
				</tr>
				<tr>
					<th><?= __('Perfil') ?></th>
					<td><?= $this->element('action_profile', ['profileID' => $person->company_people[0]->profile_id]) ?></td>
				</tr>
				<?php if (isset($person->company_people[0]->contractor_company)): ?>
					<tr>
						<th><?= __('Empresa cotratista') ?></th>
						<td><?= h($person->company_people[0]->contractor_company->name)?></td>
					</tr>
				<?php endif ?>
				<?php if (isset($person->company_people[0]->work_area)): ?>
					<tr>
						<th><?= __('Área de trabajo') ?></th>
						<td><?= h($person->company_people[0]->work_area->name)?></td>
					</tr>
				<?php endif ?>
				<tr>
				  <th><?= __('Agregado') ?></th>
				  <td><?= h($person->created) ?></td>
				</tr>
				<tr>
				  <th><?= __('Modificado') ?></th>
				  <td><?= h($person->modified) ?></td>
				</tr>
			  </table>
			</div>
		</div>
	</div>
</div>
<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Roles de acceso'])?>
  <div class="box-body">
	  <table class="table table-bordered table-striped table-hover">
	  <thead>
		<tr>
		  <th><?= $this->Paginator->sort('id', 'ID', ['model' => 'accessRoles']) ?></th>
		  <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($accessRoles as $accesRole): ?>
		<tr>
		  <td><?= h($accesRole->id) ?></td>
		  <td><?= h($accesRole->name) ?></td>
		  </tr>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	  </table>
  </div>
  <div class="box-footer clearfix">
	<?= $this->element('paginator') ?>
  </div>
</div>

<div class="box">
  <?= $this->element('tableHeader', ['title' => 'Perfiles de Visita'])?>
  <div class="box-body">
	  <table class="table table-bordered table-striped table-hover">
	  <thead>
		<tr>
		  <th>Persona que visita</th>
		  <th>Motivo de visita</th>
		  <th>Fecha</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($visitProfiles as $visit_profile): ?>
		<tr>
		  <td><?= h($visit_profile->person_to_visit->fullName) ?></td>
		  <td><?= h($visit_profile->note) ?></td>
		  <td><?= h($visit_profile->created) ?></td>
		  </tr>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	  </table>
  </div>
  <div class="box-footer clearfix">
	<?= $this->element('paginator') ?>
  </div>
</div>