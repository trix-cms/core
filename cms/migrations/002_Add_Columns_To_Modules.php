<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Columns_To_Modules extends CI_Migration {

	public function up()
	{
		// upgrade
        $this->db->query("ALTER TABLE ". $this->db->dbprefix('modules') ." CHANGE  `slug`  `class` VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
        
        $this->db->query("ALTER TABLE ". $this->db->dbprefix('modules') ."  ADD `created_on` INT UNSIGNED NOT NULL,  ADD `update_on` INT UNSIGNED NOT NULL, ADD `url` VARCHAR(25) NOT NULL AFTER `class`");
	}

	public function down()
	{
		// donwgrade
        $this->db->query("ALTER TABLE ". $this->db->dbprefix('modules') ." CHANGE  `class`  `slug` VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
        
        $this->db->query("ALTER TABLE ". $this->db->dbprefix('modules') ." DROP `created_on`, DROP `update_on`, DROP `url`;");
	}
}