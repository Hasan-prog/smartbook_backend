<?php

namespace app\controllers;

use app\controllers\AppController;
use Yii;
use app\models\Clients;
use app\models\Orders;
use app\models\Products;
use app\models\Cities;
use app\models\Couriers;
use app\models\Operators;
use app\models\Districts;
use yii\data\ActiveDataProvider;

class OrdersController extends AppController
{

    public function actionClients() {
        // Delete a client
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = Clients::findOne($id);
            $model->view = 0;
            $model->save();
        }
        // $clients_query = Clients::find()->where(['view' => 1]);
        // $countQuery = clone $clients_query;
        // $pages = new Pagination(['totalCount' => $countQuery->count()]);
        // $clients = $clients_query->offset($pages->offset)
        //     ->limit($pages->limit)
        //     ->asArray()
        //     ->all();

        $provider = new ActiveDataProvider([
            'query' => Clients::find()->where(['view' => 1]),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        $clients = $provider->getModels();
        $orders = Orders::find()->asArray()->where(['view' => 1])->all();
        $cities = Cities::find()->asArray()->all();
        return $this->render('clients', compact('clients', 'orders', 'cities', 'provider'));
    }

    public function actionClientList() {
        // Delete an order
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = Orders::findOne($id);
            $model->view = 0;
            $model->save();
        }
        
        $request = Yii::$app->request;
        $client_id = $request->get('client');
        $client = Clients::find()->asArray()->where(['id' => $client_id])->limit(1)->one();
        if (empty($client)) {
            return $this->redirect('/orders/clients');
        }
        if ($client['view'] != 1) {
            return $this->redirect('/orders/clients');
        }
        $orders = Orders::find()->with('manager')->asArray()->with('courier')->where(['name' => $client['name'], 'phone_number' => $client['phone_number'], 'view' => 1])->all();

        // Count stats
        $delivered_qty = 0;
        $not_delivered_qty = 0;
        $canceled_qty = 0;
        $cash = 0;
        $click = 0;
        $id_array = explode(',', $client['orders_id']);
        foreach ($orders as $key => $order) {
            if (in_array($order['id'], $id_array)) {
                if ($order['status'] == 'delivered') {
                    $delivered_qty++;
                } else if ($order['status'] == 'not-delivered') {
                    $not_delivered_qty++;
                } else if ($order['status'] == 'canceled') {
                    $canceled_qty++;
                }
                if ($order['payment_method'] == 'cash') {
                    $cash += $order['price'];
                    $payment_label = 'Naqd';
                } else {
                    $click += $order['price'];
                    $payment_label = 'Click';
                }

                // Making beautiful name
                $orders[$key]['product'] = explode(':', $orders[$key]['product']);
                $orders[$key]['product'] = explode(',', $orders[$key]['product'][0]);
                $orders[$key]['product'][3] = $order['product'];
            }
        }
        $overall = $cash + $click;

        return $this->render('client-list', compact('client', 'orders', 'delivered_qty', 'not_delivered_qty', 'canceled_qty', 'cash', 'click', 'overall', 'id_array'));
    }

