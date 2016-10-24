<?php
  include("connection/connect.php");
  include("functions/user.func.php");
  include("functions/article.func.php");
?>
<html>
<head>
<!--// SITE META //-->
<meta charset="UTF-8" />
<link rel='stylesheet' href="style.css" type='text/css' media='all' />
<title>ማሕበር ኪዳነ ምሕረት - ካምፓላ</title>
</head>
<body>
  <?php include("header.php"); ?>
<div style="height:80px; line-height:80px; background: whitesmoke;">
	<div class="marginer" style="width:90%; margin:auto;"><h2>ጽሑፍ</h2></div>
</div>

<div class="content">
	<div class="marginer" style="">
	<div class="left">
		<div style="background: white; border-radius:5px; margin:auto; overflow:hidden;">
			   <article>
           <?php
					 	if(isset($_GET['id']) && $_GET['id'] != 0){
								$article=getArticle($_GET['id']);
           ?>
           <h1><?php
					 if($article['error'] == 0){
            echo $article['article_title'];
           ?></h1>
					 <section style="font-size:18px; line-height:25px; text-align:justify;">
           <?php
            echo $article['article_text'];
					}else{
						echo $article['err_msg'];
					}
				}else{
					echo "No article selected";
				}
           ?>
				 	 </section>
         </article>
    </div>
  </div>

<div class="right" style="width:25%; background: #FFF; padding:5px 0px;">
	<div style="background: white; border-radius:5px; width:97%; margin: auto; height:95%;">
			<h3>ንይ ሎሚ ትምህርቲ</h3>
			<div style="line-height: 30px;">
				ንጽባሕቱ ሰዓት 5 ድ.ቀ ሳሚ ካብ ዲያቆን ዘተቀበላ ደብዳቤ ተሰኪሙ ናብ እንዳ ቤዛ ከደ። ቤዛ ጸብሒ ክስትሰርሕ ከም ዝጸንሐት  እቲ ካብ ርሑቅ ኮንካ  ዝሽትት ዘነበረ ጨና ሽሮ ይምስክር። ናይ ኽሽነ ኣቁሑት
				<div style="text-align:right; line-height:30px; font-weight:600; padding-right:5px;">ማት 15:15-65</div>
			</div>
	</div>
</div>
<div class="clear"></div>
</div>
<div style="height: 200px; background:#148585;">
	<div style="float: left;
    height: 100%;
    width: 30%;">a</div>
	<div style="float: left;
    height: 100%;
    width: 70%;">a</div>
</div>
</div>
</body>
</html>
