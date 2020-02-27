<?php

use yii\db\Migration;

/**
 * Class m200227_033222_create_table_service
 */
class m200227_033222_create_table_service extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'name_status' => $this->string()
        ]);

        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'path_file' => $this->string(),
        ]);

        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'name_service' => $this->string(),
            'description' => $this->string(),
            'file_id' => $this->integer(),
            'status_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-service-file_id',
            'service',
            'file_id',
            'file',
            'id'
        );

        $this->addForeignKey(
            'fk-service-status_id',
            'service',
            'status_id',
            'status',
            'id'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-service-file_id',
            'service'
        );

        $this->dropForeignKey(
            'fk-service-status_id',
            'service'
        );

        $this->dropTable('status');
        $this->dropTable('file');
        $this->dropTable('service');

        return false;
    }

}
