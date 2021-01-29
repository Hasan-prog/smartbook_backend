<?php

namespace app\controllers;

use app\controllers\AppController;
use Yii;
use app\models\Products;
use app\models\History;
use app\models\Cities;
use app\models\Couriers;
use yii\web\UploadedFile;

class ProductsController extends AppController
{

    public function actionIndex() {
        $products = Products::find()->asArray()->all();
        return $this->render('products', compact('products'));
    }

    public function actionEditProduct() {
        $id = Yii::$app->request->get('id');
        $model = Products::findOne($id);
        $current_photo = $model->photo;

        if (Yii::$app->request->post('new_arrival')) {
            $model->in_stock += Yii::$app->request->post('new_arrival');
            $model->save();
            return $this->refresh();
        }

        if ($model->load(Yii::$app->request->post())) {
            $product = Yii::$app->request->post('Products');
            // Photo upload 
            if (UploadedFile::getInstance($model, 'photo')) {
                $model->photo = UploadedFile::getInstance($model, 'photo');
                $photo_name = $model->photo->name;
                $model->upload();
                $model->photo = '/web/images/' . $photo_name;
            } else {
                $model->photo = $current_photo;
            }
            $model->name = $product['name'];
            $model->price = $product['price'];
            $model->format = $product['format'];
            $model->save();
            return $this->refresh();
        }

        return $this->render('edit-product', compact('model'));
    }

    public function actionAddProduct() {
        $model = new Products;

        if ($model->load(Yii::$app->request->post())) {
            // Photo upload 
            $model->photo = UploadedFile::getInstance($model, 'photo');
            $photo_name = $model->photo->name;
            $model->upload();
            $model->photo = '/web/images/' . $photo_name;

            $product = Yii::$app->request->post('Products');
            $model->name = $product['name'];
            $model->price = $product['price'];
            $model->format = $product['format'];
            $model->in_stock = $product['in_stock'];
            $model->save();
            return $this->refresh();
        }

        return $this->render('add-product', compact('model'));
    }

    public function actionHistory() {
        $model = new History();
        $history = History::find()->asArray()->with('courier')->with('city')->all();
        $products_db = Products::find()->asArray()->all();
        $cities = Cities::find()->asArray()->all();
        $couriers = Couriers::find()->asArray()->all();
        
        if ($model->load(Yii::$app->request->post())) {
            $history = Yii::$app->request->post('History');

            // Decrease in-stock of a product 
            $products = explode('/', $history['products_id']);
            foreach ($products as $product) {
                $product_explode = explode(',', $product);
                $product_id = $product_explode[0];
                $product_qty = explode(':', $product_explode[2])[1];
                $product_db = Products::findOne($product_id);
                $product_db->in_stock -= $product_qty;
                $product_db->save();
            }

            $model->products_id = $history['products_id'];
            $model->city_id = $history['city_id'];
            $model->courier_id = $history['courier_id'];
            $model->save();
            return $this->refresh();
        }

        return $this->render('history',  compact('history', 'products_db', 'model', 'cities', 'couriers'));
    }

    public function actionEditHistory() {
        $id = Yii::$app->request->get('id');
        $model = History::findOne($id);
        $products_db = Products::find()->asArray()->all();
        $cities = Cities::find()->asArray()->all();
        $couriers = Couriers::find()->asArray()->all();

        // Parse data from products_id
        $prods_i = explode(',', $model->products_id);
        $i = 0;
        $products = [];
        foreach ($prods_i as $prod) {
            $prods_i[$i] = explode(':', $prod);
            $i++;
        }
        foreach ($prods_i as $prod) {
            $products[$prod[0]] = Products::find()->asArray()->where(['id' => $prod[0]])->limit(1)->one();
            $products[$prod[0]]['qty'] = $prod[1];
        }

        if ($model->load(Yii::$app->request->post())) {
            $history = Yii::$app->request->post('History');
            $model->products_id = $history['products_id'];
            $model->city_id = $history['city_id'];
            $model->datetime = $history['datetime'];
            $model->courier_id = $history['courier_id'];
            $model->save();
            return $this->refresh();
        }

        // debug($products); die;

        return $this->render('edit-history', compact('model', 'products', 'products_db', 'cities', 'couriers'));
    }

}