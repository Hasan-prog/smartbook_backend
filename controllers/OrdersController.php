<?php

namespace app\controllers;

use app\controllers\AppController;
use Yii;
use app\models\Clients;
use app\models\Orders;
use app\models\Products;
use app\models\Cities;
use app\models\Couriers;

class OrdersController extends AppController
{

    public function actionClients() {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = Clients::findOne($id);
            $model->view = 0;
            $model->save();
        }
        $clients = Clients::find()->where(['view' => 1])->asArray()->all();
        $orders = Orders::find()->asArray()->all();
        $cities = Cities::find()->asArray()->all();
        return $this->render('clients', compact('clients', 'orders', 'cities'));
    }

    public function actionClientList() {
        $request = Yii::$app->request;
        $client_id = $request->get('client');
        $client = Clients::find()->asArray()->where(['id' => $client_id])->limit(1)->one();
        if (empty($client)) {
            return $this->redirect('/orders/clients');
        }
        if ($client['view'] != 1) {
            return $this->redirect('/orders/clients');
        }
        $orders = Orders::find()->with('manager')->asArray()->where(['name' => $client['name']])->all();

        // Count stats
        $delivered_qty = 0;
        $not_delivered_qty = 0;
        $canceled_qty = 0;
        $cash = 0;
        $click = 0;
        foreach ($orders as $order) {
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
        }
        $overall = $cash + $click;

        // debug($orders); die;
        return $this->render('client-list', compact('client', 'orders', 'delivered_qty', 'not_delivered_qty', 'canceled_qty', 'cash', 'click', 'overall'));
    }

    public function actionAddOrder() {
        $model = new Orders();
        $products = Products::find()->asArray()->where(['view' => 1])->all();
        $cities = Cities::find()->asArray()->where(['view' => 1])->all();
        $couriers = Couriers::find()->asArray()->where(['view' => 1])->all();
        $client_model = new Clients();

        if ($model->load(Yii::$app->request->post())) {
            
            $order = Yii::$app->request->post('Orders');

            $model->name = $order['name'];
            $model->phone_number = $order['phone_number'];
            $model->product = $order['product'];
            $model->city_id = $order['city_id'];
            $model->address = $order['address'];
            $model->payment_method = $order['payment_method'];
            $model->courier_id = $order['courier_id'];
            $model->price = $order['price'];
            $model->last_changed_time = date('Y-m-d h:m:s');
            $model->last_changed_user = Yii::$app->user->identity['name'];
            $model->manager_id = Yii::$app->user->identity['id']; // For now 1, but we have to cahnge it when log in system will be created
            $model->save();
            
            // Building a new client
            $client_search = Clients::find()->where(['name' => $order['name'], 'phone_number' => $order['phone_number']])->limit(1)->one();
            $current_client_id = $client_search->client_id;
            if (empty($client_search)) {
                $client_model->client_id = $order['client_id'];
                $client_model->name = $order['name'];
                $client_model->phone_number = $order['phone_number'];
                $client_model->address = $order['address'];
                $client_model->orders_id = $model->id; // if new just paste a current generated id, if existing add by ','
                $client_model->save();
                $c_id = $client_model->id;
            } else {
                $client_search->client_id = $current_client_id;
                $client_search->name = $order['name'];
                $client_search->phone_number = $order['phone_number'];
                $client_search->address = $order['address'];
                $client_search->orders_id = $client_search->orders_id . ',' . $model->id; // if new just paste a current generated id, if existing add by ','
                $client_search->view = 1;
                $client_search->save();
                $c_id = $client_search->id;
            }
            
            // return $this->redirect('/orders/client-list?client=' . $c_id);
        }

        return $this->render('add-order', compact('model', 'products', 'cities', 'couriers'));
    }

    public function actionEditOrder() {
        return $this->render('edit-order');
    }

}
