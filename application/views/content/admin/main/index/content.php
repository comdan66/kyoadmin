<div id='info'>
  <div>
    <div>
      <h1><?php echo User::current ()->name;?>, 歡迎回來</h1>
      <span class='xs'><b>本日人氣：</b><?php echo $dpv;?> | <b>累積人氣：</b><?php echo $apv;?></span>
    </div>
    <div>
      <span class='icon-login'> <?php echo User::current ()->logined_at->format ('Y-m-d H:i:s');?></span>
      <!-- <a href="">+ 新增文章</a> -->
    </div>
  </div>
</div>

<div class='table'>
  <div>
    <div class='tr n1'>
      <div>帳號密碼</div>
      <div>
        <div><b>帳號：</b><?php echo User::current ()->name;?></div>

        <div><b>密碼：</b>
          <span>**********</span><a class='x'>修改</a>
          <form class='s' data-column='password' data-api='<?php echo base_url ('api/infos/password/');?>'>
            <input type='password' value='' />
            <button type='submit'>確定</button><a class='c'>取消</a>
          </form>
        </div>

      </div>
    </div>

    <div class='tr n1'>
      <div>基本標語</div>
      <div>
        <div><b>標題：</b>
          <span><?php echo Info::info ()->site_title;?></span><a class='x'>修改</a>
          <form class='s' data-column='site_title' data-api='<?php echo base_url ('api/infos/');?>'>
            <input value='<?php echo Info::info ()->site_title;?>' />
            <button type='submit'>確定</button><a class='c'>取消</a>
          </form>
        </div>
        <div><b>詳細介紹：</b>
          <span><?php echo Info::info ()->site_desc;?></span><a class='x'>修改</a>
          <form class='s' data-column='site_desc' data-api='<?php echo base_url ('api/infos/');?>'>
            <input value='<?php echo Info::info ()->site_desc;?>' />
            <button type='submit'>確定</button><a class='c'>取消</a>
          </form>
        </div>
      </div>
    </div>
    
    <div class='tr n2'>
      <div>關於 Kyo 桑</div>
      <div>
        <div><b>文章標題：</b>
          <span><?php echo Info::info ()->title;?></span><a class='x'>修改</a>
          <form class='s' data-column='title' data-api='<?php echo base_url ('api/infos/');?>'>
            <input value='<?php echo Info::info ()->title;?>' />
            <button type='submit'>確定</button><a class='c'>取消</a>
          </form>
        </div>
        <div><b>文章標籤：</b>
          <span><?php echo Info::info ()->tags;?></span><a class='x'>修改</a>
          <form class='s' data-column='tags' data-api='<?php echo base_url ('api/infos/');?>'>
            <input id='xxx' value='<?php echo Info::info ()->tags;?>' placeholder='標籤可以逗號分開或空白鍵分開' />
            <button type='submit'>確定</button><a class='c'>取消</a>
          </form>
        </div>
        <div><b>文章內容：</b>
          <br>
          <div class='article'>
            <form data-column='content' data-api='<?php echo base_url ('api/infos/');?>'>
              <textarea><?php echo Info::info ()->content;?></textarea>
              <div><button type='submit'>確定</button><a id='prev' data-column='content' data-api='<?php echo base_url ('api/infos/');?>'>預覽</a></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<form id='www' action='/admin/main/prev' method='post' target='_blank'>
  <input type='text' name='tags' id='xxx1'>
  <textarea name='content' id='xxx2'></textarea>
</form>