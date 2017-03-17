<div id='info'>
  <div>
    <div>
      <h1>設定網站選單</h1>
      <span>網站選單設置，最多新增八筆選單，次選單不限。</span>
    </div>
    <div>
      <a id='add' data-url=<?php echo base_url ('admin', 'menus', 'create_menu');?>>+ 新增主選單</a>
    </div>
  </div>
</div>

<form id='create_menu' method='post' action='' class='hide_form'>
  <input type='text' name='title' id='create_main_title' />
</form>
<form id='edit_main_menu' method='post' action='' class='hide_form'>
  <input type='text' name='title' id='edit_main_title' />
</form>
<form id='delete_main_menu' method='post' action='' class='hide_form'>
</form>
<form id='link_main_menu' method='post' action='' class='hide_form'>
  <input type='text' name='link' id='edit_main_link' />
</form>

<div class='table'>
<?php if ($_flash_danger = Session::getData ('_flash_danger', true)) { ?>
        <div id='msg'><?php echo $_flash_danger;?></div>
<?php } if ($_flash_info = Session::getData ('_flash_info', true)) { ?>
        <div id='msg_i'><?php echo $_flash_info;?></div>
<?php } ?>
  <div>
<?php
    if ($menus = Menu::all (array ('include' => array ('subs'), 'order' => 'id DESC', 'conditions' => array ('menu_id = 0')))) {
      foreach ($menus as $menu) { ?>
        <div class='tr'>
          <div class='title'>
            <span><?php echo $menu->title;?></span>
      <?php if ($menu->link) { ?>
              <div><b>Link：</b><?php echo $menu->link;?></div>
      <?php } ?>
            <a data-url='<?php echo base_url ('admin', 'menus', 'edit_menu', $menu->id);?>' class='edit_menu' data-val='<?php echo $menu->title;?>'>修改</a>
            <a data-url='<?php echo base_url ('admin', 'menus', 'delete_menu', $menu->id);?>' class='delete_menu'>刪除</a>
            <a data-url='<?php echo base_url ('admin', 'menus', 'create_menu', $menu->id);?>' class='create_sub'>+ 新增子選單</a>
            <a data-url='<?php echo base_url ('admin', 'menus', 'link_menu', $menu->id);?>' class='link_menu'>#</a>
          </div>
          <div class='items'>
      <?php if ($menu->subs) {
              foreach ($menu->subs as $sub) { ?>
                <div class='item'><span><?php echo $sub->title;?></span><span><a data-url='<?php echo base_url ('admin', 'menus', 'edit_menu', $sub->id);?>' class='edit_menu' data-val='<?php echo $sub->title;?>'>修改</a><a data-url='<?php echo base_url ('admin', 'menus', 'delete_menu', $sub->id);?>' class='delete_menu'>刪除</a></span></div>
        <?php }
            } ?>
          </div>
        </div>    
<?php }
    } else {
      echo "<p>沒有任何選單。</p>";
    }?>

  </div>
</div>