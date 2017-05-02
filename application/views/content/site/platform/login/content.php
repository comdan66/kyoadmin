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
      <button type='submit'>Login</button>
      <span>有任何問題歡迎<a href='mailto:<?php echo Cfg::setting ('main', 'mail');?>?subject=關於 弓道場 的問題&body=Hi ,%0D%0A%0D%0A 以下是我的一些相關問題..'>來信</a>告知 / If there has any question, please <a href='mailto:<?php echo Cfg::setting ('main', 'mail');?>'>e-mail</a> right away.</span>
    </div>
  </form>

</div>
