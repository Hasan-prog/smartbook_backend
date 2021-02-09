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
        $cities = Cities::find()->asArray()->with('orders')->with('couriers')->where(['view' => 1])->all();
        return $this->render('cities', compact('cities'));
    }

    public function actionDailyList() {

        if (Yii::$app->request->isAjax) {

            // Delete an order
            if (Yii::$app->request->post('delete') == 1) {
                $id = Yii::$app->request->post('id');
                $model = Orders::findOne($id);
                $model->view = 0;
                $model->save();
            }
            
            $courier_id = Yii::$app->request->post('courier_id');
            $courier = Couriers::findOne($courier_id);
            
            // Edit how much the selected courier left – DECREASE
            if (Yii::$app->request->post('status') == 'delivered') {
                $order_str = Yii::$app->request->post('order_str');

                if ($courier['qty_left'] == 0) {
                    $courier->qty_left = $order_str;
                    $courier->save();
                } else {
                    $courier_items = explode('/', $courier['qty_left']);
                    foreach ($courier_items as $key => $item) {
                        $courier_items[$key] = explode(':', $item);
                    }
                    // Explode sent items from the form
                    $model_items = explode('/', $order_str);
                    foreach ($model_items as $key => $item) {
                        $model_items[$key] = explode(':', $item);
        
                        // Search same item in the courier's stock
                        foreach ($courier_items as $item) {
                            if (in_array($model_items[$key][0], $item)) {
                                $model_items[$key][1] = $item[1] - $model_items[$key][1]; // Sum their quantities
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
                    // debug($model_items_str); die;
        
                    $courier->qty_left = $model_items_str;
                    $courier->save();
                }
            }

            if (Yii::$app->request->post('status') == 'not-delivered' || Yii::$app->request->post('status') == 'canceled') {
                $order_str = Yii::$app->request->post('order_str');
                $add_item = Yii::$app->request->post('add_item');

                if ($add_item == 1) {
                    if ($courier['qty_left'] == 0) {
                        $courier->qty_left = $order_str;
                        $courier->save();
                    } else {
                        $courier_items = explode('/', $courier['qty_left']);
                        foreach ($courier_items as $key => $item) {
                            $courier_items[$key] = explode(':', $item);
                        }
                        // Explode sent items from the form
                        $model_items = explode('/', $order_str);
                        foreach ($model_items as $key => $item) {
                            $model_items[$key] = explode(':', $item);
            
                            // Search same item in the courier's stock
                            foreach ($courier_items as $item) {
                                if (in_array($model_items[$key][0], $item)) {
                                    $model_items[$key][1] = $item[1] + $model_items[$key][1]; // Sum their quantities
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
                        // debug($model_items_str); die;
            
                        $courier->qty_left = $model_items_str;
                        $courier->save();
                    }
                }
            }

            if (Yii::$app->request->post('status') != null) {
                $model = Orders::findOne(['id' => Yii::$app->request->post('order_id'), 'view' => 1]);
                $model->status = Yii::$app->request->post('status');
                $model->last_changed_time = date('Y-m-d h:m:s');
                $model->last_changed_user = Yii::$app->user->identity['name'];
                $model->save();
            }
            if (Yii::$app->request->post('accounting') != null) {
                $model = Orders::findOne(['id' => Yii::$app->request->post('order_id'), 'view' => 1]);
                $model->accounting = Yii::$app->request->post('accounting');
                $model->last_changed_time = date('Y-m-d h:m:s');
                $model->last_changed_user = Yii::$app->user->identity['name'];
                $model->save();
            }
            return;
        }

        $request = Yii::$app->request;
        $date = $request->get('d');
        $date_formated = date('d M, Y – h:i', strtotime($date));
        $city = $request->get('city');
        $city_id = $request->get('city_id');
        if ($request->get('courier_routing')) {
            $courier_routing = $request->get('courier_routing');
        } else {
            $courier_routing = '';
        }
        $courier_id = $request->get('courier_id');
        $courier = Couriers::find()->asArray()->where(['id' => $courier_id])->limit(1)->one();
        if ($courier['view'] != 1) {
            return $this->goBack();
        }
        $orders = Orders::find()->asArray()->with('operator')->where(['like', 'datetime', $date])->andWhere(['city_id' => $city_id, 'courier_id' => $courier_id, 'view' => 1])->all();
        // Count overall day stats
        $delivered_qty = 0;
        $not_delivered_qty = 0;
        $canceled_qty = 0;
        $cash = 0;
        $click = 0;

        foreach ($orders as $order) {
            if ($order['courier_id'] == $courier_id) {
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
        }
        $overall = $cash + $click;
        $cash = price_format($cash);
        $click = price_format($click);
        $overall = price_format($overall);
        return $this->render('daily-list', compact('orders', 'date', 'date_formated', 'delivered_qty', 'not_delivered_qty', 'canceled_qty', 'cash', 'click', 'overall', 'city', 'city_id', 'courier_routing', 'courier_id', 'courier'));
    }

    public function actionMonthlyList() {
        $request = Yii::$app->request;
        $city_id = $request->get('city');
        $courier = $request->get('courier');
        $couriers = Couriers::find()->asArray()->with('cities')->where(['city_id' => $city_id, 'id' => $courier])->all();
        $orders = Orders::find()->asArray()->with('manager')->where(['city_id' => $city_id, 'courier_id' => $courier, 'view' => 1])->all();
        $city = Cities::findOne($city_id);

        if (empty($couriers)) {
            return $this->redirect('/cities');
        }

        // Current month
        $current_month = date('m');
        $current_year = date('Y');
        $current_month_word = date('M');
        $today = date('d', time() + 18000);
        $current_month_days = [];
        $months_with_orders = [];
        array_push($current_month_days, $today);
        while ($today > 1) {
            $today--;
            if ($today < 10) {
                $today = 0 . $today;
            }
            array_push($current_month_days, $today);
        }

        foreach ($orders as $order) {
            $months_with_orders[cutMonth($order['datetime'])][$order['id']] = $order;
        }
        unset($months_with_orders[$current_month]);

        return $this->render('monthly-list',compact('couriers', 'orders', 'current_month', 'current_month_word', 'current_month_days', 'months_with_orders', 'current_year', 'city'));
    }

    public function actionMonthlyListCourier() {
        $request = Yii::$app->request;
        $city_id = $request->get('city');
        $courier_id = $request->get('courier');
        $couriers = Couriers::find()->asArray()->with('cities')->where(['city_id' => $city_id, 'view' => 1])->all();
        $orders = Orders::find()->asArray()->with('manager')->where(['courier_id' => $courier_id, 'city_id' => $city_id, 'view' => 1])->all();
        $city = Cities::findOne($city_id);

        // Current month
        $current_month = date('m');
        $current_year = date('Y');
        $current_month_word = date('M');
        $today = date('d', time() + 18000);
        $current_month_days = [];
        $months_with_orders = [];
        array_push($current_month_days, $today);
        while ($today > 1) {
            $today--;
            if ($today < 10) {
                $today = 0 . $today;
            }
            array_push($current_month_days, $today);
        }

        foreach ($orders as $order) {
            $months_with_orders[cutMonth($order['datetime'])][$order['id']] = $order;
        }
        unset($months_with_orders[$current_month]);

        // debug($couriers); die;
        return $this->render('monthly-list-courier', compact('couriers', 'orders', 'courier_id', 'city_id', 'current_month', 'current_month_word', 'current_month_days', 'months_with_orders', 'city', 'current_year'));
    }

}
