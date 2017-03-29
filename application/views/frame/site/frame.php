<!DOCTYPE html>
<html lang="tw">
  <head>
    <?php echo isset ($meta_list) ? $meta_list : ''; ?>

    <title><?php echo isset ($title) ? $title : ''; ?></title>

<?php echo isset ($css_list) ? $css_list : ''; ?>

<?php echo isset ($js_list) ? $js_list : ''; ?>

  </head>
  <body lang="zh-tw">
<?php
    if (isset ($banner) && $banner) { ?>
      <div id='banner'>
        <div class='_i'><img src='<?php echo $banner->name->url ();?>'></div>
        <form id='banner_search' method='get' action='<?php echo base_url ('search');?>'>
          <input type='text' name='keywords' id='q' value='' onkeyup="this.setAttribute('value', this.value);"/>
          <button type='submit' class='icon-search'></button>
          <label class='icon-search' for='q'></label>
        </form>
        <a id='banner_down' class='icon-chevron-thin-down'></a>
      </div>
<?php
    } ?>

    <div id='top_bar'></div>

    <header id='header'>
      <div class='container'>
        <img src="<?php echo base_url ('resource', 'image', 'site', 'TopLogo.png');?>">
        <section>
          <header><a href='<?php echo base_url ('');?>' class='dftm9'><?php echo Info::info ()->site_title;?></a></header>
          <p><?php echo Info::info ()->site_desc;?></p>
        </section>
        
        <form id='header_search' method='get' action='<?php echo base_url ('search');?>'>
          <input type='text' name='keywords' id='q2' value='' onkeyup="this.setAttribute('value', this.value);"/>
          <button type='submit' class='icon-search'></button>
          <label class='icon-search' for='q2'></label>
        </form>
      </div>
    </header>

    <div id='mobile_btn'>
      <div class='container'>

        <form id='mobile_search' method='get' action='<?php echo base_url ('search');?>'>
          <input type='text' name='keywords' id='q3' value='' onkeyup="this.setAttribute('value', this.value);"/>
          <button type='submit' class='icon-search'></button>
          <label class='icon-search' for='q3'></label>
        </form>
        <a class='icon-menu' id='menu_btn'></a>
      </div>
    </div>

    <div id='menu'>
      <div class='container'>
        <div>
          <a href="<?php echo base_url ('about');?>">關於 Kyo 桑</a>
        </div>
<?php if ($menus = Menu::all (array ('limit' => 8, 'include' => array ('subs'), 'conditions' => array ('menu_id = 0')))) { ?>
  <?php foreach ($menus as $menu) { ?>
          <div>
            <a href="<?php echo $menu->link ? $menu->link : base_url ('search', $menu->title);?>" target='_blank'><?php echo $menu->title;?></a>

      <?php if ($menu->subs) { ?>
              <div>
          <?php foreach ($menu->subs as $sub) { ?>
                  <a href="<?php echo $sub->link ? $sub->link : base_url ('search', $sub->title);?>"><?php echo $sub->title;?></a>
          <?php } ?>
              </div>
      <?php } ?>
          </div>
  <?php } ?>
<?php } ?>


        <span class='count'>
          <span>本日人氣：<?php echo ($dpv = Pv::find ('one', array ('select' => 'count', 'conditions' => array ('day = ?', date ('Y-m-d'))))) ? $dpv->count : 0;?></span>
          <span>累積人氣：<?php echo ($apv = Pv::find ('one', array ('select' => 'SUM(count) as sum', 'conditions' => array ()))) ? $apv->sum : 0;?></span>
        </span>
      </div>
    </div>
    <div id='cover'></div>

    <div id='tags'>
      <div class='container'>
        <a class='icon-keyboard_arrow_left dis'></a>
        <div>
    <?php foreach (Article::randTags () as $tag) { ?>
            <a href='<?php echo base_url ('search', $tag);?>'><?php echo $tag;?></a>
    <?php } ?>
        </div>
        <a class='icon-keyboard_arrow_right'></a>
      </div>
    </div>
    <?php echo isset ($content) ? $content : ''; ?>

    
    <div id='bottom_logo'>
      <div class='container'>
        <img src='<?php echo base_url ('resource', 'image', 'site', 'FooterLogo.png');?>'>
      </div>
    </div>

    <footer id='footer'>
      <div class='container'>
        <div><span>本日人氣：<?php echo ($dpv = Pv::find ('one', array ('select' => 'count', 'conditions' => array ('day = ?', date ('Y-m-d'))))) ? $dpv->count : 0;?></span><span>│</span><span>累積人氣：<?php echo ($apv = Pv::find ('one', array ('select' => 'SUM(count) as sum', 'conditions' => array ()))) ? $apv->sum : 0;?></span></div>
      </div>
    </footer>

    <a id='top' class='icon-keyboard_arrow_up'></a>

  </body>
</html>
