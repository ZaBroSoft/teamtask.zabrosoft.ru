<?php

use yii\bootstrap\ActiveForm;
use vova07\imperavi\Widget;
use yii\captcha\Captcha;

?>

<div class="row">
    <div class="col-md-2 padding-1">
        <?= $this->render('project_menu') ?>
    </div>
    <div class="col-md-10 padding-1">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <h3>Новый проект в команде <?= $team->title ?></h3>
                </div>
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'title')->textInput()?>
                <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

                <div class="text-right">
                    <?= \yii\bootstrap\Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>