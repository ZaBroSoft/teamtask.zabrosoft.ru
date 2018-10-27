<?php

namespace app\controllers;

use app\models\forms\NewTeamForm;
use app\models\Team;
use app\models\User;
use Yii;
use yii\filters\AccessControl;

class TeamController extends \yii\web\Controller
{

    public $layout = '@app/views/layouts/app_layout';
    public $newTeam = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $data = Yii::$app->request->get('newTeam');
        $user = User::findOne(Yii::$app->user->getId());


        if ($data != null){
            return $this->render('index',[
                'newTeam' => $data,
                'teams' => $user->userTeams,
            ]);
        }
        return $this->render('index',[
            'teams' => $user->userTeams,
        ]);
    }

    public function actionCreate()
    {
        $model = new NewTeamForm();

        if ($model->load(\Yii::$app->request->post())){
            if ($team = $model->create()){
                return $this->redirect(['index', 'newTeam' => $team->title]);
            }
        }

        return $this->render('create',[
                'model' => $model,
            ]);
    }

    public function actionView($team_id)
    {
        $team = Team::findOne($team_id);

        return $this->render('view',[
            'team' => $team
        ]);
    }

}
