
<?php if ($_flash_danger = Session::getData ('_flash_danger', true)) { ?>
  <div id='msg'><div><?php echo $_flash_danger;?></div></div>
<?php }
if ($_flash_info = Session::getData ('_flash_info', true)) { ?>
  <div id='msg_i'><div><?php echo $_flash_info;?></div></div>
<?php }?>

<div id='info'>
  <div>
    <div>
      <h1>文章上稿管理</h1>
    </div>
    <div>
      <form id='fm'>

    <?php if ($menus = Menu::all (array ('include' => array ('subs'), 'conditions' => array ('menu_id = 0 AND link = ?', '')))) { ?>
            <select name='menu_id'>
              <option value="" <?php echo $columns[0]['value'] == '' ? ' selected': '';?>>依照分類搜尋</option>
        <?php foreach ($menus as $menu) {
                if ($menu->subs) { ?>
                  <optgroup label="<?php echo $menu->title;?>">
              <?php foreach ($menu->subs as $sub) { ?>
                      <option value="<?php echo $sub->id;?>" <?php echo $columns[0]['value'] == $sub->id ? ' selected': '';?>><?php echo $sub->title;?></option>
              <?php } ?>
                  </optgroup>
          <?php } else { ?>
                  <option value="<?php echo $menu->id;?>" <?php echo $columns[0]['value'] == $menu->id ? ' selected': '';?>><?php echo $menu->title;?></option>
          <?php }
              } ?>
            </select>
    <?php } ?>

        <button type='submit' class='icon-search'></button>
      </form>
    </div>
  </div>
</div>

<div class='info'>
  <div>
    <div>
      <h1>文章列表</h1>
    </div>
    <div>
      <a href="<?php echo base_url ('admin', 'articles', 'add');?>">+ 新增文章</a>
      
    </div>
  </div>
</div>

<form class='logo' action='<?php echo base_url ('admin/logos');?>' method='post' enctype='multipart/form-data'>
  <div>
    <div>
      <h2>浮水印設定</h2>
    </div>
    <div>
<?php if ($logo) { ?>
        <span class='img'><img src='<?php echo $logo->name->url ('120w');?>'></span>
<?php }?>
      <div>
        <input type='file' name='name'>
        
        <div>
          <span>封面</span>
          <label class='switch'>
            <input type='checkbox' name='is_cover' data-id='<?php echo $logo ? $logo->id : 0;?>'<?php echo ($logo ? $logo->is_cover : Logo::COVER_NO) == Logo::COVER_YES ? ' checked' : '';?> />
            <span></span>
          </label>
        </div>

        <div>
          <span>內文</span>
          <label class='switch'>
            <input type='checkbox' name='is_article' data-id='<?php echo $logo ? $logo->id : 0;?>'<?php echo ($logo ? $logo->is_article : Logo::ACTIVE_NO) == Logo::ACTIVE_YES ? ' checked' : '';?> />
            <span></span>
          </label>
        </div>

      </div>
      <button type='submit'>確定</button>
    </div>
  </div>
</form>

<div class='table'>
  <div>
<?php if ($objs) {
        foreach ($objs as $obj) { ?>
          <div class='tr'>
            <div>
              <time>2016/12/01 23:11:22</time>
              <h3><?php echo $obj->mini_title ();?></h3>
              <div>
                <a href="<?php echo base_url ('admin', 'articles', 'edit', $obj->id);?>">修改</a>
                <a href="<?php echo base_url ('admin', 'articles', $obj->id);?>" data-method='delete'>刪除</a>
                <a data-url='<?php echo base_url ('admin', 'articles', 'senable', $obj->id);?>' class='on <?php echo $obj->is_enabled == Article::ENABLE_YES ? ' a' : '';?>'><?php echo $obj->is_enabled == Article::ENABLE_YES ? '已發布' : '未發布';?></a>
              </div>
            </div>
            <div>
              <div><b>文章分類：</b><?php echo $obj->menu ? $obj->menu->title : '-';?></div>
              <div><b>內容：</b><span><?php echo $obj->mini_content ();?></span></div>
            </div>
          </div>
  <?php }
      } ?>
  </div>
</div>

<div class='pagination'><?php echo $pagination;?></div>