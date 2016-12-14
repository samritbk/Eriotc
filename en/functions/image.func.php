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
function removeRelation($encoded_relation_id, $image_id){
  $return=array();
  $relation_id=base64_decode($encoded_relation_id);

  if($relation_id != 0){
    $query=mysql_query("DELETE FROM imagerelation WHERE relation_id=$relation_id");
    if($query){
      $return['error']=0;
      $return['relations']=getImageRelations($image_id,true);
    }else{
      $return['error']=1;
      $return['err_msg']="Database error :(";
    }
  }else{
    $return['error']=1;
    $return['err_msg']="Invalid relation";
  }

  return json_encode($return);
}
function getImageRelations($image_id, $json=false){
  $return=array();
  $image_id=(int) $image_id;

  if($image_id != 0){
    $query=mysql_query("SELECT * FROM imagerelation WHERE image_id=$image_id");
    $num_rows=mysql_num_rows($query);
    if($num_rows != 0){
      $return['error']=0;
      while($row=mysql_fetch_assoc($query)){
        $return[]=array(
          "relation_enconded_id" => base64_encode($row['relation_id']),
          "relative_id" => $row['relative_id'],
          "mode" => $row['mode']
        );
      }
    }else{
      $return['error']=1;
      $return['err_msg']="Relation not found";
    }
  }else{
    $return['error']=1;
    $return['err_msg']="Relative not set";
  }

  if($json){
    $return=json_encode($return);
  }

  return $return;

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
function isRelative($image_id,$relative_id,$mode){
  $image_id=(int) $image_id;
  $mode=(int) $mode;  // 0: post 1: news
  $relative_id=(int) $relative_id;

  if($image_id != 0 && $relative_id != 0){
    $query=mysql_query("SELECT * FROM imagerelation WHERE image_id=$image_id && relative_id=$relative_id && mode=$mode");
    $num_rows=mysql_num_rows($query);
    if($num_rows != 0){
      return true;
    }else{
        return false;
    }
  }else{
    return true;
  }
}
function addImageRelation($image_id,$mode,$relative_id,$uid,$json=false){
    $return=array();
    $image_id=(int) $image_id;
    $mode=(int) $mode;  // 1: post 2: news
    $relative_id=(int) $relative_id;
    $uid=(int) $uid;
    $exists=false;

    if($image_id != 0 && $relative_id != 0){
      switch($mode){
        case 1:
          $exists=postExists($relative_id);
          break;
        case 2:
          $exists=newsExists($relative_id);
          break;
      }

        if($exists){
          //$article=
            if(!isRelative($image_id,$relative_id,$mode)){
              $time=time();
              $query=mysql_query("INSERT INTO imagerelation(image_id,relative_id,mode,user_id,relation_created) VALUES ($image_id,$relative_id,$mode,$uid,$time)");

              if($query){
                $return['error']=0;
                $return['last_id']=mysql_insert_id();
                $return['relations']= getImageRelations($image_id, true);
              }else{
                $return['error']=1;
                $return['err_msg']="Database error :(";
              }
            }else{
              $return['error']=1;
              $return['err_msg']="Already a relative";
            }
        }else{
          $return['error']=1;
          $return['err_msg']="Relative doesn't exist";
        }
    }else{
      $return['error']=1;
      $return['err_msg']="Invalid error";
    }

    if(!$json){
      return $return;
    }else{
      return json_encode($return);
    }
}
function getImageLoc($image_id){
  $return=null;

  $query=mysql_query("SELECT * FROM images WHERE image_id=$image_id");
  $num_rows=mysql_num_rows($query);
  if($num_rows != 0){
    $row=mysql_fetch_assoc($query);

    $return="images/".$row['img_name'];

    return $return;
  }else{
    return $return;
  }
}
function assigedPostImageLoc($post_id, $must=0){
  $post_id= (int) $post_id;
  $return=null;

  $query=mysql_query("SELECT * FROM imagerelation WHERE mode=1 && relative_id=$post_id");
  $num_rows=mysql_num_rows($query);
  if($num_rows != 0){
    $row=mysql_fetch_assoc($query);
    $image_id=$row['image_id'];
    $return=getImageLoc($image_id);
  }

  if($return == null){
    if($must != 0){
      $return="kidanemihret.jpg";
      return $return;
    }else{
      return $return;
    }
  }else{
      return $return;
  }
}

function assigedNewsImageLoc($news_id, $must=0){
  $news_id= (int) $news_id;
  $return=null;

  $query=mysql_query("SELECT * FROM imagerelation WHERE mode=2 && relative_id=$news_id");
  $num_rows=mysql_num_rows($query);
  if($num_rows != 0){
    $row=mysql_fetch_assoc($query);
    $image_id=$row['image_id'];
    $return=getImageLoc($image_id);
  }

  if($return == null){
    if($must != 0){
      $return="kidanemihret.jpg";
      return $return;
    }else{
      return $return;
    }
  }else{
      return $return;
  }
}
?>
