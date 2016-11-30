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
function getImages($limit=0,$order=0){
  $return=array();
  $limit=(int) $limit;
  $order=(int) $order;
  $addon="";


  $mainQuery = "SELECT * FROM images";
  if($order != 0 && $limit != 0){
    $addon=" ORDER BY image_id ASC LIMIT $limit";
  }else if($order != 0 && $limit == 0){
    $addon=" ORDER BY image_id ASC";
  }else if($order == 0 && $limit != 0){
    $addon=" ORDER BY image_id DESC LIMIT $limit";
  }else if($order == 0 && $limit == 0){
      $addon=" ORDER BY image_id DESC";
  }
  $query=mysql_query($mainQuery.$addon);
  while($row=mysql_fetch_assoc($query)){

    $return[]=array(
      "image_id"=>$row['image_id'],
      "img_name"=>$row['img_name'],
      "img_desc"=>$row['img_desc'],
      "timestamp"=>$row['timestamp']);
  }

  return $return;
}
?>
