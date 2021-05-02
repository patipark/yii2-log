<?php

namespace patipark\yii2log;

use Yii;

/**
 * This is the model class for table "yii2_log".
 *
 * @property int $id
 * @property string|null $before_change
 * @property string|null $after_change
 * @property string|null $event_time
 * @property string|null $event_name
 * @property string|null $model_class
 * @property string|null $table_name
 * @property string|null $primary_key
 * @property int|null $user_id
 * @property string|null $referrer
 * @property string|null $remote_ip
 * @property string|null $remote_host
 * @property string|null $request_method
 */
class Yii2Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yii2_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['before_change', 'after_change'], 'string'],
            [['event_time'], 'safe'],
            [['user_id'], 'integer'],
            [['event_name', 'model_class', 'table_name', 'primary_key', 'remote_ip', 'remote_host', 'request_method'], 'string', 'max' => 50],
            [['referrer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'before_change' => 'Before Change',
            'after_change' => 'After Change',
            'event_time' => 'Event Time',
            'event_name' => 'Event Name',
            'model_class' => 'Model Class',
            'table_name' => 'Table Name',
            'primary_key' => 'Primary Key',
            'user_id' => 'User ID',
            'referrer' => 'Referrer',
            'remote_ip' => 'Remote Ip',
            'remote_host' => 'Remote Host',
            'request_method' => 'Request Method',
        ];
    }
}
