<?php
/* @var $this yii\web\View */

use yii\bootstrap\Alert;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-md-2 padding-1">
        <?= $this->render('team_menu') ?>
    </div>
    <div class="col-md-10 padding-1">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Мои команды</h4>
            </div>
            <div class="panel-body">

                <?php
                if (isset($newTeam)){
                    echo Alert::widget([
                        'options' => [
                            'class' => 'alert-success'
                        ],
                        'body' => 'Команда <b>'. $newTeam .'</b> успешно создана'
                    ]);
                }
                ?>

                <?php if (count($teams)>0): ?>
                <table class="table table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Проекты</th>
                        <th>Участники</th>
                        <th>Дата создания</th>
                        <th>Основатель</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach ($teams as $team): ?>
                            <tr>
                                <td>#<?= $team->id ?></td>
                                <td>
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    <?= $team->title ?>
                                </td>
                                <td>
                                    <i class="fa fa-cogs" aria-hidden="true"></i>

                                </td>
                                <td>
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    <?= $team->getUsers()->count() ?>
                                </td>
                                <td>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?= $team->date_at ?>
                                </td>
                                <td>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?= $team->user->username ?>
                                </td>
                                <td>
                                    <a href="<?= Url::to(['view', 'team_id' => $team->id]) ?>" title="Перейти" class="btn btn-default">
                                        <i class="fa fa-link" aria-hidden="true"></i>

                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
                <?php
                if (count($teams) == 0){
                    echo Alert::widget([
                        'options' => [
                            'class' => 'alert-info'
                        ],
                        'body' => 'В настоящий момент у вас нет команд. Для создания, нажмите \'Создать команду\' в меню \'Команды\''
                    ]);
                }
                ?>
            </div>
        </div>
    </div>
</div>