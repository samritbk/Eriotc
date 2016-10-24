<?php
  function login($username, $password){
    $return=array();
    $query=mysql_query("SELECT * FROM users WHERE username='$username'");
    $num_rows=mysql_num_rows($query);

    if($num_rows != 0){

    }else{
      $return['error']=1;
      $return['err_msg']="Username not found";
    }

  }
  function comparePass(){
    
  }
?>
