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
                                <div class="btn-group">
                                    <a href="<?= Url::to(['view', 'team_id' => $team->id]) ?>"
                                       title="Перейти" class="btn btn-default btn-xs">
                                        <i class="fa fa-link" aria-hidden="true"></i>
                                    </a>
                                </div>
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

        <div class="panel panel-default">
            <div class="panel-heading">
                Мои заявки
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <th>Статус</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Участники</th>
                        <th>Дата создания</th>
                        <th>Основатель</th>
                        <th></th>
                    </thead>
                    <tbody id="list_requests">
                    <?php foreach ($user->requestsToTeam as $team): ?>
                        <tr>
                            <td>
                                <?php
                                switch ($user->getRequest($team->id)->result){
                                    case \app\models\teams\RequestAddToTeam::RESULT_SENT:
                                        echo '<mark class="text-info">Отправлена</mark>';
                                        break;
                                    case \app\models\teams\RequestAddToTeam::RESULT_ACCEPTED:
                                        echo '<span class="text-success">Принята</span>';
                                        break;
                                    case \app\models\teams\RequestAddToTeam::RESULT_REJECTED:
                                        echo '<span class="text-danger">Отклонена</span>';
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <?= $team->title ?>
                            </td>
                            <td>
                                <?= $team->description ?>
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
                                <a href="#"><i class="fa fa-remove" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Другие команды</h4>
            </div>
            <div class="panel-body">
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
                    <?php foreach ($other_teams as $team): ?>
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
                                <div class="btn-group">
                                    <a href="<?= Url::to(['view', 'team_id' => $team->id]) ?>"
                                       title="Перейти" class="btn btn-default btn-xs">
                                        <i class="fa fa-link" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" title="Отправить заявку"
                                       class="btn btn-default btn-xs <?= $user->getRequestsToTeam()->where(['id' => $team->id])->count() != 0 ? 'disabled' : ''?>"
                                       onclick="add_request_add_to_team(<?= $team->id ?>)" id="btn_add_<?= $team->id ?>">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>