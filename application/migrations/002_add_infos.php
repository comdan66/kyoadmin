<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Migration_Add_infos extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `infos` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `site_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '網站標題',
        `site_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '網站敘述',
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '密碼',
        `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '標籤',
        `content` text NOT NULL COMMENT '內容',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `infos`;"
    );
  }
}