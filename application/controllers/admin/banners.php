<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Banners extends Admin_controller {

  public function submit () {
    $file = OAInput::file ('file');
    if (!$file) return redirect_message (array ('admin', 'banners'), array ('_flash_danger' => '沒選擇 Banner'));
    if (!verifyCreateOrm ($banner = Banner::create (array ('name' => ''))))
      return redirect_message (array ('admin', 'banners'), array ('_flash_danger' => '更新失敗！'));

    $banner->name->put ($file);
    return redirect_message (array ('admin', 'banners'), array ('_flash_info' => '更新成功！'));
  }
  public function index () {
    $this->add_param ('_k', 'banner')->load_view ();
  }
}
