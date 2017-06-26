<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `bfp_settings`.
 */
class m170619_125609_create_bfp_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%bfp_settings}}', [
            'bfp_id' => $this->primaryKey(),
            'page_name' => Schema::TYPE_STRING . "(512) NULL",
            'form_time_submite' => Schema::TYPE_INTEGER . "(11) NULL",
            'form_sleep' => Schema::TYPE_INTEGER . "(11) NULL",
            'confirm_page' => Schema::TYPE_BOOLEAN . " NULL",
            'confirm_sleep' => Schema::TYPE_INTEGER . "(11) NULL",
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex(
            'bfp-page_name',
            '{{%bfp_settings}}',
            'page_name'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%bfp_settings}}');
    }
}
