<?php

use yii\db\Migration;

/**
 * Class m180821_101719_posts_timestamp
 */
class m180821_101719_posts_timestamp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts', 'created_at', $this->integer()->notNull());
        $this->addColumn('posts', 'updated_at', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('posts', 'created_at');
        $this->dropColumn('posts', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180821_101719_posts_timestamp cannot be reverted.\n";

        return false;
    }
    */
}
