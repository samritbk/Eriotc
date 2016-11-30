<?php
function uploadImage($image, $imageDesc){
  if(isset($image['size'], $image['tmp_name'])){
    if(isImage(getExtention($image['name']))){

      $time=time();
      $name=$image['name'];
      $tmp_name=$image['tmp_name'];
      $img_size=$image['size'];
      $ext=getExtention($name);
      $filename=md5($time).".".$ext;

      if(move_uploaded_file($tmp_name,"../images/$filename")){
          $query=mysql_query("INSERT INTO images(img_name,img_desc,timestamp) VALUES ('$filename','$imageDesc','$time')");
          if($query){
            echo "Image Uploaded";
          }else{
            echo mysql_error();
          }
      }else{
        echo "not moved";
      }

    }else{
      echo "please uploade an image";
    }
  }else{
    echo "file error";
  }
}
function isImage($ext){
  if($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif"){
    return true;
  }else{
    return false;
  }
}
function getExtention($filename){
  $ext= explode('.',$filename);
  $count= count($ext);
  return $ext[$count-1];
}
?>
