<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Search extends Site_controller {

  public function index ($k = '') {
    // if (!($keywords && ($keywords = array_values (array_filter (array_map (function ($keyword) { return trim ($keyword); }, preg_split ('/[\s,]+/', $keywords)))))))
    //   return redirect_message (array (''), array ('_flash_info' => '找不到該關鍵字！'));

    $keywords = OAInput::get ('keywords') ? OAInput::get ('keywords') : $k;

    if (!$keywords = trim ($keywords))
      return redirect_message (array (''), array ('_flash_info' => '找不到該關鍵字！'));

    $this->load_view (array (
        'keywords' => $keywords));
  }
}
