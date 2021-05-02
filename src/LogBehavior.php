<?php

namespace patipark\yii2log;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class LogBehavior extends Behavior
{
    /**
     * กำหนด event ให้ไปที่ method
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'log',
            ActiveRecord::EVENT_AFTER_UPDATE => 'log',
        ];
    }

    public function log($event)
    {
        $model = new Yii2Log();
        $beforeChange = $event->sender->oldAttributes;  // attribute ทีั้งหมดก่อนการเปลี่ยนแปลง
        $afterChange = $event->sender->attributes;      // attribute ทีั้งหมดหลังการเปลี่ยนแปลง
        if (property_exists($event->sender::className(), 'ignoreLogAttributes')  && is_array($event->sender->ignoreLogAttributes)) {
            foreach ($event->sender->ignoreLogAttributes as $attribute) {
                // remove attribute ที่ทำการ ignore ออกจาก array log
                unset($beforeChange[$attribute]);
                unset($afterChange[$attribute]);
            }
        }
        $model->before_change = Json::encode($beforeChange);
        $model->after_change = Json::encode($afterChange);
        $model->event_time = new Expression('NOW()');
        $model->event_name = $event->name;
        $model->model_class = $event->sender::className();
        $model->table_name = $event->sender->tableName();
        $model->primary_key = Json::encode($event->sender->getPrimaryKey(true));
        $model->user_id = Yii::$app->user->identity->id ?? null;
        $model->referrer = Yii::$app->request->referrer;
        $model->remote_ip = Yii::$app->request->remoteIP;
        $model->remote_host = Yii::$app->request->remoteHost;
        $model->request_method = Yii::$app->request->method;
        $model->save();
    }
}
