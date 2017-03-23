/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  $('#add').click (function () {
    var title = prompt ('請輸入主選單標題');
    if (!title) return false;
    $('#create_main_title').val (title);
    $('#create_menu').attr ('action', $(this).data ('url')).submit ();
  });
  $('.edit_menu').click (function () {
    var title = prompt ('請輸入標題', $(this).data ('val'));
    if (!title) return false;
    $('#edit_main_title').val (title);
    $('#edit_main_menu').attr ('action', $(this).data ('url')).submit ();
  });
  $('.delete_menu').click (function () {
    if (confirm ('確定刪除？'))
      $('#delete_main_menu').attr ('action', $(this).data ('url')).submit ();
  });
  $('.link_menu').click (function () {
    var link = prompt ('請輸入鏈結');
    $('#edit_main_link').val (link);
    $('#link_main_menu').attr ('action', $(this).data ('url')).submit ();
  });
  $('.create_sub').click (function () {
    var title = prompt ('請輸入標題');
    if (!title) return false;
    $('#create_main_title').val (title);
    $('#create_menu').attr ('action', $(this).data ('url')).submit ();
  });

  $('.tr').each (function () {
    var $t = $(this).find ('.title');
    var $s = $(this).find ('.items');
    if ($t.height () < $s.height ())
      $t.height ($s.height ());
    else
      $t.height ($t.height () + 30);
  });

});