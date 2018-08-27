<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscribes`.
 */
class m180816_114617_create_subscribes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('subscribes', [
            'id' => $this->primaryKey(),
            'subscriber_id' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('subscribes');
    }
}
