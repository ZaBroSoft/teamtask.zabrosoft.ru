<div class="list-group">
    <div class="list-group-item text-center"><h5><b><?= \app\models\User::getUsernameById(Yii::$app->user->getId()) ?></b></h5></div>

    <a href="<?= \yii\helpers\Url::to(['leaveteam', 'team_id' => $team->id]) ?>" class="list-group-item">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        Покинуть команду
    </a> <!-- Заявки -->

</div>