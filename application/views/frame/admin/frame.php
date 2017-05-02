<!DOCTYPE html>
<html lang="zh">
  <head>
    <?php echo isset ($meta_list) ? $meta_list : ''; ?>

    <title><?php echo isset ($title) ? $title : ''; ?></title>

<?php echo isset ($css_list) ? $css_list : ''; ?>

<?php echo isset ($js_list) ? $js_list : ''; ?>

  </head>
  <body lang="zh-tw">
    <?php echo isset ($hidden_list) ? $hidden_list : ''; ?>

    <header id='header'>
      <div>
        <img src='/resource/image/logo.png'>
        <a href='<?php echo base_url ('logout');?>'>登出</a>
      </div>
    </header>

    <div id='menu'>
      <div>
        <a href='<?php echo base_url ('admin');?>' class='icon-user<?php echo $_k == 'main' ? ' a' : '';?>' title='基本資料'></a>
        <a href='<?php echo base_url ('admin', 'banners');?>' class='icon-image<?php echo $_k == 'banner' ? ' a' : '';?>' title='首頁大圖'></a>
        <a href='<?php echo base_url ('admin', 'menus');?>' class='icon-ribbon<?php echo $_k == 'menu' ? ' a' : '';?>' title='選單設定'></a>
        <a href='<?php echo base_url ('admin', 'articles');?>' class='icon-file<?php echo $_k == 'article' ? ' a' : '';?>' title='文章管理'></a>
      </div>
    </div>

    <?php echo isset ($content) ? $content : ''; ?>

    <footer id='footer'>
      <div>
        如有任何問題歡迎 <a href='' target='_blank'>來信</a> 告知告知 / If there has any question, please <a href='mailto:<?php echo Cfg::setting ('main', 'mail');?>'>e-mail</a> right away.
      </div>
    </footer>

  </body>
</html>