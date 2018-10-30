<?php
use yii\bootstrap\Alert;
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-2 padding-1">
        <?=$this->render('team_menu')?>
        <?= $team->isFounder() ? $this->render('team_manager', ['team' => $team]) : ''?>
    </div>
    <div class="col-md-10 padding-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="float-left">
                    <h4>Заявки</h4>
                </div>
                <div class="text-right">
                    <a href="<?= Url::to(['view', 'team_id' => $team->id]) ?>" class="btn btn-default">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <?php
                    if (!$team->isFounder()){
                        echo Alert::widget([
                            'options' => [
                                'class' => 'alert-danger'
                            ],
                            'body' => '<b> Запрещено! </b>  Только основатель команды может просматривать заявки.'
                        ]);
                    }
                ?>

                <?php if ($team->isFounder()): ?>

                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Имя пользователя</th>
                                <th>Команды</th>
                                <th>Проекты</th>
                                <th>Решение</th>
                            </thead>
                            <tbody>
                            <?php foreach ($team->usersRequest as $user): ?>
                                <?php if ($user->getRequest($team->id)->result == \app\models\teams\RequestAddToTeam::RESULT_SENT): ?>
                                    <tr id="request_<?= $user->id ?>">
                                        <td>#<?= $user->id ?></td>
                                        <td>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <?= $user->username ?>
                                        </td>
                                        <td>
                                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                                            <?= $user->getTeams()->count() ?>
                                        </td>
                                        <td>
                                            <i class="fa fa-cogs" aria-hidden="true"></i>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="#"
                                                   title="Принять" class="btn btn-success btn-xs"
                                                    onclick="setRequestAccept(<?= $team->id ?>, <?= $user->id ?>)">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </a>
                                                <a href="#"
                                                   title="Отклонить" class="btn btn-danger btn-xs"
                                                    onclick="setRequestRegected(<?= $team->id ?>, <?= $user->id ?>)">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>