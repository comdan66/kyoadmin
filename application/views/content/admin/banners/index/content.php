<div id='info'>
  <div>
    <div>
      <h1>設定網站入口圖片</h1>
      <span>選取網站入口圖片，請使用大小不超過 100kb 的方形圖片</span>
    </div>
    <div>
      <!-- <span class='icon-login'>2015-12-12 12:12:12</span> -->
      <!-- <a href="">+ 新增文章</a> -->
    </div>
  </div>
</div>

<div class='table'>
  <div>
    
    
    <div class='tr n2'>
      <div>目前圖片</div>
      <div>
        <form method='post' action='<?php echo base_url ('admin', 'banners', 'submit');?>' enctype='multipart/form-data'>
          <?php
            if ($banner = Banner::last ()) { ?>
              <img src='<?php echo $banner->name->url ();?>'>
          <?php
            } 
            if ($_flash_danger = Session::getData ('_flash_danger', true)) { ?>
              <div id='msg'><?php echo $_flash_danger;?></div>
      <?php }
            if ($_flash_info = Session::getData ('_flash_info', true)) { ?>
              <div id='msg_i'><?php echo $_flash_info;?></div>
      <?php }?>
          <input type='file' id='file' name='file' />
          <div><button for='file'>確定</button></div>
        </form>
      </div>
    </div>
  </div>
</div>