<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Articles extends Site_controller {

  public function index ($id) {
    if (!$article = Article::find ('one', array ('conditions' => array ('id = ? AND is_enabled = ?', $id, Article::ENABLE_YES))))
      return redirect_message (array (''), array ('_flash_info' => '找不到該篇文章！'));

    $prev = Article::find ('one', array ('select' => 'id', 'conditions' => array ('id < ? AND is_enabled = ?', $article->id, Article::ENABLE_YES)));
    $next = Article::find ('one', array ('select' => 'id', 'conditions' => array ('id > ? AND is_enabled = ?', $article->id, Article::ENABLE_YES)));

    $this->load_view (array (
        'article' => $article,
        'prev' => $prev,
        'next' => $next
      ));
  }
}
