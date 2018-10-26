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
        <div class="col-md-12 text-right">
            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['task/']) ?>" class="btn btn-success">Задачи</a>
                <a href="<?= \yii\helpers\Url::to(['project/']) ?>" class="btn btn-success">Проекты</a>
                <a href="<?= \yii\helpers\Url::to(['team/']) ?>" class="btn btn-success">Команды</a>
            </div>
            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['profile/']) ?>" class="btn btn-primary">Профиль</a>
                <a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" class="btn btn-danger">Выйти</a>
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
