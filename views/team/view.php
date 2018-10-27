<?php

use yii\bootstrap\ActiveForm;
use vova07\imperavi\Widget;
use yii\captcha\Captcha;

?>

<div class="row">
    <div class="col-md-2">
        <?= $this->render('team_menu') ?>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><?= $team->title ?></h4>
            </div>
            <div class="panel-body">

                 <div class="row">
                     <div class="col-md-2 padding-1">
                         <div class="panel panel-default">
                             <div class="panel-heading text-center">
                                 Основатель
                             </div>
                             <div class="panel-body">
                                 <i class="fa fa-user" aria-hidden="true"></i>
                                 <b><?= $team->user->username ?></b>
                             </div>

                         </div>
                         <div class="panel panel-default">
                             <div class="panel-heading text-center">
                                 Проекты
                             </div>
                             <div class="panel-body">

                             </div>

                         </div>
                     </div>
                     <div class="col-md-8 padding-1">
                         <div class="well well-sm">
                             <?= $team->description ?>
                         </div>
                         <div>
                             <div class="panel panel-default">
                                 <div class="panel-body">
                                     <?= $team->content ?>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-2 padding-1">
                         <div class="panel panel-default">
                             <div class="panel-heading text-center">
                                 Участники
                             </div>
                             <div class="panel-body">

                             </div>

                         </div>
                     </div>
                 </div>

            </div>
        </div>
    </div>
</div>
