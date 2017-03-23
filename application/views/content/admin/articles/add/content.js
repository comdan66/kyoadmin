/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  $('#content').ckeditor ({
    filebrowserUploadUrl: window.vars.apis.ckeditor.postImage (),
    filebrowserImageBrowseUrl: window.vars.apis.ckeditor.getImages (),
    skin: 'oa',
    height: 300,
    resize_enabled: false,
    removePlugins: 'elementspath',
    toolbarGroups: [{ name: '1', groups: [ 'mode', 'tools', 'links', 'basicstyles', 'colors', 'insert', 'list' ] }],
    removeButtons: 'Strike,Underline,Italic,Table,HorizontalRule,Smiley,Subscript,Superscript,Forms,Save,NewPage,Print,Preview,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Form,RemoveFormat,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,PageBreak,Iframe,About,Styles'
  });

  $('#form').submit (function () {
    $('#is_enabled').val ($('#is_enabled').prop ('checked') ? 1 : 0);
  });
  $("button[type='submit']").click (function () {
    $('#form').attr ('action', $('#form').data ('action1')).attr ('target', '_self').submit ();
  });

  $('#prev').click (function () {
    $('#form').attr ('action', $('#form').data ('action2')).attr ('target', '_blank').submit ();
  });

  function adt (v) {
    $('<div />').addClass ('row').append (
      $("<input type='text' name='tags[]' placeholder='標籤' value='" + v + "' />")).append (
      $("<button type='button'>-</button>").click (function () {
        $(this).parent ().remove ();
      })).insertBefore ($('#add_tag'));
  }
  $('#add_tag').click (function () {
    adt ('');
  }).data ('val').map (adt);
  
});