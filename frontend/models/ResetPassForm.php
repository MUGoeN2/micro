<?php
namespace frontend\models;

use common\models\ShortMessage;
use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPassForm extends Model
{
    public $tel;
    public $password;
    public $short_mess;
    public $re_password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tel' , 'password', 'short_mess','re_password'], 'required', 'message' => '必填'],
            ['short_mess', 'string', 'min' => 4, 'max' => 4, 'message' => '必须是4位'],
            ['short_mess', 'validateTel', 'skipOnEmpty' => false, 'skipOnError' => false],
            ['password', 'string', 'min' => 6, 'message' => '最短六位'],
            [['tel'],  'match','pattern' => '/^1[3-8]{1}[0-9]{1}[0-9]{8}$|189[0-9]{8}$/','message'=>'电话号码不正确'],
            ['tel', 'exist', 'targetClass' => '\common\models\User', 'skipOnEmpty' => false, 'skipOnError' => false, 'message' => '电话号码不存在'],
            ['re_password','compare','compareAttribute'=>'password','message'=>'两次密码不一致'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tel'=>'电话号码',
            'short_mess'=>'短信验证',
            'password'=>'新密码',
            're_password'=>'重新输入密码',
        ];
    }

    public function validateTel($attribute,$params)
    {

        $time = time() - 2* 60;
        $result = ShortMessage::find()->where(['tel'=>$this->tel, 'content' => $this->$attribute])->andWhere(['>', 'created_at', $time])->orderBy('created_at DESC')->one();
        if(empty($result)) {
            $this->addError($attribute, '验证码不正确.');
        }


    }
}
