<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Migration_Add_logos extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `logos` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '檔案名稱',
        `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'tl' COMMENT '位置',

        `is_cover` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '封面',
        `is_article` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '內文',

        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `logos`;"
    );
  }
}