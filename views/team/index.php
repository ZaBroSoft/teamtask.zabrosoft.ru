<?php
/* @var $this yii\web\View */

use yii\bootstrap\Alert;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-md-2 padding-1">
        <?= $this->render('team_menu', ['user'=> $user]) ?>
    </div>

    <div class="col-md-10 padding-1">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><?= $user->username ?></h4>
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

                <h4>Мои команды</h4>
                <table class="table table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Проекты</th>
                        <th>Участники</th>
                        <th>Заявки</th>
                        <th>Основатель</th>
                        <th></th>
                    </thead>
                    <tbody>
                    <?php if (count($teams)>0): ?>
                        <?php foreach ($teams as $team): ?>
                            <tr>
                                <td>#<?= $team->id ?></td>
                                <td>
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    <a href="<?= Url::to(['view', 'team_id'=>$team->id]) ?>">
                                        <?= $team->title ?>
                                    </a>
                                </td>
                                <td>
                                    <i class="fa fa-cogs" aria-hidden="true"></i>

                                </td>
                                <td>
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    <?= $team->getUsers()->count() ?>
                                </td>
                                <td>
                                    <a href="<?= Url::to(['requests', 'team_id' => $team->id]) ?>">
                                    <i class="fa fa-user" aria-hidden="true"></i>

                                    <?php
                                        $request_count = 0;
                                        $users = $team->usersRequest;
                                        foreach ($users as $user){
                                            if ($user->getRequest($team->id)->result == \app\models\teams\RequestAddToTeam::RESULT_SENT){
                                                $request_count++;
                                            }
                                        }
                                        echo $request_count;
                                    ?>
                                    </a>
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
                    <?php endif; ?>

                    </tbody>
                </table>
                <?php
                if (count($teams) == 0){
                    echo Alert::widget([
                        'options' => [
                            'class' => 'alert-info'
                        ],
                        'body' => 'В настоящий момент у вас нет своих команд. Для создания, нажмите \'Создать команду\' в меню \'Команды\''
                    ]);
                }
                ?>
                <h4>Команды в которых я учавствую</h4>
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

                    <?php foreach ($user->getTeams()->where(['!=', 'user_id', $user->id])->all() as $team): ?>
                        <?php if ($team->user_id != Yii::$app->user->getId()): ?>
                        <tr>
                            <td>#<?= $team->id ?></td>
                            <td>
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <a href="<?= Url::to(['view', 'team_id'=>$team->id]) ?>">
                                    <?= $team->title ?>
                                </a>
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
                    <?php endif; ?>
                    <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div> <!-- Мои команды -->

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
                        <?php
                            if ($team->user_id == Yii::$app->user->getId()){
                                continue;
                            }
                        ?>
                        <tr id="request_<?= $team->id ?>">
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
                                <a href="<?= Url::to(['view', 'team_id'=>$team->id]) ?>">
                                    <?= $team->title ?>
                                </a>
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
                                <a href="#" onclick="removeRequest(<?= $team->id ?>, <?= $user->id ?>)">
                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- Мои заявки -->

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
                    <?php if ($team->getUsers()->where(['id' => Yii::$app->user->getId()])->count() == 0): ?>
                        <tr>
                            <td>#<?= $team->id ?></td>
                            <td>
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <a href="<?= Url::to(['view', 'team_id'=>$team->id]) ?>">
                                    <?= $team->title ?>
                                </a>
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
                                       class="btn btn-default btn-xs <?= $user->getRequestsToTeam()->where(['id' => $team->id])->count() != 0 ? 'disabled' : ''?>
                                        <?= $user->getTeams()->where(['id' => $team->id])->count() != 0 ? 'disabled' : '' ?>"
                                       onclick="add_request_add_to_team(<?= $team->id ?>)" id="btn_add_<?= $team->id ?>">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- Другие команды -->

    </div>
</div>
