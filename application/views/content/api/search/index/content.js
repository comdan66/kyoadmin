/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  var scroll_timer = null;
  var $articles = $('#articles .container');
  
  function loadArticlesFromServer () {
      
console.error ('x');
    if ($articles.data ('next_id') <= -1) return;

    $.ajax ({
      url: $articles.data ('url'),
      data: { next_id: $articles.data ('next_id') },
      async: true, cache: false, dataType: 'json', type: 'get',
      beforeSend: function () { }
    })
    .done (function (result) {
      // if (result.status) {
      //   result.articles.map (function (t) {
      //     setPictureFeature ($(t).appendTo ($articles).hide ());
      //   });
      //   $articles.data ('next_id', result.next_id);

      //   if (result.next_id < 0) $articles.find ('~ .loading').remove ();
      //   else $(window).scroll ();
      // }
      console.error (result);
      
    }.bind (this))
    .fail (function (result) {
      
  console.error (result.responseText);
    })
    .complete (function (result) { });
  }
  $(window).scroll (function () {

    clearTimeout (scroll_timer);
    if ($(window).height () + $(window).scrollTop () > $articles.height () + $articles.offset ().top - 50) {
      scroll_timer = setTimeout (loadArticlesFromServer, 500);
    }
  }.bind (this)).scroll ();
});