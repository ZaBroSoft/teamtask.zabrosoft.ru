<?php

namespace app\models;

use app\models\teams\TeamUser;
use Yii;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property int $user_id
 * @property string $date_at
 *
 * @property User $user
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'user_id' => 'User ID',
            'date_at' => 'Date At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('team_user', ['team_id' => 'id']);
    }

    public function isFounder()
    {
        return Yii::$app->user->getId() == $this->user_id;
    }

    public function isWorker()
    {
        if ($this->isFounder()){
            return false;
        }

        if ($this->getUsers()->where(['id' => Yii::$app->user->getId()])->count() != 0){
            return true;
        }

        return false;
    }

    public function getUsersRequest()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('request_add_to_team', ['team_id' => 'id']);
    }
}
