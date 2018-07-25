<?php

use yii\db\Migration;

/**
 * Class m180725_065824_posts
 */
class m180725_065824_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200),
            'text' => $this->string(2000),
            'user_id' => $this->integer(),
            'alias' => $this->string(200)
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('posts');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180725_065824_posts cannot be reverted.\n";

        return false;
    }
    */
}
