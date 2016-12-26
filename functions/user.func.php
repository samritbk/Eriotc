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
function getUsers($limit=0, $order=0){
  $return=array();
  $limit=(int) $limit;
  $order=(int) $order;
  $addon="";

  $mainQuery = "SELECT * FROM users";
  if($order != 0 && $limit != 0){
    $addon=" ORDER BY user_id ASC LIMIT $limit";
  }else if($order != 0 && $limit == 0){
    $addon=" ORDER BY user_id ASC";
  }else if($order == 0 && $limit != 0){
    $addon=" ORDER BY user_id DESC LIMIT $limit";
  }else if($order == 0 && $limit == 0){
      $addon=" ORDER BY user_id DESC";
  }
  $query=mysql_query($mainQuery.$addon);
  while($row=mysql_fetch_assoc($query)){

    $return[]=array(
      "user_id"=>$row['user_id'],
      "username"=>$row['username'],
      "password"=>$row['password'],
      "fullname"=>$row['fullname'],
      "email"=>$row['email'],
      "privilage"=>$row['privilage'],
      "last_activity"=>$row['last_activity']);
  }

  return $return;
}
function isSuperAdmin($user_id){
  $user_id = (int) $user_id;
  $privilage = getUserPrivilage($user_id);

  if($privilage['error'] == 0){
    if($privilage['privilage'] == 0){
      return true;
    }else{
      return false;
    }
  }else{
    return false;
  }
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
function getUserPrivilage($user_id){
  $return=array();
  $user_id = (int) $user_id;

  if($user_id != 0){
    $query= mysql_query("SELECT * FROM users WHERE user_id=$user_id");
    $num_rows=mysql_num_rows($query);

    if($num_rows != 0){
      $row=mysql_fetch_assoc($query);

      $return['error']=0;
      $return['privilage']=$row['privilage'];
    }else{
      $return['error']=1;
      $return['err_msg']="Database error :(";
    }
  }else{
    $return['error']=1;
    $return['err_msg']="User not specified :(";
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
//Suggestion Box Along with its Email box of the suggestee

function suggest($suggestion,$email){
   $return=array();
   $suggestion=mysql_real_escape_string(trim($suggestion));
   $email=mysql_real_escape_string(trim($email));

   $time=time();

     $query=mysql_query("INSERT INTO suggestionbx(suggest,email,timestamp) VALUES ('$suggestion','$email','$time')");
     if($query){
       $return['error'] = 0;
     }else{
        $return['error'] = 1;
        $return['err_msg'] = "Database error. Try again!";
        $return['error_code']="0x0000";
      }
       return json_encode($return);
}

function subscribedMail($to,$from,$subject="Thank you for subscribing to our mailing list."){
  $headers = "Content-Type: text/html; charset=UTF-8\r\n";
  $headers .= "From:Mahber KidaneMihret Kampala <$from> \r\n";
  $headers .= "Reply-To: $from \r\n";
  $headers .= "MIME-Version: 1.0\r\n";

  $messsage="<!DOCTYPE html>";
  $messsage="<html><head><meta charset='UTF-8' /></head><body style:'background:whitesmoke !important; padding:25px;'>";
  // $messsage.="<div style='margin:auto; background:#4dad7f; padding:25px 0px;'>";
  // $messsage.="<div style='font-size:16px; width:90%; background:#FCFCFC; margin:auto; padding:15px;'>
  //             <img src=\"http://localhost/church/small-eotc-logo.png\" align='center' width=\"50px\">";
  // $messsage.="<p style='font-size:25px;'>ማሕበር ኪዳነ ምህረት - ካምፓላ</p>\n\r";
  // $messsage.="<p style='font-size:18px;'>ሰላም እግዚኣብሄር ንዓኹም ይኹን</p>\n\r";
  // $messsage.="<p style='font-size:18px;'>ኣብ ሊስታና ተመዝጊብኩም ኣለኹም። ኣብ ዚቐርብ ዕለታዊ ቃል ኣምላኽን ዜና ቤተክርስትያንን ንኽትከታተሉና ኣብ ኢሜልኩም ከነዘኻኽረኩም ኢና።</p>";
  // $messsage.="<p>ክፍሊ ዌብሳይት<br/>ማሕበር ኪዳነ ምህረት - ካምፓላ</p>";
  // $messsage.="</div>";
  // $messsage.="</div>";
  // $messsage.="</body></html>";
  $messsage.='<div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee">
  	<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
      <tbody>
          <tr>
          	<td>
                  <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                  <tbody>
                  	<tr>
                      	<td>
                  			<table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                              <tbody>
                              	<tr>
                                      <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0">
                                          <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr height="40px;"></tr>
                                          	<tr>
                                              	<td width="30"></td>
                                                  <td align="center" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="#" target="_blank"><img src="http://localhost/church/eotc-logo.png" align="center" width="100px"></a></td>
                                                  <td width="30"></td>
                                              </tr>
                                         	</tbody>
                                          </table>
                                    	</td>
                      			    </tr>
                                  <tr>
                                      <td colspan="3" align="center">
                                          <table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                          	<tr>
                                                  <td align="center">
                                                      <h3 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:26px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">ማሕበር ኪዳነ ምህረት - ካምፓላ</h3>
                                                  </td>
                                                  <td width="25"></td>
                                              </tr>
                                              <tr>
                                              	<td colspan="3" height="40"></td></tr><tr><td colspan="5">
                                                      <p style="font-size:18px;line-height:24px;font-weight:lighter;padding:0;margin:0">
                                                      ሰላም እግዚኣብሄር ንዓኹም ይኹን
                                                      <p style="font-size:18px;">ኣብ ሊስታና ተመዝጊብኩም ኣለኹም። ኣብ ቐረባ ዕለታዊ ቃል ኣምላኽን ፥ ዜና ቤተክርስትያንን ንኽትከታተሉና ኣብ ኢሜልኩም ከነዘኻኽረኩም ኢና።</p>
                                                      </p><br>
                                                      <p style="font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">
                                                      ክፍሊ ዌብሳይት<br/>ማሕበር ኪዳነ ምህረት - ካምፓላ</p>
                                                  </td>
                                              </tr>
                                              <tr height="40px;"></tr>
                                   	</tbody>
                                      </table>
                               	</td>
                     			</tr>
   	</tbody>
      </table>
  </div>';
  $messsage.="</body></html>";
  echo $messsage;
  $m=mail($to,$subject, $messsage, $headers);
   if($m){
     return true;
   }else{
     return false;
   }
}
function timestampToGeezDating($timestamp){
  $geezMonthName=array('01'=>'ጥሪ', '02'=>'የካቲት','03'=>'መጋቢት','04'=> 'ሚያዝያ', '05'=>'ግንቦት', '06'=>'ሰነ', '07'=>'ሓምለ','08'=>'ነሓሰ','09'=>'መስከረም', '10'=>'ጥቅምቲ','11'=>'ሕዳር', '12'=>'ታሕሳስ');

  return gmdate("d",$timestamp)." ".$geezMonthName[gmdate("m",$timestamp)]." ".gmdate("Y",$timestamp);
}
?>
