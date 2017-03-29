
<nav id='nav'>
  <div class='container'>
    <span>
      <a href="<?php echo base_url ('');?>">首頁</a>
      <a href="<?php echo base_url ('search', $article->menu->title);?>"><?php echo $article->menu->title;?></a>
    </span>
    <time><?php echo $article->created_at->format ('Y.m.d');?></time>
  </div>
</nav>

<h1 id='title'>
  <div class='container dftm9'><?php echo $article->title;?></div>
</h1>

<div id='article_cover'>
  <div class='container _i'>
    <img src='<?php echo $article->cover->url ();?>' />
  </div>
</div>

<div id='article'>
  <div class='container'>
    <?php echo $article->content;?>
  </div>
</div>

<?php 
  if ($article->tags ()) { ?>
    <div id='article_tags'>
      <div class='container'>  
  <?php foreach ($article->tags () as $tag) { ?>
          <a href='<?php echo $tag;?>'><?php echo $tag;?></a>
  <?php } ?>
      </div>
    </div>
<?php 
  } ?>

<div id='pages'>
  <div class='container'>
    <?php if ($prev) { ?><a href="<?php echo base_url ('article', $prev->id);?>" class='prev'>上一則</a><?php }?>
    <a href="<?php echo base_url ('');?>" class='home'>回首頁</a>
    <?php if ($next) { ?><a href="<?php echo base_url ('article', $next->id);?>" class='next'>下一則</a><?php }?>
  </div>
</div>