    public function actionAddOrder() {
        $model = new Orders();
        $products = Products::find()->asArray()->where(['view' => 1])->all();
        $cities = Cities::find()->asArray()->where(['view' => 1])->all();
        $couriers = Couriers::find()->asArray()->where(['view' => 1])->all();
        $operators = Operators::find()->asArray()->where(['view' => 1])->all();
        $districts = Districts::find()->asArray()->where(['view' => 1])->all();
        $client_model = new Clients();

        if (Yii::$app->request->isAjax) {            
            
            $order = Yii::$app->request->post('orders');
            
            $model->name = $order['name'];
            $model->phone_number = $order['phone_number'];
            $model->product = $order['product'];
            $model->client_id = $order['client_id'];
            $model->city_id = $order['city_id'];
            $model->operator_id = $order['operator_id'];
            if ($order['district_id'] == 'null') {
                $model->district_id == null;
            } else {
                $model->district_id = $order['district_id'];
            }
            $model->address = $order['address'];
            $model->payment_method = $order['payment_method'];
            $model->courier_id = $order['courier_id'];
            $model->price = $order['price'];
            $model->last_changed_time = date('Y-m-d h:m:s');
            $model->last_changed_user = Yii::$app->user->identity['name'];
            $model->manager_id = Yii::$app->user->identity['id']; // For now 1, but we have to cahnge it when log in system will be created
            $model->save();
            $new_order_id = $model->id;
            
            // Building a new client
            $client_search = Clients::find()->where(['name' => $order['name'], 'phone_number' => $order['phone_number']])->limit(1)->one();
            if (empty($client_search)) {
                $client_model->client_id = $order['client_id'];
                $client_model->name = $order['name'];
                $client_model->phone_number = $order['phone_number'];
                $client_model->address = $order['address'];
                $client_model->orders_id = $new_order_id; // if new just paste a current generated id, if existing add by ','
                $client_model->save();
                $c_id = $client_model->id;
            } else {
                $current_client_id = $client_search->client_id;
                $client_search->client_id = $current_client_id;
                $client_search->name = $order['name'];
                $client_search->phone_number = $order['phone_number'];
                $client_search->address = $order['address'];
                $client_search->orders_id = $client_search->orders_id . ',' . $new_order_id; // if new just paste a current generated id, if existing add by ','
                $client_search->view = 1;
                $client_search->save();

                $c_id = $client_search->id;
            }
            
            // return $this->redirect('/orders/client-list?client=' . $c_id);
            return true;    
        }

        return $this->render('add-order', compact('model', 'products', 'cities', 'couriers', 'operators', 'districts'));
    }

    public function actionEditOrder() {
        $id = Yii::$app->request->get('id');
        $model = Orders::findOne($id);
        $products = Products::find()->asArray()->where(['view' => 1])->all();
        $cities = Cities::find()->asArray()->where(['view' => 1])->all();
        $couriers = Couriers::find()->asArray()->where(['view' => 1])->all();
        $operators = Operators::find()->asArray()->where(['view' => 1])->all();
        $districts = Districts::find()->asArray()->where(['view' => 1])->all();
        $client_model = new Clients();

        if ($model->load(Yii::$app->request->post())) {            
            
            $order = Yii::$app->request->post('Orders');
            
            $model->name = $order['name'];
            $model->phone_number = $order['phone_number'];
            $model->product = $order['product'];
            $model->client_id = $order['client_id'];
            $model->city_id = $order['city_id'];
            $model->operator_id = $order['operator_id'];
            if ($order['district_id'] == 'null') {
                $model->district_id == null;
            } else {
                $model->district_id = $order['district_id'];
            }
            $model->address = $order['address'];
            $model->payment_method = $order['payment_method'];
            $model->courier_id = $order['courier_id'];
            $model->price = $order['price'];
            $model->last_changed_time = date('Y-m-d h:m:s');
            $model->last_changed_user = Yii::$app->user->identity['name'];
            $model->manager_id = Yii::$app->user->identity['id']; // For now 1, but we have to cahnge it when log in system will be created
            $model->save();
            $new_order_id = $model->id;
            
            // Building a new client
            $client_search = Clients::find()->where(['name' => $order['name'], 'phone_number' => $order['phone_number']])->limit(1)->one();
            if (empty($client_search)) {
                $client_model->client_id = $order['client_id'];
                $client_model->name = $order['name'];
                $client_model->phone_number = $order['phone_number'];
                $client_model->address = $order['address'];
                $client_model->orders_id = $new_order_id; // if new just paste a current generated id, if existing add by ','
                $client_model->save();
                $c_id = $client_model->id;
            } else {
                $current_client_id = $client_search->client_id;
                $client_search->client_id = $current_client_id;
                $client_search->name = $order['name'];
                $client_search->phone_number = $order['phone_number'];
                $client_search->address = $order['address'];
                $client_search->orders_id = $client_search->orders_id . ',' . $new_order_id; // if new just paste a current generated id, if existing add by ','
                $client_search->view = 1;
                $client_search->save();

                $c_id = $client_search->id;
            }
            
            // return $this->redirect('/orders/client-list?client=' . $c_id);
        }

        return $this->render('edit-order', compact('model', 'products', 'cities', 'couriers', 'operators', 'districts'));
    }

}
