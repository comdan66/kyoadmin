<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Search extends Api_controller {

  private function _picture_format ($article) {
    return $this->load_content (array (
        'article' => $article
      ), true);
  }
  public function index () {
    if (!$keywords = OAInput::get ('keywords'))
      return $this->output_json (array (
        'status' => false));

    // $tag_ids = array_unique (array_2d_to_1d (array_map (function ($keyword) {
    //   $tag_ids = column_array (Tag::find ('all', array ('select' => 'id', 'conditions' => array ('name LIKE ?', '%' . $keyword . '%'))), 'id');
    //   return $tag_ids;
    // }, $keywords)));
    
    $menu_ids = column_array (Menu::find ('all', array ('select' => 'id', 'conditions' => array ('title LIKE ?', '%' . $keywords . '%'))), 'id');
    // $article_ids = array_unique (column_array (Mapping::find ('all', array ('select' => 'article_id', 'conditions' => array ('tag_id IN (?)', $tag_ids ? $tag_ids : array (0)))), 'article_id'));

    $next_id = OAInput::get ('next_id');
    $limit = ($limit = OAInput::get ('limit')) ? $limit : 5;

    $conditions = $next_id ? array ('id <= ? AND is_enabled = ? AND (title LIKE ? OR tags LIKE ? OR menu_id IN (?))', $next_id, Article::ENABLE_YES, '%' . $keywords . '%', '%' . $keywords . '%', $menu_ids ? $menu_ids : array (0)) : array ('is_enabled = ? AND (title LIKE ? OR tags LIKE ?)', Article::ENABLE_YES, '%' . $keywords . '%', '%' . $keywords . '%', $menu_ids ? $menu_ids : array (0));
    
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
