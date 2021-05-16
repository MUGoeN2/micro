<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Cate;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
/**
 * Site controller
 */
class MicroController extends Controller
{
    /**
     * @inheritdoc
     */

    public $layout='micro.php';
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex(){
        $arr_1=null;$arr_2=null;$arr_3=null;
        $cate_1=null;$cate_2=null;$cate_3=null;
        $cates=\common\models\Cate::find()->where(['status'=>1])->orderBy('weight DESC')->asArray()->limit(3)->all();
        if(isset($cates[0])) $cate_1=$cates[0];
        else $cate_1=\common\models\Cate::find()->where(['status'=>1])->orderBy('weight DESC')->asArray()->one();
        $query =  \common\models\Item::find()->where(['cate'=>$cate_1['name'],'status'=>1])->orderBy(['created_at'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $pages->pageSize=6;
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        $cate_1_pageCount=$pages->pageCount;
        $arr_1=$models;
        if(isset($cates[1])) $cate_2=$cates[1];
        if(isset($cate_2)){
            $query =  \common\models\Item::find()->where(['cate'=>$cate_2['name'],'status'=>1])->orderBy(['created_at'=>SORT_DESC]);
            $countQuery = clone $query;
            $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
            $pages->pageSize=8;
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
            $arr_2=$models;
        }
        if(isset($cates[2])) $cate_3=$cates[2];
        if(isset($cate_3)){
            $query =  \common\models\Item::find()->where(['cate'=>$cate_3['name'],'status'=>1])->orderBy(['created_at'=>SORT_DESC]);
            $countQuery = clone $query;
            $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
            $pages->pageSize=8;
            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
            $arr_3=$models;
        }
        return $this->render('index',[
            'arr_1'=>$arr_1,'arr_2'=>$arr_2,'arr_3'=>$arr_3,
            'cate_1'=>$cate_1,'cate_2'=>$cate_2,'cate_3'=>$cate_3,
            'cate_1_pageCount'=>$cate_1_pageCount]);
    }
    public function actionMore($cate){
        $query =  \common\models\Item::find()->where(['cate'=>$cate,'status'=>1])->orderBy(['created_at'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $pages->pageSize=6;
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        $arr_1=$models;
        $html='';
        if(!empty($arr_1)){
            if(isset($arr_1[0])){
                $html.='<div class="col-xs-3 item-box">';
                $html.='<img src="'.Yii::$app->request->baseUrl.$arr_1[0]['pic'].'">';
                $html.='</div>';
            }
            if(isset($arr_1[0])){
                $html.='<div class="col-xs-3 item-box">';
                $html.='<div class=" infobox-up text-left">';
                $html.='<div class="arrow-left-1"></div>';
                $html.='<div class="arrow-left-2"></div>';
                $html.='<span class="item-cate-title">'. $arr_1[0]['cate'].'</span>';
                $html.='<br>';
                $html.='<span class="item-title">'.$arr_1[0]['title'].'</span>';
                $html.='<br>';
                $html.='<span class="item-desc">'. $arr_1[0]['desc'].'</span>';
                $html.='</div>';
                if(!isset($arr_1[1])) $html.='</div>';
            }
            if(isset($arr_1[1])){
                $html.='<div class=" infobox-down text-right">';
                $html.='<div class="arrow-right-1"></div>';
                $html.='<div class="arrow-right-2"></div>';
                $html.='<span class="item-cate-title">'.$arr_1[1]['cate'].'</span>';
                $html.='<br>';
                $html.='<span class="item-title">'.$arr_1[1]['title'].'</span>';
                $html.='<br>';
                $html.='<span class="color-grey-d item-desc">'.$arr_1[1]['desc'].'</span>';
                $html.='</div>';
                $html.='</div>';
            }
            if(isset($arr_1[1])){
                $html.='<div class="col-xs-3 item-box">';
                $html.='<img src="'.Yii::$app->request->baseUrl.$arr_1[1]['pic'].'" data-baiduimageplus-ignore="1">';
                $html.='</div>';
            }
            if(isset($arr_1[2])){
                $html.='<div class="col-xs-3 item-box">';
                $html.='<img src="'.Yii::$app->request->baseUrl.$arr_1[2]['pic'].'" data-baiduimageplus-ignore="1">';
                $html.='<div class="recommend-infobox-style">';
                $html.=' <table class="table table-bordered">';
                $html.='<tr>';
                $html.='<td class="bg-grey color-grey" style="width: 50px;font-size: 18px">'.$arr_1[2]['cate'].'</td>';
                $html.='<td class="bg-grey-d">';
                $html.='<p class="color-white" style="font-size: 16px">'. $arr_1[2]['title'].'</p>';
                $html.='<p class="color-grey-d" style="font-size: 12px">'.$arr_1[2]['desc'].'</p>';
                $html.='</td>';
                $html.=' </tr>';
                $html.='</table>';
                $html.='</div>';
                $html.=' </div>';
            }
            if(isset($arr_1[3])){
                $html.='<div class="col-xs-3 item-box">';
                $html.='<img src="'.Yii::$app->request->baseUrl.$arr_1[3]['pic'].'" data-baiduimageplus-ignore="1">';
                $html.='<div class="recommend-infobox-style">';
                $html.=' <table class="table table-bordered">';
                $html.='<tr>';
                $html.='<td class="bg-grey color-grey" style="width: 50px;font-size: 18px">'.$arr_1[3]['cate'].'</td>';
                $html.='<td class="bg-grey-d">';
                $html.='<p class="color-white" style="font-size: 16px">'. $arr_1[3]['title'].'</p>';
                $html.='<p class="color-grey-d" style="font-size: 12px">'.$arr_1[3]['desc'].'</p>';
                $html.='</td>';
                $html.=' </tr>';
                $html.='</table>';
                $html.='</div>';
                $html.=' </div>';
            }
            if(isset($arr_1[4])){
                $html.='<div class="col-xs-3 item-box">';
                $html.='<img src="'.Yii::$app->request->baseUrl.$arr_1[4]['pic'].'">';
                $html.='</div>';
            }
            if(isset($arr_1[4])){
                $html.='<div class="col-xs-3 item-box">';
                $html.='<div class=" infobox-up text-left">';
                $html.='<div class="arrow-left-1"></div>';
                $html.='<div class="arrow-left-2"></div>';
                $html.='<span class="item-cate-title">'. $arr_1[4]['cate'].'</span>';
                $html.='<br>';
                $html.='<span class="item-title">'.$arr_1[4]['title'].'</span>';
                $html.='<br>';
                $html.='<span class="item-desc">'. $arr_1[4]['desc'].'</span>';
                $html.='</div>';
                if(!isset($arr_1[5])) $html.='</div>';
            }
            if(isset($arr_1[5])){
                $html.='<div class=" infobox-down text-right">';
                $html.='<div class="arrow-right-1"></div>';
                $html.='<div class="arrow-right-2"></div>';
                $html.='<span class="item-cate-title">'.$arr_1[5]['cate'].'</span>';
                $html.='<br>';
                $html.='<span class="item-title">'.$arr_1[5]['title'].'</span>';
                $html.='<br>';
                $html.='<span class="color-grey-d item-desc">'.$arr_1[5]['desc'].'</span>';
                $html.='</div>';
                $html.='</div>';
            }
            if(isset($arr_1[5])){
                $html.='<div class="col-xs-3 item-box">';
                $html.='<img src="'.Yii::$app->request->baseUrl.$arr_1[5]['pic'].'" data-baiduimageplus-ignore="1">';
                $html.='</div>';
            }
        }
        if(!empty($html)) return $html;
        else return "nothing";
    }

}



