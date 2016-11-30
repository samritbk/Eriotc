<?php
function subscribedMail($to,$from,$subject="Thank you for subscribing to our mailing list."){
  $headers = "Content-Type: text/html; charset=UTF-8\r\n";
  $headers .= "From:Mahber KidaneMihret Kampala <$from> \r\n";
  $headers .= "Reply-To: $from \r\n";
  $headers .= "MIME-Version: 1.0\r\n";

  $messsage="<!DOCTYPE html>";
  $messsage="<html><head><meta charset='UTF-8' /></head><body style:'background:whitesmoke !important; padding:25px;'>";
  $messsage.="<div style='margin:auto; background:whitesmoke; padding:25px 0px;'>";
  $messsage.="<div style='font-size:16px; width:90%; background:#FCFCFC; margin:auto; padding:15px;'><img src=\"http://localhost/church/small-eotc-logo.png\" width=\"50px\">";
  $messsage.="<p style='font-size:18px;'>ሰላም እግዚኣብሄር ንዓኹም ይኹን</p>\n\r";
  $messsage.="<p style='font-size:18px;'>ኣብ ኢሜልና ተመዝጊብኩም ኣለኹም። ኣብ ዚቐርብ ዕለታዊ ቃል ኣምላኽን ዜና ቤተክርስትያንን ንኽትከታተሉና ኣብ ኢሜልኩም ከነዘኻኽረኩም ኢና።</p>";
  $messsage.="<p>ማሕበር ኪዳነ ምህረት - ካምፓላ</p>";
  $messsage.="</div>";
  $messsage.="</div>";
  $messsage.="</body></html>";
  echo $messsage;
  $m=mail($to,$subject, $messsage, $headers);
   if($m){
     return true;
   }else{
     return false;
   }
}
  $mail=subscribedMail("drogba20020@gmail.com","info@zinalabs.com");
  if($mail){
    echo "T";
  }else{
    print_r(error_get_last());
  }
?>
