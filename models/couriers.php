<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Couriers extends ActiveRecord {

    public static function tableName() {
        return 'couriers';
    }

    public function getCities() {
        return $this->hasOne(Cities::className(), ['id' => 'city_id'])->andOnCondition(['view' => 1]);
    }

    public function getOrders() {
        return $this->hasMany(Orders::className(), ['courier_id' => 'id'])->andOnCondition(['view' => 1]);
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

        /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generateAuthKey() {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

}

?>