<div class="list-group">
    <div class="list-group-item text-center"><h5><b>Команды</b></h5></div>
    <a href="<?= \yii\helpers\Url::to(['index']) ?>" class="list-group-item">
        <i class="fa fa-briefcase" aria-hidden="true"></i>
        Мои команды
    </a>
    <?php if ($user->getUserTeams()->count() == 0): ?>
    <a href="<?= \yii\helpers\Url::to(['create']) ?>" class="list-group-item">
        <i class="glyphicon glyphicon-plus"></i>
        Создать команду
    </a>
    <?php endif; ?>
</div>