<?php
/**
 * Migration Task class.
 */
class GoteoTermsChannel
{
  public function preUp()
  {
      // add the pre-migration code here
  }

  public function postUp()
  {
      // add the post-migration code here
  }

  public function preDown()
  {
      // add the pre-migration code here
  }

  public function postDown()
  {
      // add the post-migration code here
  }

  /**
   * Return the SQL statements for the Up migration
   *
   * @return string The SQL string to execute for the Up migration.
   */
  public function getUpSQL()
  {
     return "
              ALTER TABLE `node` ADD COLUMN `terms` longtext CHARSET utf8 COLLATE utf8_general_ci;
              ALTER TABLE `node` ADD COLUMN `show_team` TINYINT(1) DEFAULT 0 NOT NULL AFTER `project_creation_open`;
              ALTER TABLE `node_lang` ADD COLUMN `terms` longtext CHARSET utf8 COLLATE utf8_general_ci;


     ";
  }

  /**
   * Return the SQL statements for the Down migration
   *
   * @return string The SQL string to execute for the Down migration.
   */
  public function getDownSQL()
  {
     return "
        ALTER TABLE `node` DROP COLUMN `terms`;
        ALTER TABLE `node` DROP COLUMN `show_team`;
        ALTER TABLE `node_lang` DROP COLUMN `terms`;
     ";
  }

}