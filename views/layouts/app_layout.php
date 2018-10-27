<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-right padding-1">
            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['task/']) ?>" class="btn btn-default">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    Задачи
                </a>
                <a href="<?= \yii\helpers\Url::to(['project/']) ?>" class="btn btn-default">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    Проекты
                </a>
                <a href="<?= \yii\helpers\Url::to(['team/']) ?>" class="btn btn-default">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    Команды
                </a>
            </div>
            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['profile/']) ?>" class="btn btn-default">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    Профиль
                </a>
                <a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" class="btn btn-default">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    Выйти
                </a>
            </div>
        </div>
    </div>
    <br>
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
