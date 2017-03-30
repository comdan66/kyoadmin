<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Infos extends Admin_controller {

  public function index () {
    $posts = OAInput::post ();
    if (!isset ($posts['column'], $posts['val']))return;
    if ($posts['column'] == 'content')
      $posts['val'] = $_POST['val'];
    $col = $posts['column'];
    Info::info ()->$col = $posts['val'];
    Info::info ()->save ();
    return $this->output_json ($posts['val']);
  }
  public function password () {
    $posts = OAInput::post ();
    if (!(isset ($posts['column'], $posts['val']) && $posts['column'] == 'password'))return;
    User::current ()->password = password ($posts['val']);
    User::current ()->save ();
    return $this->output_json ('********');
  }
}
