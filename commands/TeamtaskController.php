<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TeamtaskController extends Controller
{

    public $password;

    public function optionAliases()
    {
        return [
            'p' => 'password',
        ];
    }

    public function options($actionID)
    {
        return [
            'password',
        ];
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'teamtask controller. Dev by uCraft74')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionSetRootUser()
    {
        if (!$this->password){
            echo 'The password can\'t be empty'.PHP_EOL;
            return 1;
        }
        $user = new User();

        $model = User::findByUsername('root');
        if (empty($model)){
            $user = new User();
            $user->username = 'root';
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->created_at = date('Y-m-d');
            if ($user->save()){
                echo 'User \'root\' successfully added to database.'.PHP_EOL;
            }else{
                echo 'Error adding user'.PHP_EOL;
            }
        }else{
            echo 'The \'root\' user already exists in the database'.PHP_EOL;
        }
    }
}
