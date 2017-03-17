<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Pvs extends Api_controller {

  public function index () {
    if (!$pv = Pv::find ('one', array ('conditions' => array ('day = ?', date ('Y-m-d'))))) Pv::create (array ('count' => 1, 'day' => date ('Y-m-d')));
    else ($pv->count = $pv->count + 1) && $pv->save ();

    return $this->output_json (array (
      'status' => true,
    ));
  }
}
