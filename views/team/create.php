<?php

use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <div class="col-md-2">
        <?= $this->render('team_menu') ?>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <h3>Новая команда</h3>
                </div>
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'title')->textInput() ?>
                <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
                <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>

                <div class="text-right">
                    <?= \yii\bootstrap\Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>