<?php
/**
 * Created by PhpStorm.
 * User: ucraft74
 * Date: 26.10.18
 * Time: 15:26
 */

namespace app\models\forms;

use Yii;
use yii\base\Model;

class NewProjectForm extends Model
{
    public $title;
    public $description;
    public $team;

    public function rules()
    {
        return [
            [['title'], 'required', 'message' => 'Это поле не может быть пустым'],
            ['title', 'unique', 'targetClass' => 'app\models\Team', 'message' => 'Команда с таким именем уже существует'],
            ['title', 'string', 'length' => [3, 30]],
            ['description', 'string', 'max' => 255],
            ['title', 'trim'],
            ['team', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'description' => 'Описание',
            'team' => 'Команда'
        ];
    }

    public function create()
    {
        if (!$this->validate()) {
            return null;
        }
    }

}