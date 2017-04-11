<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Articles extends Admin_controller {

  public function submit () {
    
  }

  public function index ($offset = 0) {
    $columns = array ( 
        array ('key' => 'menu_id', 'title' => '分類', 'sql' => 'menu_id = ?', 'select' => array_map (function ($menu) { return array ('value' => $menu->id, 'text' => $menu->title, 'group' => $menu->parent ? $menu->parent->title : '');}, Menu::find ('all', array ('select' => 'id, title', 'order' => 'id DESC', 'conditions' => array ('link = ? AND menu_id != ?', '', 0))))),
      );

    $configs = array_merge (explode ('/', 'admin/articles'), array ('%s'));
    $conditions = conditions ($columns, $configs);

    $limit = 10;
    $total = Article::count (array ('conditions' => $conditions));
    $objs = Article::find ('all', array ('offset' => $offset < $total ? $offset : 0, 'limit' => $limit, 'order' => 'id DESC', 'include' => array ('menu'), 'conditions' => $conditions));

    return $this->add_param ('_k', 'article')->load_view (array (
        'objs' => $objs,
        'logo' => Logo::last (),
        'columns' => $columns,
        'pagination' => $this->_get_pagination ($limit, $total, $configs),
      ));
  }
  public function add () {
    $posts = Session::getData ('posts', true);

    $this->add_param ('_k', 'article')->load_view (array ('posts' => $posts,));
  }
  public function prev_add ($id = 0) {
    if ($id) $obj = Article::find ('one', array ('conditions' => array ('id = ?', $id)));
  
    if (!$this->has_post ())
      return redirect_message (array ('admin', 'articles', 'add'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', false);
    $posts['tags'] = $posts['tags'];
    $posts['menu'] = Menu::find_by_id ($posts['menu_id']);
    
    $cover = OAInput::file ('cover');
    if ($cover && is_upload_image_format ($cover, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) {
      $pic = TmpPic::create (array (
        'name' => ''
      ));
      $pic->name->put ($cover);
      $pic = $pic->name->url ();
    } else if ($obj) {
      $pic = $obj->cover->url ();
    } else {
      $pic = null;
    }
    
    $this->set_frame_path ('frame', 'site')
         ->set_content_path ('content', 'admin')
         ->load_view (array ('posts' => $posts, 'pic' => $pic));
  }
  public function create () {
    if (!$this->has_post ())
      return redirect_message (array ('admin', 'articles', 'add'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', false);
    $cover = OAInput::file ('cover');
    
    if ($msg = $this->_validation_create ($posts, $cover))
      return redirect_message (array ('admin', 'articles', 'add'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if (!Article::transaction (function () use (&$obj, $posts, $cover) { return verifyCreateOrm ($obj = Article::create (array_intersect_key (array_merge ($posts, array ('tags' => implode(',', $posts['tags']))), Article::table ()->columns))) && $obj->cover->put ($cover); }))
      return redirect_message (array ('admin', 'articles', 'add'), array ('_flash_danger' => '新增失敗！', 'posts' => $posts));

    return redirect_message (array ('admin', 'articles'), array ('_flash_info' => '新增成功！'));
  }
  public function edit ($id = 0) {
    if (!($id && ($obj = Article::find ('one', array ('conditions' => array ('id = ?', $id))))))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '找不到該筆資料。'));

    $posts = Session::getData ('posts', true);

    return $this->add_param ('_k', 'article')->load_view (array (
        'posts' => $posts,
        'obj' => $obj,
      ));
  }
  public function update ($id = 0) {
    if (!($id && ($obj = Article::find ('one', array ('conditions' => array ('id = ?', $id))))))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '找不到該筆資料。'));

    if (!$this->has_post ())
      return redirect_message (array ('admin', 'articles', $obj->id, 'edit'), array ('_flash_danger' => '非 POST 方法，錯誤的頁面請求。'));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', false);
    $cover = OAInput::file ('cover');

    if ($msg = $this->_validation_update ($posts, $cover, $obj))
      return redirect_message (array ('admin', 'articles', $obj->id, 'edit'), array ('_flash_danger' => $msg, 'posts' => $posts));

    if ($columns = array_intersect_key (array_merge($posts, array ('tags' => implode(',', $posts['tags']))), $obj->table ()->columns))
      foreach ($columns as $column => $value)
        $obj->$column = $value;

    if (!Article::transaction (function () use ($obj, $posts, $cover) { if (!$obj->save () || ($cover && !$obj->cover->put ($cover))) return false; return true; }))
      return redirect_message (array ('admin', 'articles', $obj->id, 'edit'), array ('_flash_danger' => '更新失敗！', 'posts' => $posts));

    return redirect_message (array ('admin', 'articles'), array ('_flash_info' => '更新成功！'));
  }
  public function destroy ($id = 0) {
    if (!($id && ($obj = Article::find ('one', array ('conditions' => array ('id = ?', $id))))))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '找不到該筆資料。'));

    if (!Article::transaction (function () use ($obj) { return $obj->destroy (); }))
      return redirect_message (array ('admin', 'articles'), array ('_flash_danger' => '刪除失敗！'));

    return redirect_message (array ('admin', 'articles'), array ('_flash_info' => '刪除成功！'));
  }
  public function senable ($id = 0) {
    if (!($id && ($obj = Article::find ('one', array ('conditions' => array ('id = ?', $id))))))
      return $this->output_error_json ('更新失敗！');
    $obj->is_enabled = $obj->is_enabled == Article::ENABLE_YES ? Article::ENABLE_NO : Article::ENABLE_YES;
    if (!$obj->save ())
      return $this->output_error_json ('更新失敗！');

    return $this->output_json ($obj->is_enabled == Article::ENABLE_YES);
  }

  private function _validation_create (&$posts, &$cover) {
    if (!isset ($posts['is_enabled'])) $posts['is_enabled'] = 0;
    if (!isset ($posts['title'])) return '沒有填寫 文章標題！';
    if (!isset ($posts['content'])) return '沒有填寫 文章內容！';
    if (!isset ($cover)) return '沒有選擇 文章封面！';
    
    if (!(is_numeric ($posts['is_enabled'] = trim ($posts['is_enabled'])) && in_array ($posts['is_enabled'], array_keys (Article::$enableNames)))) $posts['is_enabled'] = 0;
    if (!(is_string ($posts['title']) && ($posts['title'] = trim ($posts['title'])))) return '文章標題 格式錯誤！';
    if (!is_upload_image_format ($cover, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '文章封面 格式錯誤！';
    if (!(is_string ($posts['content']) && ($posts['content'] = trim ($posts['content'])))) return '文章內容 格式錯誤！';
    $posts['tags'] = isset($posts['tags']) && is_array($posts['tags']) && $posts['tags'] ? array_filter(array_map(function ($t) {
      return trim (str_replace ('#', '', $t));
    }, $posts['tags'])) : array ();
    return '';
  }
  private function _validation_update (&$posts, &$cover, $obj) {
    if (!isset ($posts['is_enabled'])) $posts['is_enabled'] = 0;
    if (!isset ($posts['title'])) return '沒有填寫 文章標題！';
    if (!isset ($posts['content'])) return '沒有填寫 文章內容！';
    if (!((string)$obj->cover || isset ($cover))) return '沒有選擇 文章封面！';

    if (!(is_numeric ($posts['is_enabled'] = trim ($posts['is_enabled'])) && in_array ($posts['is_enabled'], array_keys (Article::$enableNames)))) $posts['is_enabled'] = 0;
    if (!(is_string ($posts['title']) && ($posts['title'] = trim ($posts['title'])))) return '文章標題 格式錯誤！';
    if ($cover && !is_upload_image_format ($cover, 20 * 1024 * 1024, array ('gif', 'jpeg', 'jpg', 'png'))) return '文章封面 格式錯誤！';
    if (!(is_string ($posts['content']) && ($posts['content'] = trim ($posts['content'])))) return '文章內容 格式錯誤！';
    $posts['tags'] = isset($posts['tags']) && is_array($posts['tags']) && $posts['tags'] ? array_filter(array_map(function ($t) {
      return trim (str_replace ('#', '', $t));
    }, $posts['tags'])) : array ();
    
    return '';
  }

}
