<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/7/3
 * Time: 15:57
 */

if(Yii::$app->user->isGuest){
    echo "未登录";
}else{
    p(Yii::$app->user->identity);
    echo "已登录";
}
