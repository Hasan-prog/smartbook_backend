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
        $products = Products::find()->where(['view' => 1, 'parent_id' => 0])->with('subprods')->orderBy(['id' => SORT_DESC])->asArray()->all();
        return $this->render('products', compact('products'));
    }

    public function actionEditProduct() {
        $id = Yii::$app->request->get('id');
        $model = Products::find()->where(['id' => $id])->with('subprods')->limit(1)->one();
        $current_photo = $model->photo;

        if (Yii::$app->request->post('new_arrival')) {
            $model->in_stock += Yii::$app->request->post('new_arrival');
            $model->save();

            // Changing in stock of parent product
            if ($model->parent_id > 0) {
                $parent_product = Products::find()->with('subprods')->where(['id' => $model->parent_id, 'view' => 1])->limit(1)->one();
            }
            if (isset($parent_product)) {
                if ($parent_product->in_stock > $model->in_stock) {
                    $parent_product->in_stock = $model->in_stock;
                    $parent_product->save();
                } else {
                    $lowest_qty = 0;
                    $i = 0;
                    foreach ($parent_product->subprods as $subprod) {
                        if ($i == 0) {
                            $lowest_qty = $subprod['in_stock'];
                        } else {
                            if ($lowest_qty > $subprod['in_stock']) {
                                $lowest_qty = $subprod['in_stock'];
                            }
                        }
                        $i++;
                    }
                    
                    $parent_product->in_stock = $lowest_qty;
                    $parent_product->save();
                }
            }
            
            return $this->refresh();
        }

        if ($model->load(Yii::$app->request->post())) {
            $product = Yii::$app->request->post('Products');
            debug($product); die;
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
        if (isset($_GET['parent_id'])) {
            $parent_id = Yii::$app->request->get('parent_id');
        } else {
            $parent_id = 0;
        }

        if ($model->load(Yii::$app->request->post())) {
            // Photo upload 
            $model->photo = UploadedFile::getInstance($model, 'photo');
            $photo_name = $model->photo->name;
            $model->upload();
            $model->photo = '/web/images/' . $photo_name;

            $product = Yii::$app->request->post('Products');

            $model->name = $product['name'];
            $model->parent_id = $product['parent_id'];
            $model->price = $product['price'];
            $model->format = $product['format'];
            $model->in_stock = $product['in_stock'];
            $model->save();

            // Changing in stock of parent product
            if ($model->parent_id > 0) {
                $parent_product = Products::find()->with('subprods')->where(['id' => $model->parent_id, 'view' => 1])->limit(1)->one();
            }
            if (isset($parent_product) && isset($_GET['parent_id'])) {
                if ($parent_product->in_stock > $product['in_stock']) {
                    $parent_product->in_stock = $product['in_stock'];
                    $parent_product->save();
                }
            }

            return $this->redirect('/products/');
        }

        return $this->render('add-product', compact('model', 'parent_id'));
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
        $products_db = Products::find()->where(['view' => 1, 'parent_id' => 0])->asArray()->all();
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
                $product_db = Products::find()->where(['id' => $product_id, 'parent_id' => 0])->with('subprods')->limit(1)->one();
                
                // Decrease all sub products in stock and assign new qty for whole package
                foreach ($product_db->subprods as $subprod) {
                    $subprod_db = Products::find()->where(['id' => $subprod['id']])->limit(1)->one();
                    $subprod_db->in_stock -= $product_qty;
                    $subprod_db->save();
                }
                
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