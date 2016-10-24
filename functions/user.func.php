<?php
function getUser($user_id){
  $return = array();
  $user_id=(int) $user_id;

  $query= mysql_query("SELECT * FROM users WHERE user_id=$user_id");
  $num_rows=mysql_num_rows($query);
    if($num_rows != 0){
      $row = mysql_fetch_assoc($query);
      $return['error']=0;
      $return['user_id'] = $row['user_id'];
      $return['username'] = $row['username'];
      $return['fullname'] = $row['fullname'];
      $return['last_activity'] = $row['last_activity'];
    }else{
      $return['error']=1;
      $return['err_msg']="Can't find user";
    }
      return $return;
}

function compareUserPassword($username, $supposed_pass, $json=false,$session=false){ //bool
  $return = array();
  $username=$username;
  $password=$supposed_pass;
  $query= mysql_query("SELECT user_id, username, password FROM users WHERE username='$username'");
  $num_rows=mysql_num_rows($query);
  if($num_rows != 0){
    $row = mysql_fetch_assoc($query);
    if($row['password'] == md5($password)){
      $return['error']=0;
      $return['user_id']=$row['user_id'];
      if($session){
        $_SESSION['uid']=$return['user_id'];
      }
    }else{
      $return['error']=1;
      $return['err_msg']="Wrong password";
    }
  }else{
    $return['error']=1;
    $return['err_msg']="Can't find User";
  }
  if($json)
    $return=json_encode($return);
  return $return;
}

function getUsername($user_id){ //string
  $return = array();
  $user_id=(int) $user_id;

  $query= mysql_query("SELECT username FROM users WHERE user_id=$user_id");
  $num_rows=mysql_num_rows($query);
    if($num_rows != 0){
      $row = mysql_fetch_assoc($query);
      $return['error']=0;
      $return['username'] = $row['username'];
    }else{
      $return['error']=1;
      $return['err_msg']="Can't find user";
    }
      return $return;
}

function checkUsername($supposed_username){ //bool
  $return = array();
  $supposed_username= $supposed_username;

  $query= mysql_query("SELECT username FROM users WHERE username='$supposed_username'");
  $num_rows=mysql_num_rows($query);
    if($num_rows != 0){
      $row = mysql_fetch_assoc($query);
      $return['error']=0;
      $return['username'] = $row['username'];
    }else{
      $return['error']=1;
      $return['err_msg']="Can't find user";
    }
      return $return;
}

function checkLastActivity($user_id){ //timestamp
  $return = array();

  $query= mysql_query("SELECT last_activity FROM users WHERE user_id=$user_id");
  $num_rows=mysql_num_rows($query);
    if($num_rows != 0){
      $row = mysql_fetch_assoc($query);
      $return['error']=0;
      $return['last_activity'] = $row['last_activity'];
    }else{
      $return['error']=1;
      $return['err_msg']="Can't find user";
    }
      return $return;
}
function isSubscribed($email){
  $return=false;
  $email=mysql_real_escape_string(trim($email));
  $query=mysql_query("SELECT * FROM subscription WHERE email='$email'");
  $num_rows=mysql_num_rows($query);

  if($num_rows == 0){
    $return=false;
  }else{
    $return=true;
  }

  return $return;
}
function subscribe($email){
   $return=array();
   $email=mysql_real_escape_string(trim($email));
   $time=time();
   if(!isSubscribed($email)){
     $query=mysql_query("INSERT INTO subscription(email,email_list,timestamp) VALUES ('$email','1','$time')");
     if($query){
       $return['error'] = 0;
     }else{
        $return['error'] = 1;
        $return['err_msg'] = "Database error. Try again!";
        $return['error_code']="0x0000";
      }
    }else{
      $return['error'] = 1;
      $return['error_code']="0x0001";
      $return['err_msg'] = "You are already subscribed";
    }
   return json_encode($return);
}

?>
