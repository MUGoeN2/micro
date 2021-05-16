<?php
namespace frontend\models;

use common\models\User;
use common\models\UserMess;
use common\models\UserAccount;
use yii\base\Model;
use Yii;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $tel;
    public $password;
  //  public $verifyCode;
  //  public $status;  //可注册状态，手机验证后 返回1 表示可注册

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已注册'],
            ['username', 'string', 'min' => 2, 'max' => 255],

//            ['tel', 'filter', 'filter' => 'trim'],
            ['tel', 'required'],
            ['tel',  'match','pattern' => '/^1[3-8]{1}[0-9]{1}[0-9]{8}$|189[0-9]{8}$/','message'=>'请填写正确的电话号码.'],
//            ['tel', 'string', 'max' => 255],
            ['tel', 'unique', 'targetClass' => '\common\models\User', 'message' => '号码已注册'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

     //       ['verifyCode', 'captcha'],
     //       ['status', 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
     //       'verifyCode' => '验证码',
            'username' => '用户名',
            'password' => '设置密码',
            'tel' => '电话',
       //     'status' => '可注册状态',  //0表示不能
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->tel = $this->tel;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                $userMessage = new UserMess();   //创建用户信息表
                $userMessage->id=$user->id;
                $userMessage->uid=date('md',time()).$user->id;
                $userMessage->username=$this->username;
             //   $userMessage->tel = $this->tel;
                if($userMessage->save()){
                    $UserAccount = new UserAccount();   //创建用户账户
                    $UserAccount->id=$user->id;
                    $UserAccount->uid=date('md',time()).$user->id;
                    $UserAccount->username=$this->username;
                    $UserAccount->tel = $this->tel;
                    $UserAccount->save();
                    if($UserAccount->save()){
                      return $user;
                    }
                    else return false;
                }
                else return false;
            }
            else return false;
        }

        return null;
    }
}
