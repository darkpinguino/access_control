<div class="box">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="box-header">
                <h3><?= h($measure->measure) ?></h3>
            </div>
            <div class="box-body">
            <table class="table">
            <tr>
            <th><?= __('Tipo Medida') ?></th>
            <td><?= h($measure->measure) ?></td>
            </tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($measure->id) ?></td>
            <tr>
            <th><?= __('Creado') ?></th>
            <td><?= h($measure->created) ?></td>
            </tr>
            <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($measure->modified) ?></td>
            </tr>
            </table>
            </div>
        </div>
    </div>
</div>

