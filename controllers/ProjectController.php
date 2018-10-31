<?php

namespace app\controllers;

use app\models\forms\NewProjectForm;
use app\models\Team;
use yii\filters\AccessControl;

class ProjectController extends \yii\web\Controller
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

    public function actionCreate($team_id)
    {
        $team = Team::findOne($team_id);

        if (!$team->isFounder()){
            return null;
        }

        $model = new NewProjectForm();



        return $this->render('create', ['model'=>$model, 'team'=>$team]);
    }

}
