<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */
class Menus extends Admin_controller {

  public function link_menu ($id) {
    if (!$menu = Menu::find_by_id ($id))
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '找不到該筆選單'));

    $link = OAInput::post ('link');

    if (!$link = trim ($link))
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '鏈結錯誤'));

    $menu->link = $link;
    
    if (!$menu->save ())
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '更新失敗！'));

    return redirect_message (array ('admin', 'menus'), array ('_flash_info' => '更新成功！'));
  }
  public function delete_menu ($id) {
    if (!$menu = Menu::find_by_id ($id))
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '找不到該筆選單'));
    if ($menu->destroy ())
      return redirect_message (array ('admin', 'menus'), array ('_flash_info' => '刪除成功！'));
  }
  public function edit_menu ($id) {
    if (!$menu = Menu::find_by_id ($id))
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '找不到該筆選單'));

    $title = OAInput::post ('title');

    if (!$title = trim ($title))
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '標題錯誤'));

    $menu->title = $title;
    
    if (!$menu->save ())
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '更新失敗！'));

    return redirect_message (array ('admin', 'menus'), array ('_flash_info' => '更新成功！'));
  }
  public function create_menu ($id = 0) {
    $menu = Menu::find_by_id ($id);
    
    $title = OAInput::post ('title');

    if (!$title = trim ($title))
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '標題錯誤'));

    if (!verifyCreateOrm ($menu = Menu::create (array (
        'title' => $title,
        'link' => '',
        'menu_id' => $menu ? $menu->id : 0,
      ))))
      return redirect_message (array ('admin', 'menus'), array ('_flash_danger' => '新增失敗！'));

    return redirect_message (array ('admin', 'menus'), array ('_flash_info' => '新增成功！'));
  }
  public function index () {
    $this->add_param ('_k', 'menu')->load_view ();
  }
}
