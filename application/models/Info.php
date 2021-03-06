<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Info extends OaModel {

  static $table_name = 'infos';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );

  private static $info = null;

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }

  public static function info () {
    if (self::$info !== null) return self::$info;
    return self::$info = Info::find ('one', array ('conditions' => array ()));
  }
}