<?php

use yii\db\Migration;

/**
 * Class m180823_144548_like
 */
class m180823_144548_like extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts', 'like', $this->integer()->notNull()->after('body'));
        $this->addColumn('posts', 'dislike', $this->integer()->notNull()->after('like'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('posts', 'like');
        $this->dropColumn('posts', 'dislike');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180823_144548_like cannot be reverted.\n";

        return false;
    }
    */
}
