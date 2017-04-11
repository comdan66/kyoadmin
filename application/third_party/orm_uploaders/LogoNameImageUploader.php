<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class LogoNameImageUploader extends OrmImageUploader {

  public function getVersions () {
    return array (
        '' => array (),
        '120w' => array ('resize', 120, 120, 'width'),
      );
  }
}