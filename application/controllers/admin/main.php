<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Main extends Admin_controller {

  public function prev () {
    $posts = OAInput::post ();
    
    $this->add_param ('_k', 'main')->set_frame_path ('frame', 'site')
         ->set_content_path ('content', 'admin')
         ->load_view (array (
      'posts' => $posts
      ));
  }
  public function index () {
    $this->add_param ('_k', 'main')->load_view (array (
        'dpv' => ($dpv = Pv::find ('one', array ('select' => 'count', 'conditions' => array ('day = ?', date ('Y-m-d'))))) ? $dpv->count : 0,
        'apv' => ($apv = Pv::find ('one', array ('select' => 'SUM(count) as sum', 'conditions' => array ()))) ? $apv->sum : 0,
      ));
  }
}
