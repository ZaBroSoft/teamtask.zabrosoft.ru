<?php
/**
 * Created by PhpStorm.
 * User: ucraft74
 * Date: 26.10.18
 * Time: 15:26
 */

namespace app\models\forms;

use app\models\Team;
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

        $team = new Team();
        $team->title = $this->title;
        $team->description = $this->description;
        $team->content = $this->content;
        $team->user_id = Yii::$app->user->getId();
        $team->date_at = date('Y-m-d');
        return $team->save() ? $team : null;
    }

}