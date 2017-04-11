<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Logos extends Admin_controller {

  public function create () {
    $posts = OAInput::post ();
    $posts['is_cover'] = Logo::last () ? Logo::last ()->is_cover : Logo::COVER_NO;
    $posts['is_article'] = Logo::last () ? Logo::last ()->is_article : Logo::ACTIVE_NO;
    $name = OAInput::file ('name');
    
    if ($msg = $this->_validation_create ($name))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if (!Logo::transaction (function () use (&$obj, $posts, $name) { return verifyCreateOrm ($obj = Logo::create (array_intersect_key ($posts, Logo::table ()->columns))) && $obj->name->put ($name); }))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '設定失敗！', 'posts' => $posts));

    return redirect_message (array ('admin', 'articles'), array ('_flash_info' => '設定成功！'));
  }
  public function edit ($id = 0) {
    if (!($id && ($obj = Logo::find ('one', array ('conditions' => array ('id = ?', $id))))))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '找不到該筆資料。'));

    $posts = Session::getData ('posts', true);

    return $this->add_param ('_k', 'article')->load_view (array (
        'posts' => $posts,
        'obj' => $obj,
      ));
  }
  public function update ($id = 0) {
    if (!($id && ($obj = Logo::find ('one', array ('conditions' => array ('id = ?', $id))))))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '找不到該筆資料。'));


    if (!$this->has_post ())
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();

    if ($msg = $this->_validation_update ($posts))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if ($columns = array_intersect_key ($posts, $obj->table ()->columns))
      foreach ($columns as $column => $value)
        $obj->$column = $value;

    if (!Logo::transaction (function () use ($obj) { return $obj->save (); }))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '設定失敗！', 'posts' => $posts));

    return redirect_message (array ('admin', 'articles'), array ('_flash_info' => '設定成功！'));
  }
  private function _validation_create (&$name) {
    if (!isset ($name)) return '沒有選擇 浮水印檔案！';
    if (!is_upload_image_format ($name, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '浮水印檔案 格式錯誤！';

    return '';
  }
  private function _validation_update (&$posts) {
    if (!isset ($posts['is_cover'])) $posts['is_cover'] = Logo::COVER_NO;
    else $posts['is_cover'] = $posts['is_cover'] == 'on' ? Logo::COVER_YES : Logo::COVER_NO;
    if (!(is_numeric ($posts['is_cover'] = trim ($posts['is_cover'])) && in_array ($posts['is_cover'], array_keys (Logo::$coverNames)))) return '設定錯誤';
    
    if (!isset ($posts['is_article'])) $posts['is_article'] = Logo::ACTIVE_NO;
    else $posts['is_article'] = $posts['is_article'] == 'on' ? Logo::ACTIVE_YES : Logo::ACTIVE_NO;
    if (!(is_numeric ($posts['is_article'] = trim ($posts['is_article'])) && in_array ($posts['is_article'], array_keys (Logo::$activeNames)))) return '設定錯誤';
    
    return '';
  }

}
