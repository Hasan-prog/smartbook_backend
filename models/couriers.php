<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Couriers extends ActiveRecord {

    public static function tableName() {
        return 'couriers';
    }

    public function getCities() {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public function getOrders() {
        return $this->hasMany(Orders::className(), ['courier_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $path = 'images/' . $this->photo->basename . '.' . $this->photo->extension;
            $this->photo->saveAs($path);
            return true;
        } else {
            return false;
        }
    }

}

?>