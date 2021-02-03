<?php

namespace app\models;

use yii\db\ActiveRecord;

class Orders extends ActiveRecord {

    public static function tableName() {
        return 'orders';
    }

    public function getManager() {
        return $this->hasOne(Managers::className(), ['id' => 'manager_id']);
    }


}

?>