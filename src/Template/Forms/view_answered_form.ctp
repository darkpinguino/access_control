<div class="box">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="box-header">
                <h3><?= h($->name) ?></h3>
            </div>
            <div class="box-body">
            <table class="table">
            <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($form->name) ?></td>
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
            </table>
            </div>
        </div>
    </div>
</div>
