<?php

namespace app\models;

use yii\db\ActiveRecord;

class Managers extends ActiveRecord {

    public static function tableName() {
        return 'managers';
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