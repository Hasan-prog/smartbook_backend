<?php

namespace app\controllers;

use app\controllers\AppController;
use Yii;
use app\models\Cities;
use app\models\Orders;
use app\models\Couriers;

class CitiesController extends AppController
{

    public function actionIndex() {
        $cities = Cities::find()->asArray()->with('orders')->with('couriers')->all();
        return $this->render('cities', compact('cities'));
    }

    public function actionDailyList() {
        if (Yii::$app->request->isAjax) {
            $model = Orders::findOne(Yii::$app->request->post('order_id'));
            $model->status = Yii::$app->request->post('status');
            $model->save();
            return;
        }
        $request = Yii::$app->request;
        $date = $request->get('d');
        $date_formated = date('d M, Y – h:m', strtotime($date));
        $orders = Orders::find()->asArray()->with('manager')->where(['like', 'datetime', $date])->all();
        // Count overall day stats
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
            } else {
                $click += $order['price'];
            }
        }
        $overall = $cash + $click;
        $cash = price_format($cash);
        $click = price_format($click);
        $overall = price_format($overall);
        return $this->render('daily-list', compact('orders', 'date', 'date_formated', 'delivered_qty', 'not_delivered_qty', 'canceled_qty', 'cash', 'click', 'overall'));
    }

    public function actionMonthlyList() {
        $request = Yii::$app->request;
        $city_id = $request->get('city');
        $couriers = Couriers::find()->asArray()->with('cities')->where(['city_id' => $city_id])->all();
        $orders = Orders::find()->asArray()->with('manager')->where(['city_id' => $city_id])->all();
        $city = Cities::findOne($city_id);

        // Current month
        $current_month = date('m');
        $current_year = date('Y');
        $current_month_word = date('M');
        $today = date('d');
        $current_month_days = [];
        $months_with_orders = [];
        array_push($current_month_days, $today);
        while ($today > 1) {
            $today--;
            array_push($current_month_days, $today);
        }

        foreach ($orders as $order) {
            $months_with_orders[cutMonth($order['datetime'])][$order['id']] = $order;
        }
        unset($months_with_orders[$current_month]);

        // debug($months_with_orders); die;
        return $this->render('monthly-list',compact('couriers', 'orders', 'current_month', 'current_month_word', 'current_month_days', 'months_with_orders', 'current_year', 'city'));
    }

    public function actionMonthlyListCourier() {
        $request = Yii::$app->request;
        $city_id = $request->get('city');
        $courier_id = $request->get('courier');
        $couriers = Couriers::find()->asArray()->with('cities')->where(['city_id' => $city_id])->all();
        $orders = Orders::find()->asArray()->with('manager')->where(['courier-id' => $courier_id])->where(['city_id' => $city_id])->all();
        $city = Cities::findOne($city_id);

        // Current month
        $current_month = date('m');
        $current_month_word = date('M');
        $today = date('d');
        $current_month_days = [];
        $months_with_orders = [];
        array_push($current_month_days, $today);
        while ($today > 1) {
            $today--;
            array_push($current_month_days, $today);
        }

        foreach ($orders as $order) {
            $months_with_orders[cutMonth($order['datetime'])][$order['id']] = $order;
        }
        unset($months_with_orders[$current_month]);

        // debug($couriers); die;
        return $this->render('monthly-list-courier', compact('couriers', 'orders', 'courier_id', 'current_month', 'current_month_word', 'current_month_days', 'months_with_orders', 'city'));
    }

}
