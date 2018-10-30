<?php
/**
 * Created by PhpStorm.
 * User: ucraft74
 * Date: 26.10.18
 * Time: 15:26
 */

namespace app\models\forms;

use app\models\Team;
use app\models\User;
use Yii;
use yii\base\Model;

class NewTeamForm extends Model
{
    public $title;
    public $description;
    public $content;

    public function rules()
    {
        return [
            [['title'], 'required', 'message' => 'Это поле не может быть пустым'],
            ['title', 'unique', 'targetClass' => 'app\models\Team', 'message' => 'Команда с таким именем уже существует'],
            ['title', 'string', 'length' => [3, 30]],
            ['description', 'string', 'max' => 255],
            ['title', 'trim'],
            ['content', 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'description' => 'Краткое описание',
            'content' => 'Описание',
        ];
    }

    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = User::findOne(Yii::$app->user->getId());

        $team = new Team();
        $team->title = $this->title;
        $team->description = $this->description;
        $team->content = $this->content;
        $team->user_id = $user->id;
        $team->date_at = date('Y-m-d');

        $team->save();

        $user->link('teams', $team);

        return $team;
    }

}