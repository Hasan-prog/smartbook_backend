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
        $clients = Clients::find()->asArray()->all();
        $orders = Orders::find()->asArray()->all();
        return $this->render('clients', compact('clients', 'orders'));
    }

    public function actionClientList() {
        $request = Yii::$app->request;
        $client_id = $request->get('client');
        $client = Clients::find()->asArray()->where(['id' => $client_id])->limit(1)->one();
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
        $products = Products::find()->asArray()->all();
        $cities = Cities::find()->asArray()->all();
        $couriers = Couriers::find()->asArray()->all();

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
            $model->manager_id = 1; // For now 1, but we have to cahnge it when log in system will be created
            $model->save();
            $this->refresh(); 
        }

        return $this->render('add-order', compact('model', 'products', 'cities', 'couriers'));
    }

    public function actionEditOrder() {
        return $this->render('edit-order');
    }

}
