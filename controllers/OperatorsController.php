<?php

namespace app\controllers;

use app\controllers\AppController;
use Yii;
use app\models\Couriers;
use app\models\Cities;
use app\models\Operators;
use yii\web\UploadedFile;

class OperatorsController extends AppController
{
    
    public function actionIndex() {
        
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = Operators::findOne($id);
            $model->view = 0;
            $model->save();
        }

        $operators = Operators::find()->asArray()->orderBy(['id' => SORT_DESC])->where(['view' => 1])->all();
        return $this->render('operators', compact('operators'));
    }
    
    public function actionAddOperator() {
        $model = new Operators();
        $current_photo = '/web/images/placeholder.jpg';

        if ($model->load(Yii::$app->request->post())) {

            // Photo upload 
            if (UploadedFile::getInstance($model, 'photo') != null) {
                $model->photo = UploadedFile::getInstance($model, 'photo');
                if ($model->photo != null) {
                    if ($model->upload()) {
                        $photo_name = $model->photo->name;
                        $model->photo = '/web/images/' . $photo_name;
                    }
                } else {
                    $model->photo = $current_photo;
                }
            } else {
                $model->photo = $current_photo;
            }

                        
            $operator = Yii::$app->request->post('Operators');
            $model->name = $operator['name'];
            $model->phone_number = $operator['phone_number'];
            $model->address = $operator['address'];
            $model->email = $operator['email'];
            $model->save();
            return $this->redirect('/operators/');
        }
        return $this->render('add-operator', compact('model'));
    }

    public function actionEditOperator() {
        $id = Yii::$app->request->get('id');
        $model = Operators::findOne($id);
        $current_photo = $model->photo;

        if ($model->load(Yii::$app->request->post())) {

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
                        
            $operator = Yii::$app->request->post('Operators');
            $model->name = $operator['name'];
            $model->phone_number = $operator['phone_number'];
            $model->address = $operator['address'];
            $model->email = $operator['email'];
            $model->save();
            return $this->redirect('/operators/');
        }
        return $this->render('edit-operator', compact('model'));
    }


}