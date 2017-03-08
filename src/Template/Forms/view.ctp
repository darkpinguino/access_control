<div class="box">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="box-header">
                <h3><?= h($form->name) ?></h3>
            </div>
            <div class="box-body">
            <table class="table">
            <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($form->name) ?></td>
            </tr>
            <tr>
            <th><?= __('Empresa') ?></th>
            <td><?= $form->has('company') ? $this->Html->link($form->company->name, ['controller' => 'Companies', 'action' => 'view', $form->company->id]) : '' ?></td>
            </tr>
            <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($form->id) ?></td>
            <tr>
            <th><?= __('Creado') ?></th>
            <td><?= h($form->created) ?></td>
            </tr>
            <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($form->modified) ?></td>
            </tr>
            <tr>
            <th><?= __('Descripción') ?></th>
            <td><?=$this->Text->autoParagraph(h($form->description)); ?></td>
            </tr>
            </table>
            </div>
        </div>
    </div>
</div>
