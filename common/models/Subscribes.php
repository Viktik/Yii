<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscribes".
 *
 * @property int $id
 * @property int $subscriber_id
 * @property int $user_id
 * @property int $status
 */
class Subscribes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscribes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subscriber_id', 'user_id', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subscriber_id' => 'Subscriber ID',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }
}
