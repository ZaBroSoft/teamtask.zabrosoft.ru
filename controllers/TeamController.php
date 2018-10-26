<?php

namespace app\controllers;

use app\models\forms\NewTeamForm;
use app\models\Team;
use yii\filters\AccessControl;

class TeamController extends \yii\web\Controller
{

    public $layout = '@app/views/layouts/app_layout';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create'],
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

    public function actionCreate()
    {
        $model = new NewTeamForm();

        if ($model->load(\Yii::$app->request->post())){
            if ($team = $model->create()){
                $this->redirect(['index']);
            }
        }

        return $this->render('create',['model' => $model]);
    }

}
