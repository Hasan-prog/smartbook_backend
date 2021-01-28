<?php

namespace app\models;

use yii\db\ActiveRecord;

class History extends ActiveRecord {

    public static function tableName() {
        return 'history';
    }

    public function getCourier() {
        return $this->hasOne(Couriers::className(), ['id' => 'courier_id']);
    }

    public function getCity() {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

}

?>