<?php
  include("functions.php");
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
	<div class="marginer" style="width:90%; margin:auto;">
    <h2 style="float:left;">
    <?php
    if(isset($_GET['s'])){
      ?>
        መልሲ ናይ "<?php echo $_GET['s']; ?>"
      <?php
    }
    ?>
    </h2>
    <div class="right" style="line-height:64px; height:100%; display: table-cell;
    vertical-align: middle;">
      <div class="searchBoxCover">
        <i class="ion-search" style="font-size:16px; margin-right:10px;"></i>
        <input type="search" id="search" placeholder="ጽሑፋት ድለ" value="<?php if(isset($_GET['s']) && $_GET['s'] != null){ echo $_GET['s']; }?>">
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<div class="content">
<?php //print_r(searchArticles("ሻይ")); ?>
  <div class="marginer">
    <div class="prayer">
    <h1>A’atib Getsye- I cross my Face</h1>
    <div class="col-3">
      <div class="m90">
      አአትብ ገጽየ ወኲለንታየ በኣርኣያ ትእምርተ መስቀል፣በስመ አብ: ወወልድ: ወመንፈስ ቅዱስ: አሐዱአምላክ በቅድስት ሥላሴ፣ እንዘ ኣአምን ወእትመኃጸን፣ እክህደከ ሰይጣን፣ በቅድመ ዛቲ እምየ ቅድስትቤተክርስቲያን፣ እንተ ይእቲ ስምእየ ማርያም ጽዮን፣ ለዓለመዓለም፣አሜን።
      </div>
    </div>
    <div class="col-3">
      <div class="m90">
      A’atib getsye wekulu entinaye be-ti’imrte Mesqel beSim Ab weWeld weMenfesQidus Ahadu Amlak beQidist Silassie inze a’amin we’it mehatsen ikehedike saytan beqidme zati Emye Qidist beteChristian inte-yiite Simye Mariam Tsion le-alem alem amen
      </div>
    </div>
    <div class="col-3">
      <div class="m90">
      I cross my face and all of myself in the symbol of the Cross, In the Name of the Father Son and Holy Spirit One God in the Name of the Holy Trinity that I believe and entrust myself I rebuke you Satan before my Mother the Holy Church Who name is St. May of Zion Forever and Ever amen.
      </div>
    </div>

    <h1>Niakuteke – We Thank You</h1>
    <div class="col-3">
      <div class="m90">
      ነአኩተከ እግዚኦ ወንሴብሓከ፣ ንባርከከ እግዚኦወንትአመነከ ፣ ንስእለከ እግዚኦ ወናስተብቁዓከ ፣ ንገኒለከ እግዚኦ፣ወንትቀነይ ለስምከ ቅዱስ። ንሰግድ ለከ፣ኦዘለከ፣ ይሰግድ ኩሉ ብርክ ፣ ወለከ ይትቀነይ ኩሉ ልሳን። አንተ ውእቱ ኣምላከ ኣማልክት፣ ወእግዚኣ ኣጋእዝት፣ወንጉሰ ነገስት፣ ኣምላክ አንተ ለኩሉ ዘሥጋ ፣ወለኩላዘነፍስ፣ ወንጼውኣከ ንሕነ፣ በከመ መሃረነ ቅዱስወልድከ ፣ እንዘ ይብል አንትሙሰ ሶበ ትጸልዩ ከመዝ በሉ።
      </div>
    </div>
    <div class="col-3">
      <div class="m90">
      Niakuteke Egzio wene-siebihake Nibarekeke Egzio wenit-ameneke Nisi’ilke Egzio wenastebequake Nigenileke Egzio wenitqeney leSimike Qidus Nisegid-leke O zeleke, ysegid kulu birk weleke yitqeney kulu lisan Ante wi’itu, Amlak Amalikt, weEgzia Egaist, weNigus negest Amlak ante le’kulu ze-siga wele-kulu ze’nefs Wene-tsewi’ake nihne bekeme meharene Qidus weldike inze yibil: “Antemuse, sobe ti’tseliyu kemezi belu…”
      </div>
    </div>
    <div class="col-3">
      <div class="m90">
      We thank You Lord and we praise You We Bless You Lord and we believe in You We beg  You Lord look to you We come to You and serve Your Holy Name We bow to You to whom all knees bow and all tongues worship You are Lord of lords, God of gods, King of kings You are God of All flesh and Spirit We call out Your name as Your Holy Son taught us saying: “When you pray say…”
      </div>
    </div>
    <div class="clear"></div>
    </div>
  </div>
</div>
<?php include("info.php"); ?>
<?php include("footer.php"); ?>
</body>
</html>
