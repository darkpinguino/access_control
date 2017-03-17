<div class="box">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
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
        <div class="col-md-5">
            <div class="box-header">
                <h3><?= __('Preguntas') ?></h3>
            </div>
            <div class="box-body">
            <?php $i=1 ?>
                <?php foreach ($form->questions as $question): ?>
                    <?php if ($question->type==3): ?>
                        <h5><?= ($i.'. '."<b>".$question->question_text."</b>".' '."<i>".$question->placeholder."</i>") ?></h5>
                    <?php else: ?>
                        <h5><?= ($i.'. '."<b>".$question->question_text."</b>".' '."<i>".$question->placeholder."</i>") ?></h5>
                    <?php endif ?>
                    <?php $i++ ?> 
                <?php endforeach; ?>
            </div>
        </div>
    </div>


 
