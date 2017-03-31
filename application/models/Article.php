<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Article extends OaModel {

  static $table_name = 'articles';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
    array ('menu', 'class_name' => 'Menu')
  );
  const ENABLE_NO  = 0;
  const ENABLE_YES = 1;

  static $enableNames = array(
    self::ENABLE_NO  => '停用',
    self::ENABLE_YES => '啟用',
  );

  private static $tags = null;

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);

    OrmImageUploader::bind ('cover', 'ArticleCoverImageUploader');
  }
  public static function randTags ($l = 10) {
    if (!self::$tags)
      self::$tags = array_2d_to_1d (array_filter (array_map (function ($article) {
              return $article->tags ();
            }, Article::all (array ('select' => 'tags', 'order' => 'id DESC')))));
    
    return array_splice (self::$tags, 0, $l);
  }
  public function tags () {
    return isset($this->tags) && $this->tags ? preg_split ('/[\s,]+/', $this->tags) : array ();
  }
  public function destroy () {
    return $this->delete ();
  }
  public function mini_title ($length = 50) {
    if (!isset ($this->title)) return '';
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->title), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->content);
  }
  public function mini_content ($length = 100) {
    if (!isset ($this->content)) return '';
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->content), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->content);
  }
}