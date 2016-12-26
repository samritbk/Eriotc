<?php
  include("functions.php");
  include("admin/mail.php");
  print_r(getUser(1));
  echo assigedPostImageLoc(5);
?>
  </br>
  <meta charset="UTF-8" />
  <p>
<?php
  print_r(CompareUserPassword("beraki","beraki"));
  if(isset($_POST['submit'])){
    if(isset($_POST['article']) && isset($_POST['title'])){
      $title=$_POST['title'];
      $article=mysql_real_escape_string(addslashes(nl2br($_POST['article'])));
      $timestamp = time();
      $query= mysql_query("INSERT INTO posts(post_title,post_text,post_category,post_author_id,date_created,last_modified) VALUES ('$title','$article','1','1','$timestamp','$timestamp')");
      echo mysql_error();
    }
  }
?>
</br>
<form action="" method="post">
  <input type="text" name="title" placeholder="Title"/></p>
  <textarea name="article" placeholder="Place article text here" cols="150" rows="10"></textarea></p>
  <input type="submit" name="submit" value="Submit"/>
</form>
<p>
<?php
// function htmail($to,$subject,$names,$conf,$email){
//
//   $headers = "From:LookOutSms <no-reply@lookoutsms.com> \r\n";
//   $headers .= "Reply-To: no-reply@lookoutsms.com \r\n";
//   $headers .= "MIME-Version: 1.0\r\n";
//   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//
//
//   $messsage="<html><head><meta charset="UTF-8" /></head><body>";
//   $messsage.="Hello there</br><p/>\r\n";
//   $messsage.="Your have requested for a new password, Please click the link below to reset your password.</br><p/>\r\n";
//   $messsage.="<a href='http://lookoutsms.com/reset_password.php?conf=".$conf."&r_email=".$email."' style=\"padding:10px; text-align:center;\">Change Password</a>";
//   $messsage.="</body></html>";
//
//   $m=mail($to,$subject, $messsage, $headers);
//   if($m){
//     return true;
//   }else{
//     return false;
//   }
// }
  //htmail("sami@localhost","Hello","Sami Bicha","dafagfgd","sami@localhost");
  // $post=getPost(1);
  // print_r($post);
  // echo $post['post_title']+"<br/>";
  // echo $post['post_text'];
//subscribedMail("sami@localhost","drogba20020@gmail.com")
  //sendMail("dsadsa","dadsas");
  //$article=getArticle(11);
  //echo refactorText($article['article_text']);

  print_r(getUsers());
?>
