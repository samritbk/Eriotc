<header style="box-shadow: 1px 1px 2px #333; text-align:center; background:#455A64;  color:#FFF;">
  <div style="line-height:45px; height:45px; color:#FFF; font-size: larger;
    font-weight: 700;">ADMIN DASHBOARD</div>
  <div class="m90">
    <div class="left" style="height:55px; line-height:55px;">
      <ul class="adminUlMenu">
        <a href="../"><li>View Website (ትግርኛ)</li></a>
        <li>View Website (English)</li>
        <li>Send Internal Message</li>
        <div class="clear"></div>
      </ul>
    </div>
    <div class="right" style="height:55px; line-height:55px;">
      <ul class="adminUlMenu">
        <li><?php $data=getUsername($uid); echo  ucfirst($data['username']); ?></li>
        <a href="settings.php"><li>Settings</li></a>
        <a href="logout.php"><li>Logout</li></a>
        <div class="clear"></div>
      </ul>
    </div>
    <div class="clear"></div>
  </div>
</header>
