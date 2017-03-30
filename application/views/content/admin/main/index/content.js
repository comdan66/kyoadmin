/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  $('.c').click (function () {
    $(this).parent ().parent ().removeClass ('e');
  });
  $('.s').submit (function () {
    var $input = $(this).find ('input');
    if ($input.val ().length <= 0) return false;

    $(this).parent ().removeClass ('e').find ('>span').text ($(this).data ('column') == 'password' ? '*********' : $input.val ());
  

    $.ajax ({ url: $(this).data ('api'), async: true, cache: false, dataType: 'json', type: 'post', data: {
      column: $(this).data ('column'),
      val: $input.val ()
    } }).done (function (r) {
    }.bind ($(this)))
    .complete (function (r) {
    });
    return false;
  });
  $('.x').click (function () {
    $(this).parent ().addClass ('e');
  });
  $('.article form').submit (function () {
    var $p = $('<p />').text ('儲存成功');
    $('.article form').prepend ($p);

    $.ajax ({ url: $(this).data ('api'), async: true, cache: false, dataType: 'json', type: 'post', data: {
      column: $(this).data ('column'),
      val: $('.article textarea').val ()
    } }).done (function (r) {
    }.bind ($(this)))
    .complete (function (r) {
    });

    setTimeout (function () {
      $p.fadeOut (function () {
        $p.remove ();
      });
    }, 500);
    return false;
  });
  $('.article textarea').ckeditor ({
    filebrowserUploadUrl: window.vars.apis.ckeditor.postImage (),
    filebrowserImageBrowseUrl: window.vars.apis.ckeditor.getImages (),
    skin: 'oa',
    height: 300,
    resize_enabled: false,
    removePlugins: 'elementspath',
    toolbarGroups: [{ name: '1', groups: [ 'mode', 'tools', 'links', 'basicstyles', 'colors', 'insert', 'list', 'align' ] }],
    removeButtons: 'Strike,Underline,Italic,Table,HorizontalRule,Smiley,Subscript,Superscript,Forms,Save,NewPage,Print,Preview,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Form,RemoveFormat,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,PageBreak,Iframe,About,Styles'
  });

  $('#prev').click (function () {
    var xxx1 = $('#xxx').val ();
    var xxx2 = $('.article textarea').val ();
    $('#xxx1').val (xxx1);
    $('#xxx2').val (xxx2);
    $('#www').submit ();
    // $(this).parents ('form').attr ('action', '/admin/main/prev').attr ('target', '_blank').submit ();
    // $('<form />').attr ('action', '/admin/main/prev').attr ('target', '_self').append ('body').submit ();

    // $.ajax ({ url: $(this).data ('api'), async: true, cache: false, dataType: 'json', type: 'post', data: {
    //   column: $(this).data ('column'),
    //   val: $('.article textarea').val ()
    // } }).done (function (r) {
    //   window.open ('/admin/main/prev');
      
    //   // $('#form').attr ('action', $('#form').data ('action2')).attr ('target', '_blank').submit ();
    // }.bind ($(this)))
    // .complete (function (r) {
    // });

  });
});