<?php

namespace app\models;

use yii\db\ActiveRecord;

class Orders extends ActiveRecord {

    public static function tableName() {
        return 'orders';
    }
    
    public function rules()
    {
        return [
            [['client_id', 'name', 'product', 'address', 'city_id', 'phone_number', 'price', 'payment_method'], 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'client_id' => 'ID',
            'name' => 'Ism',
            'product' => 'Mahsulotlar',
            'address' => 'Manzil',
            'city_id' => 'Shahar',
            'phone_number' => 'Telefon',
            'price' => 'Umumiy narx',
            'payment_method' => 'To\'lov uslubi',
        ];
    }

    public function getManager() {
        return $this->hasOne(Managers::className(), ['id' => 'manager_id']);
    }

    public function getCourier() {
        return $this->hasOne(Couriers::className(), ['id' => 'courier_id']);
    }

    public function getOperator() {
        return $this->hasOne(Operators::className(), ['id' => 'operator_id']);
    }

    public function getDistrict() {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }


}

?>