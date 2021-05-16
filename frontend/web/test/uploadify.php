<?php
require_once 'CThumb.php';

if(isset($_POST['timestamp'])){
            if($_POST['category']=='haibao'){
                $targetFolder = '../uploads/haibao/'.date('Y/md');
            }
            if($_POST['category']=='goods'){
                $targetFolder = '../uploads/goods/'.date('Y/md');
            }
            mkdirs($targetFolder);
           if (!empty($_FILES)) {
               $tempFile = $_FILES['Filedata']['tmp_name'];
               $fileParts = pathinfo($_FILES['Filedata']['name']);
               $extension = $fileParts['extension'];
               $random = time() . rand(1000, 9999);
               $randName = $random . "." . $extension;
               $targetFile = rtrim($targetFolder,'/') . '/' . $randName;
               $fileTypes = array('jpg','jpeg','gif','png');
               if($_POST['category']=='haibao'){
                   $uploadfile_path = 'Uploads/haibao/'.date('Y/md').'/'.$randName;
               }
               if($_POST['category']=='goods'){
                   $uploadfile_path = 'Uploads/goods/'.date('Y/md').'/'.$randName;
               }

               $callback['url'] = $uploadfile_path;
               $callback['filename'] = $fileParts['filename'];
               $callback['randName'] = $random;
               if (in_array($fileParts['extension'],$fileTypes)) {
                   move_uploaded_file($tempFile,$targetFile);
                   echo json_encode($callback);
               } else {
                   echo '不能上传后缀为'.$fileParts['extension'].'文件';
               }
           }else{
               echo "没有上传文件";
           }
       }

function mkdirs($dir, $mode = 0777)
{
    if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
    if (!mkdirs(dirname($dir), $mode)) return FALSE;
    return @mkdir($dir, $mode);
}