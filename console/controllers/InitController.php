<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/8/10
 * Time: 15:51
 */

namespace console\controllers;

use common\models\user;

class InitController extends \yii\console\Controller
{
    public function actionUser(){

        echo "create init user .....\n";
        $username=$this->prompt('Input Username');
        $email=$this->prompt('Input email');
        $password=$this->prompt('Input password');

        $model=new User();
        $model->username=$username;
        $model->email=$email;
        $model->password=$password;
        if(!$model->save()){
            foreach($model->getErrors() as $errors){
                foreach($errors as $e) {
                    echo "$e\n";
                }
            }
            return 1;
        }
        return 0;
    }
}