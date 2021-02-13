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
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = Products::findOne($id);
            $model->view = 0;
            $model->save();
        }
        $products = Products::find()->where(['view' => 1])->orderBy(['id' => SORT_DESC])->asArray()->all();
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
            return $this->redirect('/products/');
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
            return $this->redirect('/products/');
        }

        return $this->render('add-product', compact('model'));
    }

    public function actionHistory() {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = History::findOne($id);
            $model->view = 0;
            $model->save();
        }
        $model = new History();
        $history = History::find()->asArray()->where(['view' => 1])->with('courier')->orderBy('id DESC')->with('city')->all();
        $products_db = Products::find()->where(['view' => 1])->asArray()->all();
        $cities = Cities::find()->where(['view' => 1])->asArray()->all();
        $couriers = Couriers::find()->asArray()->where(['view' => 1])->all();
        
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
            
            // Edit how much the selected courier left
            $courier = Couriers::findOne($history['courier_id']);
            if ($courier['qty_left'] == 0) {
                $courier->qty_left = $history['products_id'];
                $courier->save();
            } else {
                $courier_items = explode('/', $courier['qty_left']);
                foreach ($courier_items as $key => $item) {
                    $courier_items[$key] = explode(':', $item);
                }
                // Explode sent items from the form
                $model_items = explode('/', $history['products_id']);
                foreach ($model_items as $key => $item) {
                    $model_items[$key] = explode(':', $item);
    
                    // Search same item in the courier's stock
                    foreach ($courier_items as $item) {
                        if (in_array($model_items[$key][0], $item)) {
                            $model_items[$key][1] += $item[1]; // Sum their quantities
                        } else {
                            array_push($model_items, $item);
                        }
                    }
                }
                // Combine $model_items in string
                $model_items_str = '';
                foreach ($model_items as $item) {
                    if ($model_items_str == '') {
                        $model_items_str = $item[0] . ':' . $item[1];
                    } else {
                        $model_items_str .= '/' . $item[0] . ':' . $item[1];
                    }
                }
    
                $courier->qty_left = $model_items_str;
                $courier->save();
            }

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
        // $prods_i = explode(',', $model->products_id);
        // debug($model); die;
        // $i = 0;
        // $products = [];
        // foreach ($prods_i as $prod) {
        //     $prods_i[$i] = explode(':', $prod);
        //     $i++;
            
        // }
        // foreach ($prods_i as $prod) {
        //     $products[$prod[0]] = Products::find()->asArray()->where(['id' => $prod[0]])->limit(1)->one();
        //     $products[$prod[0]]['qty'] = $prod[1];
        // }

        
        $products = explode('/', $model->products_id);
        $parsed_prods = [];

        foreach ($products as $key => $product) {
            $prod = explode(',', $product);
            $prod[2] = explode(':', $prod[2]);
            $products_arr[] = $prod;
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

        return $this->render('edit-history', compact('model', 'products_arr', 'products_db', 'cities', 'couriers'));
    }

}