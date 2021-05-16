<?php
namespace frontend\controllers;

use common\models\LoginForm;
use common\models\User;
use Yii;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class AdminController extends Controller
{
    public $layout="wide.php";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','login','logout', 'signup', 'add-user'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','logout', 'signup', 'add-user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function  actionLogin(){
        $LoginForm=new LoginForm();
        if($LoginForm->load(Yii::$app->request->post())&&$LoginForm->validate()) {
            $LoginForm->login();
            return $this->redirect('index');
        }
        else return $this->render('login', [
            'model' => $LoginForm,
        ]);
    }
    public function actionLogout(){
        Yii::$app->user->logout();
        $this->redirect('login');
    }
    public function actionSignup(){

    }
    public function  actionIndex(){
        $this->layout="manage.php";
        return $this->render('index', []);
    }
    public function actionAddUser(){
        $username="admin";
        $password="cs2017";
        $user = new User();
        $user->username = $username;
        $user->setPassword($password);
        $user->generateAuthKey();
        if($user->save()){
            echo "用户名：".$username.'<br>';
            echo "密码：".$password;
        }else {
            echo "失败";
            p($user->getErrors());
        }
    }
}