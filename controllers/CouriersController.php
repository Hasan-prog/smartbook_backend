<?php

namespace app\controllers;

use app\controllers\AppController;
use Yii;
use app\models\Couriers;
use app\models\Cities;
use yii\web\UploadedFile;

class CouriersController extends AppController
{
    
    public function actionIndex() {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = Couriers::findOne($id);
            $model->view = 0;
            $model->save();
        }
        $couriers = Couriers::find()->asArray()->where(['view' => 1])->with('cities')->with('orders')->all();
        if (!empty($couriers)) {

        }
        if (empty($couriers)) {
            return $this->redirect('/couriers/add-courier');
        }
        return $this->render('couriers', compact('couriers'));
    }

    public function actionEditCourier() {
        // Get courier info
        $id = Yii::$app->request->get('id');
        $courier_page = Couriers::find()->asArray()->with('cities')->where(['id' => $id])->limit(1)->one();

        // Parse equipment into array
        $equip_arr = explode(',', $courier_page['equipment']);

        $model = Couriers::findOne($id);
        $cities = Cities::find()->asArray()->all();

        $current_photo = $model->photo;
        $current_password = $model->password;

        // Update
        if ($model->load(Yii::$app->request->post())) {
            // debug($model->photo); die;
            
            // Get POST info
            $courier = Yii::$app->request->post('Couriers');

            // Parse equipment array into string
            if (!empty($courier['equipment'])) {
                $equip_arr = $courier['equipment'];
                if (is_array($equip_arr)) {
                    $equip_str = "";
                    for ($e = 0; $e < count($equip_arr); $e++) {
                        if ($e == count($equip_arr) - 1) {
                            $equip_str .= $equip_arr[$e];
                        } else {
                            $equip_str .= $equip_arr[$e] . ",";
                        }
                    }
                    $model->equipment = trim($equip_str);
                } else {
                    $model->equipment = "";
                }
            }

            // Photo upload 
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->photo != null) {
                if ($model->upload()) {
                    $photo_name = $model->photo->name;
                    $model->photo = '/web/images/' . $photo_name;
                }
            } else {
                $model->photo = $current_photo;
            }
            
            // Fill up the model
            if (!empty($courier['equipment'])) {
                $model->equipment = $equip_str;
            }
            $model->name = $courier['name'];
            $model->login = $courier['login'];
            if ($model->password != '') {
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($courier['password']);
            } else {
                $model->password = $current_password;
            }
            $model->phone_number = $courier['phone_number'];
            $model->address = $courier['address'];
            $model->city_id = $courier['city_id'];
            $model->salary = $courier['salary'];
            // debug($model); die;
            $model->save();
            return $this->redirect('/couriers');
        }

        return $this->render('edit-courier', compact('model', 'cities', 'courier_page', 'equip_arr'));
    }

    public function actionAddCourier() {
        $model = new Couriers();
        $cities = Cities::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            
            // Get POST info
            $courier = Yii::$app->request->post('Couriers');

            // Parse equipment array into string
            $equip_arr = $courier['equipment'];
            if (is_array($equip_arr)) {
                $equip_str = "";
                for ($e = 0; $e < count($equip_arr); $e++) {
                    if ($e == count($equip_arr) - 1) {
                        $equip_str .= $equip_arr[$e];
                    } else {
                        $equip_str .= $equip_arr[$e] . ",";
                    }
                }
                $model->equipment = trim($equip_str);
            } else {
                $model->equipment = "";
            }

            // Photo upload 
            $model->photo = UploadedFile::getInstance($model, 'photo');
            $photo_name = $model->photo->name;
            $model->upload();
            $model->photo = '/web/images/' . $photo_name;
            
         
            // Fill up the model
            $model->equipment = $equip_str;
            $model->name = $courier['name'];
            $model->login = $courier['login'];
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($courier['password']);
            $model->phone_number = $courier['phone_number'];
            $model->address = $courier['address'];
            $model->city_id = $courier['city_id'];
            $model->salary = $courier['salary'];
            // debug($model->photo->name); die;
            // $model->photo = $model->photo->name;
            $model->save();
            return $this->redirect('/couriers');
        }
        return $this->render('add-courier', compact('model', 'cities'));
    }

}