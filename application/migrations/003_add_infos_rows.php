<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Migration_Add_infos_rows extends CI_Migration {
  public function up () {
    $this->db->query (
      "INSERT INTO `infos` (`id`, `site_title`, `site_desc`, `title`, `tags`, `content`, `updated_at`, `created_at`) VALUES (NULL, '標題', '敘述', '標題', '標籤', '', '2017-03-05 17:40:13', '2017-03-05 17:40:13');"
    );
  }
  public function down () {
    $this->db->query (
      "truncate table `infos`;"
    );
  }
}