<div class='login' id='login'>
  <img src='/resource/image/logo.png'>
<?php 
  if ($_flash_danger = Session::getData ('_flash_danger', true)) { ?>
    <div class='e'><?php echo $_flash_danger;?></div>
<?php 
  } else { ?>
<?php 
  }?>
  <form action='<?php echo base_url ('platform', 'ap_sign_in');?>' method='post' autocomplete='off'>
    <div class='row'>
      <label class='admin-user'></label><input type='text' name='account' placeholder='YOUR ACCOUNNT' autocomplete="off" />
    </div>
    <div class='row'>
      <label class='admin-lock'></label><input type='password' name='password' placeholder='YOUR PASSWORD' autocomplete="off" />
    </div>
    <div class='bottom'>
      <span>有任何問題歡迎<a href='' target='_blank'>來信</a>告知。</span>
      <button type='submit'>Login</button>
    </div>
  </form>

</div>