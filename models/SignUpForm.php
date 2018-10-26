<?php
/**
 * Created by PhpStorm.
 * User: ucraft74
 * Date: 26.10.18
 * Time: 9:38
 */

namespace app\models;

use Yii;
use yii\base\Model;

class SignUpForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required', 'message' => 'Поле не может быть пустым'],
            ['email', 'email', 'message' => 'Не верный формат почты'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Логин уже занят'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Адрес уже зарегестрирован'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }

    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }

}