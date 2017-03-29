<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Search extends Site_controller {

  public function index ($keywords = '') {
    $keywords = OAInput::get ('keywords') ? OAInput::get ('keywords') : ($keywords ? $keywords : '');
echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
var_dump ();
exit ();
    if (!$keywords = trim ($keywords))
      return redirect_message (array (''), array ('_flash_info' => '找不到該關鍵字！'));

    $this->load_view (array (
        'keywords' => $keywords));
  }
}
