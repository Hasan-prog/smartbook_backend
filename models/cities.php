<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cities extends ActiveRecord {

    public static function tableName() {
        return 'cities';
    }

    public function getOrders() {
        return $this->hasMany(Orders::className(), ['city_id' => 'id'])->andOnCondition(['view' => 1]);
    }
    
    public function getCouriers() {
        return $this->hasMany(Couriers::className(), ['city_id' => 'id'])->andOnCondition(['view' => 1]);
    }

}

?>