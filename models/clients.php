<?php

namespace app\models;

use yii\db\ActiveRecord;

class Clients extends ActiveRecord {

    public static function tableName() {
        return 'clients';
    }

    // public function getOrders() {
    //     return $this->hasMany(Orders::className(), ['id' => 'orders-id']);
    // }


}

?>