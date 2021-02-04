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
            [['client_id', 'name', 'product', 'address', 'city_id', 'phone_number', 'price', 'payment_method', 'datetime', 'status'], 'required'],
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
            'price' => 'Umumiy narh',
            'payment_method' => 'To\'lov uslubi',
        ];
    }

    public function getManager() {
        return $this->hasOne(Managers::className(), ['id' => 'manager_id']);
    }


}

?>