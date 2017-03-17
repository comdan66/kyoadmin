
<nav id='nav'>
  <div class='container'>
    <span>
      <a href="<?php echo base_url ('');?>">首頁</a>
      <?php if ($posts['menu']) { ?><a href="<?php echo base_url ('search', $posts['menu']->title);?>"><?php echo $posts['menu']->title;?></a> <?php } ?>
    </span>
    <time><?php echo date ('Y.m.d');?></time>
  </div>
</nav>

<h1 id='title'>
  <div class='container dftm9'><?php echo $posts['title'];?></div>
</h1>

<?php if ($pic) { ?>
  <div id='article_cover'>
    <div class='container _i'>
      <img src='<?php echo $pic;?>' />
    </div>
  </div>
<?php } ?>

<div id='article'>
  <div class='container'>
    <?php echo $posts['content'];?>
  </div>
</div>

<?php 
  if ($posts['tags']) { ?>
    <div id='article_tags'>
      <div class='container'>  
  <?php foreach ($posts['tags'] as $tag) { ?>
          <a href='<?php echo $tag;?>'><?php echo $tag;?></a>
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