/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  window.vars = {
    apis: {
      ckeditor: {
        apis: {
          images: {
            upload: '/admin/ckeditor/image_upload/',
            browser: '/admin/ckeditor/image_browser/',
          }
        },
        postImage: function () { return this.apis.images.upload ; },
        getImages: function () { return this.apis.images.browser ; },
      }
    }
  };
});