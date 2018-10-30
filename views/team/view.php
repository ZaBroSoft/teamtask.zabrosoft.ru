<?php

use yii\bootstrap\ActiveForm;
use vova07\imperavi\Widget;
use yii\captcha\Captcha;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-2 padding-1">
        <?= $this->render('team_menu') ?>
        <?= $team->isFounder() ? $this->render('team_manager', ['team' => $team]) : '';?>
        <?= $team->isWorker() ? $this->render('team_worker', ['team' => $team]) : '';?>
    </div>
    <div class="col-md-10 padding-1">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="float-left">
                    <h4><?= $team->title ?></h4>
                </div>
                <div class="text-right">
                    <a href="<?= Url::to(['index']) ?>" class="btn btn-default">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">

                 <div class="row">
                     <div class="col-md-3 padding-1">
                         <div class="panel panel-default">
                             <div class="panel-heading">
                                 Основатель
                             </div>
                             <div class="panel-body">
                                 <i class="fa fa-user" aria-hidden="true"></i>
                                 <b><?= $team->user->username ?></b>
                             </div>
                         </div>
                         <div class="panel panel-default">
                             <div class="panel-heading">
                                 Проекты
                             </div>
                             <div class="panel-body">

                             </div>
                         </div>
                         <div class="panel panel-default">
                             <div class="panel-heading text-center">
                                 <div class="float-left">
                                     Участники
                                 </div>
                                 <div class="text-right">
                                     <span class="badge"><?= $team->getUsers()->count() - 1 ?></span>
                                 </div>
                             </div>
                             <div class="panel-body">
                                 <?php foreach ($team->users as $user): ?>
                                    <?php
                                        if ($team->user_id == $user->id){
                                            continue;
                                        }
                                     ?>
                                    <div style="float: left">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <?= $user->username ?>
                                    </div>
                                    <div class="text-right">
                                        <a href="#" title="Профиль"><i class="fa fa-vcard-o" aria-hidden="true"></i></a>
                                        <?php if ($user->id != Yii::$app->user->getId()): ?>
                                        <a href="#" title="Сообщение"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                        <?php if ($team->isFounder()): ?>
                                            <a href="<?= Url::to(['excludeforteam', 'user_id'=>$user->id, 'team_id'=>$team->id]) ?>"
                                               title="Исключить"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                                        <?php endif; ?>

                                    </div>

                                 <?php endforeach; ?>
                             </div>

                         </div>
                     </div>

                     <div class="col-md-9 padding-1">
                         <div class="well well-sm">
                             <?= $team->description ?>
                         </div>
                         <div>
                             <div class="panel panel-default">
                                 <div class="panel-heading">
                                     Описание
                                 </div>
                                 <div class="panel-body">
                                     <?= $team->content ?>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

            </div>
        </div>

    </div>
</div>
