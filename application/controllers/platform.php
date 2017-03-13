<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Platform extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }
  public function login () {
    if (User::current ()) return redirect_message (array ('admin'), array ());
    else $this->set_frame_path ('frame', 'pure')->load_view ();
  }
  public function ap_sign_in () {
    $posts = OAInput::post ();

    if (!(isset ($posts['account']) && isset ($posts['password']) && $posts['account'] && $posts['password']))
      return redirect_message (array ('login'), array ('_flash_danger' => '登入錯誤，請通知程式設計人員!'));

    if (!$user = User::find ('one', array ('conditions' => array ('account = ? AND password = ?', $posts['account'], password ($posts['password'])))))
      return redirect_message (array ('login'), array ('_flash_danger' => '登入錯誤，沒有此帳號或密碼錯誤！'));

    $user->login_count += 1;
    $user->logined_at = date ('Y-m-d H:i:s');

    if (!User::transaction (function () use ($user) { return $user->save (); }))
      return redirect_message (array ('login'), array ('_flash_danger' => '登入錯誤，請通知程式設計人員!(2)'));
    
    Session::setData ('user_id', $user->id);

    return redirect_message (array ('admin'), array ('_flash_info' => '登入成功!'));
  }
  public function logout () {
    Session::setData ('user_id', 0);
    return redirect_message ('login', array ('_flash_info' => '登出成功!'));
  }
}
