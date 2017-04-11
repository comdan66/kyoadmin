<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Logo extends OaModel {

  static $table_name = 'logos';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );
  const COVER_NO  = 0;
  const COVER_YES = 1;

  static $coverNames = array(
    self::COVER_NO  => '停用',
    self::COVER_YES => '啟用',
  );
  const ACTIVE_NO  = 0;
  const ACTIVE_YES = 1;

  static $activeNames = array(
    self::ACTIVE_NO  => '停用',
    self::ACTIVE_YES => '啟用',
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);

    OrmImageUploader::bind ('name', 'LogoNameImageUploader');
  }
}