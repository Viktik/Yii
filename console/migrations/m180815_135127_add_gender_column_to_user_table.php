<?php

use yii\db\Migration;

/**
 * Handles adding gender to table `user`.
 */
class m180815_135127_add_gender_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'gender', $this->string(64)->after('phone'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'gender');
    }
}
