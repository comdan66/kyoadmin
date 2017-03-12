<form id='form' action='<?php echo base_url ('admin', 'articles');?>' method='post' enctype='multipart/form-data'>
  <div id='info'>
    <div>
      <div>
        <h1>新增文章</h1>
      </div>
      <div class='btns'>
        <input type='checkbox' name='is_enabled' id='is_enabled' value='<?php echo isset ($posts['is_enabled']) ? $posts['is_enabled'] : Article::ENABLE_NO;?>' <?php echo (isset ($posts['is_enabled']) ? $posts['is_enabled'] : Article::ENABLE_NO) == Article::ENABLE_YES ? ' checked' : '';?> />
        <a href='<?php echo base_url ('admin', 'articles');?>'>離開</a>
        <a>預覽</a>
        <button type='submit' class='su'>儲存</button>
        <label class='su' for='is_enabled'>發佈</label>
      </div>
    </div>
  </div>


  <div class='table'>
    <div>
      <?php if ($_flash_danger = Session::getData ('_flash_danger', true)) { ?>
        <div id='msg'><?php echo $_flash_danger;?></div>
<?php }
      if ($_flash_info = Session::getData ('_flash_info', true)) { ?>
        <div id='msg_i'><?php echo $_flash_info;?></div>
<?php }?>
      <div class='tr'>
        <div class='gs'>
    <?php if ($menus = Menu::all (array ('include' => array ('subs'), 'conditions' => array ('menu_id = 0 AND link = ?', '')))) { ?>
            <div class='g'>
              <span>文章分類</span>
              <select name='menu_id'>
          <?php foreach ($menus as $menu) {
                  if ($menu->subs) { ?>
                    <optgroup label="<?php echo $menu->title;?>">
                <?php foreach ($menu->subs as $sub) { ?>
                        <option value="<?php echo $sub->id;?>" <?php echo (isset ($posts['menu_id']) ? $posts['menu_id'] : 0) == $sub->id ? ' selected': '';?>><?php echo $sub->title;?></option>
                <?php } ?>
                    </optgroup>
            <?php } else { ?>
                    <option value="<?php echo $menu->id;?>" <?php echo (isset ($posts['menu_id']) ? $posts['menu_id'] : 0) == $menu->id ? ' selected': '';?>><?php echo $menu->title;?></option>
            <?php }
                } ?>
              </select>
            </div>
    <?php } ?>


          <div class='g'>
            <span>文章標籤</span>
            <textarea name='tags' placeholder='標籤可以逗號 , 分開或者空白鍵分開！'><?php echo isset ($posts['tags']) ? $posts['tags'] : '' ?></textarea>
          </div>
        </div>

        <div>
          <div class='banner'>
            <span>文章封面</span>
            <!-- <img src='' /> -->
            <input type='file' id='cover' name='cover' />
            <!-- <div><label for='cover'>選擇封面</label></div> -->
          </div>
          <div class='line'></div>
          <div class='title'>
            <span>文章標題</span>
            <input type='text' name='title' value='<?php echo isset ($posts['title']) ? $posts['title'] : '';?>' placeholder='請輸入文章標題..' maxlength='200' pattern='.{1,200}' required title='輸入文章標題!' autofocus />
          </div>
          <div class='line'></div>
          <div class='content'>
            <span>文章內容</span>
            <textarea id='content' name='content'><?php echo isset ($posts['content']) ? $posts['content'] : '' ?></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>