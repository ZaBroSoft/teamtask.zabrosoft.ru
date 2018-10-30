<?php

namespace app\controllers;

use app\models\forms\NewTeamForm;
use app\models\Team;
use app\models\teams\RequestAddToTeam;
use app\models\teams\TeamUser;
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
                        'actions' => ['index', 'create', 'view', 'requesttoteam', 'requests',
                            'requestreject', 'requestremove', 'requestaccept', 'leaveteam',
                            'excludeforteam'],
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
        $other_teams = Team::find()->where(['!=', 'user_id', $user->id])->limit(5)->all();

        if ($data != null){
            return $this->render('index',[
                'newTeam' => $data,
                'teams' => $user->userTeams,
                'other_teams' => $other_teams,
                'user' => $user,
            ]);
        }
        return $this->render('index',[
            'teams' => $user->userTeams,
            'other_teams' => $other_teams,
            'user' => $user,
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

    public function actionRequesttoteam($team_id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $team = Team::findOne($team_id);
        if ($team == null){
            return [
                'status' => 1,
                'message' => 'Ошибка определения команды',
            ];
        }

        $user = User::findOne(Yii::$app->user->getId());

        $teams = $user->getRequestsToTeam()->where(['id' => $team_id])->count();

        if ($teams != 0){
            return [
                'status' => 0,
                'message' => 'Заявка уже подана',
            ];
        }

        $req = new RequestAddToTeam();
        $req->user_id = $user->id;
        $req->team_id = $team_id;
        $req->result = RequestAddToTeam::RESULT_SENT;

        $req->save();

        return [
            'status' => 100,
            'message' => 'Заявка отправлена',
            'team' => [
                'title' => $team->title,
                'description' => $team->description,
                'users' => $team->getUsers()->count(),
                'date' => $team->date_at,
                'user' => $team->user->username,
            ],
        ];
    }

    public function actionRequests($team_id)
    {
        $team = Team::findOne($team_id);

        return $this->render('requests',[
            'team' => $team
        ]);
    }

    public function actionRequestaccept()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax){
            $user = User::findOne(Yii::$app->request->post('user_id'));
            $team = Team::findOne(Yii::$app->request->post('team_id'));

            if ($user == null || $team == null ){
                return 'Error';
            }

            if ($team->isFounder()){
                $req = RequestAddToTeam::find()->where(['user_id' => $user->id, 'team_id' => $team->id])->one();
                $req->setAccept();

                $user->link('teams', $team);

                return 'OK';
            }
            return 'Error';

        }

        return 'Error';
    }

    public function actionRequestreject()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax){
            $user = User::findOne(Yii::$app->request->post('user_id'));
            $team = Team::findOne(Yii::$app->request->post('team_id'));

            if ($user == null || $team == null ){
                return 'Error';
            }

            if ($team->isFounder()){
                $req = RequestAddToTeam::find()->where(['user_id' => $user->id, 'team_id' => $team->id])->one();
                $req->setReject();
                return 'OK';
            }
            return 'Error';

        }

        return 'Error';

    }

    public function actionRequestremove()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax){
            $user = User::findOne(Yii::$app->request->post('user_id'));
            $team = Team::findOne(Yii::$app->request->post('team_id'));

            if ($user == null || $team == null ) {
                return 'Error';
            }

            $req = RequestAddToTeam::find()->where(['user_id' => $user->id, 'team_id' => $team->id])->one();
            if ($req->user->id == Yii::$app->user->getId()){
                $req->delete();
                return 'OK';
            }

            return 'Error';

        }

        return 'Error';

    }

    public function actionLeaveteam($team_id)
    {
        $user = User::findOne(Yii::$app->user->getId());
        $team = Team::findOne($team_id);

        $user->unlink('teams', $team, true);

        return $this->redirect(['index']);
    }

    public function actionExcludeforteam($user_id, $team_id)
    {
        $user = User::findOne($user_id);
        $team = Team::findOne($team_id);

        if (!$team->isFounder()){
            return $this->redirect('site/error');
        }

        $user->unlink('teams', $team, true);

        return $this->redirect(['view', 'team_id' => $team_id]);
    }

}
