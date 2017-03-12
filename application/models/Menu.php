<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Menu extends OaModel {

  static $table_name = 'menus';

  static $has_one = array (
  );

  static $has_many = array (
    array ('subs', 'class_name' => 'Menu'),
    array ('articles', 'class_name' => 'Article')
  );

  static $belongs_to = array (
    array ('parent', 'class_name' => 'Menu')
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public function destroy () {
    if ($this->subs)
      foreach ($this->subs as $sub)
        if (!$sub->destroy ())
          return false;
    if ($this->articles)
      foreach ($this->articles as $article)
        if (!($article->menu_id = 0) && !$article->save ())
          return false;

    return $this->delete ();
  }
}