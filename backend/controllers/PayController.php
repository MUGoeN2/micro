<?php
namespace backend\controllers;

use common\models\Price;
use common\models\Shopcart;
use dosamigos\qrcode\QrCode;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * Site controller
 */
class PayController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }
    public function actionPayment($product_id) {
        if(isset($product_id)){
            ini_set('date.timezone','Asia/Shanghai');
            $notify_url="http://www.growthmemo.com/pay/example/native_notify.php";
            $notify = new \NativePay();
            $input = new \WxPayUnifiedOrder();
            $input->SetBody("Growthmemo企业测评完整版");
            $input->SetAttach("attach");
            $trade_no=\WxPayConfig::MCHID.date("YmdHis");
            $input->SetOut_trade_no($trade_no);
            $fee=1;
            $input->SetTotal_fee($fee);
            $input->SetTime_start(date("YmdHis"));
            $input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetGoods_tag("tag");
            $input->SetNotify_url($notify_url);
            $input->SetTrade_type("NATIVE");
            $input->SetProduct_id($product_id);
            $result = $notify->GetPayUrl($input);
            $url = $result["code_url"];
            //数据库建立订单
            $trade_record=Shopcart::find()->where(['uid'=>Yii::$app->user->id,'product_id'=>$product_id,'status'=>0])->one();
            if(!empty($trade_record)){   //如果点击购买却没有付款 （二次点击购买）
                $trade=$trade_record;
            }else  $trade=new Shopcart();
            $trade->trade_id=$trade_no;
            $trade->product_id=$product_id;
            $trade->uid=Yii::$app->user->id;
            $trade->username=Yii::$app->user->identity->username;
            $trade->trade_name="收费版";
            $trade->trade_money="$fee";
            $trade->status=0;   //  0表示点击购买 但未到账
            if($trade->save()){  // 新建或更新支付记录
                $arr=array();
                $arr['trade_no']=$trade_no;
                $arr['url']=$url;
                return \Yii::createObject([
                    'class' => 'yii\web\Response',
                    'format' => \yii\web\Response::FORMAT_JSON,
                    'data' => [
                        'obj' => $arr,
                        'code' => 100,
                    ],
                ]);
            }else return false;
        }else return false;
    }
    public  function actionQrcode($url){
        QrCode::png($url);
    }
    public  function actionQuery($out_trade_no){
        $uid=Yii::$app->user->id;
        if(isset($out_trade_no) && $out_trade_no != ""){
            $out_trade_no = $_REQUEST["out_trade_no"];
            $input = new \WxPayOrderQuery();
            $input->SetOut_trade_no($out_trade_no);
            $data=\WxPayApi::orderQuery($input);
//            exit();
            //  p($data);die;
            if($data['trade_state']=="SUCCESS"){ //如果支付成功则改变数据库记录状态
                $trade=Shopcart::find()->where(['uid'=>$uid,'trade_id'=>"$out_trade_no",'status'=>0])->one();
                if(!empty($trade)) {
                    $trade->status = 1;
                    $trade->transaction_id = $data['transaction_id'];
                    if($trade->save()){
                        return \Yii::createObject([
                            'class' => 'yii\web\Response',
                            'format' => \yii\web\Response::FORMAT_JSON,
                            'data' => [
                                'obj' => $data,
                                'code' => 100,
                            ],
                        ]);
                    }else{
//                       p($trade->getErrors());die;
                        return false;
                    }
                } else return false;

            }   else return false;

        }
        else return false;
    }
    public function actionPrice(){

        $model=Price::find()->one();
        if($model->load(Yii::$app->request->post())&&$model->save()){
         return $this->redirect(['site/admin']);
        }
        else return $this->render('price',['model'=>$model]);
    }


}