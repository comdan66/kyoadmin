<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Main extends Site_controller {

  public function about () {
    return $this->load_view (array ());
  }
  public function index () {
    return $this->load_view (array (
        'banner' => Banner::last ()
      ));
  }
}
