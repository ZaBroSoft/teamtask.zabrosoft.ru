<?php

$request_count = 0;
$users = $team->usersRequest;
foreach ($users as $user){
    if ($user->getRequest($team->id)->result == \app\models\teams\RequestAddToTeam::RESULT_SENT){
        $request_count++;
    }
}

?>

<div class="list-group">
    <div class="list-group-item text-center"><h5><b>Управление</b></h5></div>

    <a href="<?= \yii\helpers\Url::to(['requests', 'team_id' => $team->id]) ?>" class="list-group-item">
        <div class="<?= $request_count > 0 ? 'float-left' : '' ?>">
            <i class="fa fa-users" aria-hidden="true"></i>
            Заявки
        </div>
        <div class="text-right">
            <?=
                $request_count > 0 ?
                    '<span class="badge">' . $request_count . '</span>':
                    ''
            ?>
        </div>
    </a>

    <a href="<?= \yii\helpers\Url::to(['project/create', 'team_id'=>$team->id]) ?>" class="list-group-item">
        <div class="<?= $request_count > 0 ? 'float-left' : '' ?>">
            <i class="fa fa-gear" aria-hidden="true"></i>
            Создать проект
        </div>
        <div class="text-right">
            <?=
            $request_count > 0 ?
                '<span class="badge">' . $request_count . '</span>':
                ''
            ?>
        </div>
    </a><!-- Заявки -->

</div>