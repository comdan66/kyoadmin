<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Main extends Admin_controller {

  public function index () {
    $dpv = PV::find ('one', array ('select' => 'count', 'conditions' => array ('day = ?', date ('Y-m-d'))));
    $apv = PV::find ('one', array ('select' => 'SUM(count) as sum', 'conditions' => array ()));
    $this->add_param ('_k', 'main')->load_view (array (
        'dpv' => $dpv->count,
        'apv' => $apv->sum,
      ));
  }
}
