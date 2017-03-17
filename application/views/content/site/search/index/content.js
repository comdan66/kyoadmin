/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  var scroll_timer = null;
  var $articles = $('#articles .container');
  
  function setPictureFeature ($obj) {
    $obj.find ('._i').imgLiquid ({verticalAlign: 'center'});
    return $obj.fadeIn ();
  }
  function loadArticlesFromServer () {
      
    if ($articles.data ('next_id') <= -1) return;

    $.ajax ({
      url: $articles.data ('url'),
      data: { next_id: $articles.data ('next_id'), keywords: $articles.data ('keywords') },
      async: true, cache: false, dataType: 'json', type: 'get',
      beforeSend: function () { }
    })
    .done (function (result) {
      if (!result.status)
        return;

      result.articles.map (function (t) {
        setPictureFeature ($(t).appendTo ($articles).hide ());
      });
      $articles.data ('next_id', result.next_id);

      if (result.next_id < 0) $articles.find ('~ .loading').remove ();
      else $(window).scroll ();
      
    }.bind (this))
    .fail (function (result) { })
    .complete (function (result) { });
  }
  loadArticlesFromServer ();
  $(window).scroll (function () {

    clearTimeout (scroll_timer);
    if ($(window).height () + $(window).scrollTop () > $articles.height () + $articles.offset ().top - 50) {
      scroll_timer = setTimeout (loadArticlesFromServer, 500);
    }
  }.bind (this)).scroll ();
});