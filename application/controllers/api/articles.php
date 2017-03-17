<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Articles extends Api_controller {

  private function _picture_format ($article) {
    return $this->load_content (array (
        'article' => $article
      ), true);
  }
  public function index () {
    $next_id = OAInput::get ('next_id');
    $limit = ($limit = OAInput::get ('limit')) ? $limit : 5;

    $conditions = $next_id ? array ('id <= ? AND is_enabled = ?', $next_id, Article::ENABLE_YES) : array ('is_enabled = ?', Article::ENABLE_YES);
    $articles = Article::find ('all', array ('order' => 'id DESC', 'limit' => $limit + 1, 'conditions' => $conditions));

    $next_id = ($temp = (count ($articles) > $limit ? end ($articles) : null)) ? $temp->id : -1;

    $that = $this;
    return $this->output_json (array (
      'status' => true,
      'articles' => array_map (array ($this, '_picture_format'), array_slice ($articles, 0, $limit)),
      'next_id' => $next_id
    ));
  }
}
