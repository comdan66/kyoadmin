
  <articles class='article'>
    <figure>
      <a href='<?php echo base_url ('article', $article->id);?>' class='_i'>
        <img src='<?php echo $article->cover->url ();?>' />
      </a>
    </figure>
    <div>
      <time><?php echo $article->created_at->format ('Y.m.d');?></time>
      <header><a href='<?php echo base_url ('article', $article->id);?>' class='dftm9'><?php echo $article->title;?></a></header>
      <p><?php echo $article->mini_content ();?><a href="<?php echo base_url ('article', $article->id);?>">閱讀更多</a></p>
    </div>
    <div>
<?php foreach ($article->tags () as $tag) { ?>
        <a href='<?php echo base_url ('search', $tag);?>'><?php echo $tag;?></a>
<?php } ?>
    </div>
  </articles>