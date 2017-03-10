<div class="box">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box-header">
                <h3><?= h($answers_sets->form->name) ?></h3>
            </div>
            <div class="box-body">
                <?php foreach ($answers_sets->answers as $answer): ?>
                    <?php if ($answer->question->type==3): ?>
                        <h4><?= ($answer->question->question_text) ?></h4>
                        <h5><ins><?= ($answer->answer_text).' '.($answer->question->measure_id) ?></ins></h5>
                        <br>
                    <?php else: ?>
                        <h4><?= ($answer->question->question_text) ?></h4>
                        <h5><ins><?= ($answer->answer_text) ?></ins></h5>
                        <br>
                    <?php endif ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>