# yii2-log
ใช้ในการเก็บ Log ของ Active Record Model  โดยเก็บทุกฟิวด์ของตาราง ก่อน/หลัง การแก้ไข ไว้ในตารางในรูปแบบ JSON

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer require patipark/yii2-log "dev-master"
```

or add

```
    "require": {
        ......
        "patipark/yii2-log": "dev-master"
        ......
    }
```

to the require section of your `composer.json` file.

Apply migrations เสร็จแล้วจะสร้างตารางชื่อว่า yii2_log เพื่อเก็บ Log
 
 ```
yii migrate/up --migrationPath=@vendor/patipark/yii2-log/migrations
```

Configure the behavior
```php
class Category extends \yii\db\ActiveRecord
{
    public $ignoreLogAttributes = ['created_by', 'created_at', 'updated_by', 'updated_at'];
    
    public function behaviors()
    {
        return [
            \patipark\yii2log\LogBehavior::class,
            ......
            ......
        ];
    }
```

### attributes ที่ไม่ต้องการเก็บ log  
ให้ประกาศตัวแปร ไว้ใน model ขื่อว่า **$ignoreLogAttributes**  แต่ถ้าไม่ได้ประกาศไว้ จะเก็บ log ทุกฟิวด์ 

```php
public $ignoreLogAttributes = ['created_by', 'created_at', 'updated_by', 'updated_at'];
```


## การทำงาน
ข้อมูลจะเก็บในตารางชื่อ yii2_log และเก็บข้อมูลในรูปแบบ JSON โดยข้อมูลทุกฟิวด์ก่อนการเปลี่ยนแปลงจะเก็บไว้ในฟิวด์ before_change ข้อมูลทุกฟิวด์หลังการเปลี่ยนแปลงจะเก็บไว้ในฟิวด์ after_change 
