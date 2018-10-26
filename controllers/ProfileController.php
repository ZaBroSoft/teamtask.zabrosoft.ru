<?php

namespace app\controllers;

use yii\filters\AccessControl;

class ProfileController extends \yii\web\Controller
{

    public $layout = '@app/views/layouts/app_layout';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
