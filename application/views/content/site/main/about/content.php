
<nav id='nav'>
  <div class='container'>
    <span>
      <a href="<?php echo base_url ('');?>">首頁</a>
      <a href="<?php echo base_url ('about');?>">關於 Kyo 桑</a>
    </span>
  </div>
</nav>

<h1 id='title'>
  <div class='container dftm9'>關於 Kyo 桑</div>
</h1>

<div id='article'>
  <div class='container'>
    <?php echo Info::info ()->content;?>
  </div>
</div>

<?php 
  if ($tags = preg_split ('/[\s,]+/', Info::info ()->tags)) { ?>
    <div id='article_tags'>
      <div class='container'>  
  <?php foreach ($tags as $tag) { ?>
          <a href='<?php echo base_url ('search', $tag);?>'><?php echo $tag;?></a>
  <?php } ?>
      </div>
    </div>
<?php 
  } ?>

<div id='pages'>
  <div class='container'>
    <a href="<?php echo base_url ('');?>" class='home'>回首頁</a>
  </div>
</div>