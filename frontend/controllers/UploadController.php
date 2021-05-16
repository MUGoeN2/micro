<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/12/18
 * Time: 13:09
 */
namespace frontend\controllers;

use common\models\Img;
use yii\web\Controller;

class UploadController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionImg()
    {
        $desk= $_POST['category'];
        $size= $_POST['size'];
        $attribute="pic";
        $file_key=$desk;//这个键名要对应表单的model生成的键名 所以有驼峰命名
        $desk=strtolower($desk);
        $cate=$desk;
        if(isset($_POST['attribute']) && $attribute!=$_POST['attribute']) $attribute=$_POST['attribute'];

        $Folder =  \Yii::$app->basePath.'/web/upload/'.$desk;
        $targetFolder = \Yii::$app->basePath.'/web/upload/'.$desk.'/' . date('Ymd');
        //$targetFolder = \Yii::$app->basePath.'/web/upload/'.$desk.'/' . date('Ymd'); //前台

        if(!file_exists($targetFolder)) {
            if(!file_exists($Folder)){
                $dir=$Folder;  $mode=0777;
                mkdir($dir, $mode);
            }
            $dir=$targetFolder;  $mode=0777;
            mkdir($dir, $mode);
        }
        if (!empty($_FILES)) {
            $tempFile = $_FILES[$file_key]['tmp_name'][$attribute];
            $fileParts = pathinfo($_FILES[ucfirst($file_key)]['name'][$attribute]);
            $extension = $fileParts['extension'];
            $random = time() . rand(1000, 9999);
            $randName = $random . "." . $extension;
            $targetFile = rtrim($targetFolder, '/') . '/' . $randName;
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png','JPG','JPEG','GIF','PNG');

            $upload_file_path = '/upload/'.$desk.'/' . date('Ymd') . '/' . $randName;
            $upload_file_path_small = '/upload/'.$desk.'/' . date('Ymd') . '/small' . $randName;

            $callback['url'] = $upload_file_path;
            $callback['url_small'] = $upload_file_path_small;
            $callback['filename'] = $fileParts['filename'];
            $callback['randName'] = $random;
            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                if(self::Save_img($callback['url'],$callback['url_small'],$cate,$size,$attribute)){ //更新数据库中img_small字段
                    return json_encode($callback['url_small']);
                }else
                    return json_encode("上传失败");
            } else {
                return json_encode('不能上传后缀为' . $fileParts['extension'] . '文件');
            }
        } else {
            return json_encode("没有上传文件");
        }
    }
    private function Save_img($url,$url_small,$cate,$size,$src_id)
    {
        $arr=explode('@',$size);
        $width=$arr[0];
        $height=$arr[1];
        //这里需要用绝对地址 做了软连接 可以不使用 \Yii::getAlias('@frontend')
        \yii\imagine\Image::thumbnail(\Yii::$app->basePath.'/web'.$url, $width, $height)
            ->save(\Yii::$app->basePath.'/web'.$url_small, ['quality' => 100]);

        $model=new Img();
        $model->img_id=rand(1000,9999).date('md').rand(1000,9999);
        $model->uid='user';
        $model->type=1;
        $model->src_id=$src_id;
        $model->cate=$cate;
        $model->img_big=$url;
        $model->img_small=$url_small;
        $model->status=1;

        if( $model->validate()&&$model->save()) return $model->img_id;
        else  return "wrong";
    }
    public function actionFile()
    {
        $desk= $_POST['category'];
        $attribute="file";
        $file_key=$desk;//这个键名要对应表单的model生成的键名 所以有驼峰命名
        $desk=strtolower($desk);
        if(isset($_POST['attribute']) && $attribute!=$_POST['attribute']) $attribute=$_POST['attribute'];

        $Folder =  \Yii::$app->basePath.'/web/upload/'.$desk;
        $targetFolder = \Yii::$app->basePath.'/web/upload/'.$desk.'/' . date('Ymd');
        //$targetFolder = \Yii::$app->basePath.'/web/upload/'.$desk.'/' . date('Ymd'); //前台

        if(!file_exists($targetFolder)) {
            if(!file_exists($Folder)){
                $dir=$Folder;  $mode=0777;
                mkdir($dir, $mode);
            }
            $dir=$targetFolder;  $mode=0777;
            mkdir($dir, $mode);
        }
        if (!empty($_FILES)) {
            $tempFile = $_FILES[$file_key]['tmp_name'][$attribute];
            $fileParts = pathinfo($_FILES[ucfirst($file_key)]['name'][$attribute]);
            $extension = $fileParts['extension'];
            $random = time() . rand(1000, 9999);
            $randName = $random . "." . $extension;
            $targetFile = rtrim($targetFolder, '/') . '/' . $randName;
            $fileTypes = array('pdf','PDF');
            $upload_file_path = '/upload/'.$desk.'/' . date('Ymd') . '/' . $randName;

            $callback['url'] = $upload_file_path;
            $callback['filename'] = $fileParts['filename'];
            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                return json_encode($callback['url']);
            } else {
                return json_encode('不能上传后缀为' . $fileParts['extension'] . '文件');
            }
        } else {
            return json_encode("没有上传文件");
        }
    }
}