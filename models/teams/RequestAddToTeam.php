<?php

namespace app\models\teams;

use app\models\Team;
use app\models\User;
use Yii;

/**
 * This is the model class for table "request_add_to_team".
 *
 * @property int $id
 * @property int $user_id
 * @property int $team_id
 * @property int $result
 *
 * @property Team $team
 * @property User $user
 */
class RequestAddToTeam extends \yii\db\ActiveRecord
{

    const RESULT_SENT = 0;
    const RESULT_ACCEPTED = 10;
    const RESULT_REJECTED = 20;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_add_to_team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'team_id', 'result'], 'integer'],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'team_id' => 'Team ID',
            'result' => 'Result',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function setReject()
    {
        $this->result = RequestAddToTeam::RESULT_REJECTED;
        $this->save();
    }

    public function setAccept()
    {
        $this->result = RequestAddToTeam::RESULT_ACCEPTED;
        $this->save();
    }
}
