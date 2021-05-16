<?php
namespace backend\models;

use common\models\Admin;
use common\models\AdminMess;
use yii\base\Model;
use Yii;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;
  //  public $status;  //可注册状态，手机验证后 返回1 表示可注册

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Admin', 'message' => '用户名已注册'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'required'],
            ['email',  'email','message'=>'请填写正确邮箱.'],
            ['email', 'unique', 'targetClass' => '\common\models\Admin', 'message' => '号码已注册'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['verifyCode', 'captcha'],
     //       ['status', 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'verifyCode' => '验证码',
            'username' => '用户名',
            'password' => '设置密码',
            'email' => '邮箱',
//            'status' => '可注册状态',  //0表示不能
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
            $admin = new Admin();
            $admin->username = $this->username;
            $admin->email = $this->email;
            $admin->setPassword($this->password);
            $admin->generateAuthKey();
            if ($admin->save()) {
                      return $admin;
            }
            else return false;
        }

        return null;
    }
}
