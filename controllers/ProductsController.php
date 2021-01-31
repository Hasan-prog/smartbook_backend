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
        $products = Products::find()->where(['view' => 1])->asArray()->all();
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
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = History::findOne($id);
            $model->view = 0;
            $model->save();
        }
        $model = new History();
        $history = History::find()->asArray()->where(['view' => 1])->with('courier')->orderBy('id DESC')->with('city')->all();
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
            
            // Edit how much the selected courier left
            // $courier = Couriers::findOne($history['courier_id']);
            // $courier_left_products = explode('/', $courier->qty_left);
            // $courier_left_arr = [];
            // $left_and_selected_arr = [];
            // foreach ($courier_left_products as $key => $courier_left_prod) {
            //     $courier_left_products[$key] = explode(',', $courier_left_prod);
            //     $courier_left_products[$key][2] = explode(':', $courier_left_products[$key][2]);
            //     $courier_left_arr[$key]['product_id'] = $courier_left_products[$key][0];
            //     $courier_left_arr[$key]['name'] = $courier_left_products[$key][1];
            //     $courier_left_arr[$key]['format'] = $courier_left_products[$key][2][0];
            //     $courier_left_arr[$key]['qty'] = $courier_left_products[$key][2][1];
            // }
            
            // Get arr of products from form
            // $products_form = explode('/', $history['products_id']);
            // $products_form_arr = [];
            // foreach ($products_form as $key => $product_form) {
            //     $products_form[$key] = explode(',', $product_form);
            //     $products_form[$key][2] = explode(':', $products_form[$key][2]);
            //     $products_form_arr[$key]['product_id'] = $products_form[$key][0];
            //     $products_form_arr[$key]['name'] = $products_form[$key][1];
            //     $products_form_arr[$key]['format'] = $products_form[$key][2][0];
            //     $products_form_arr[$key]['qty'] = $products_form[$key][2][1];
            // }

            // foreach ($courier_left_arr as $key => $courier_left) {
            //     $left_and_selected_arr[count($left_and_selected_arr)] = $courier_left;   
            // }
            // foreach ($products_form_arr as $key => $products_form) {
            //     $left_and_selected_arr[count($left_and_selected_arr)] = $products_form;   
            // }

            // Find same products and merge them together
            // $sorted_products_str = [];
            // asort($left_and_selected_arr);
            // foreach ($left_and_selected_arr as $key => $left_and_selected) {
            //     if (!empty($sorted_products_str)) {
            //         foreach ($sorted_products_str as $key => $sorted_product) {
            //             if ($sorted_product['name'] == $left_and_selected['name']) {
            //                 // product already exist, just change qty
            //                 $sorted_product['qty'] += $left_and_selected['qty'];
            //                 debug($sorted_product['qty']);
            //             } else {
            //                 $sorted_products_str[$key] = $left_and_selected;
            //                 debug($sorted_product['qty']);
            //             }
                        
            //         }
            //     } else {
            //         $sorted_products_str[$key] = $left_and_selected;
            //     }
            // }

            // debug($sorted_products_str);
            // die;

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