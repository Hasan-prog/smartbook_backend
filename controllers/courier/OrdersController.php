<?php

namespace app\controllers\courier;

// use app\controllers\AppController;
use yii\web\Controller;
use Yii;
use app\models\Orders;
use app\models\Couriers;

class OrdersController extends AppCourierController
{

    public function actionIndex() {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $status = Yii::$app->request->post('status');
            $courier_id = Yii::$app->request->post('courier_id');
            $order_str = Yii::$app->request->post('order_str');
            $model = Orders::findOne(['id' => $id, 'view' => 1]);
            $model->status = $status;

            // Edit how much the selected courier left
            if ($status == 'delivered') {
                $courier = Couriers::findOne($courier_id);
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

            $model->comment = Yii::$app->request->post('comment');
            $model->last_changed_time = date('Y-m-d h:i:s');
            $model->last_changed_user = Yii::$app->user->identity['name'];
            $model->save();

            // Decrease courier's qty_left on qty of the order
            
        }
        $this->layout = 'smartbook_courier';
        Yii::$app->language = 'uz';
        if (isset($_COOKIE['courier_id'])) {
            $courier_id = $_COOKIE['courier_id'];
        } else {
            return $this->redirect('/courier/orders/logout');
        }

        $orders = Orders::find()->asArray()->with('district')->where(['courier_id' => $courier_id, 'status' => 'not-delivered', 'view' => 1])->all();
        $dstr_arr = [];
        $d_arr = [];
        $no_dstr_orders = 0;
        function move_to_top(&$array, $key) {
            $temp = array($key => $array[$key]);
            unset($array[$key]);
            $array = $temp + $array;
        }

        $courier = Couriers::findOne($_COOKIE['courier_id']);
        $courier_dstr = explode(',', $courier['districts_id']);

        foreach ($orders as $key => $order) {
            $d['day'] = date('d', strtotime($order['datetime']));
            $d['month'] = date('M', strtotime($order['datetime']));
            $d['month_i'] = date('m', strtotime($order['datetime']));
            $d['year_i'] = date('Y', strtotime($order['datetime']));
            $d['datetime'] = $order['datetime'];
            array_push($d_arr, $d);

            if ($order['district'] != null && in_array($order['district_id'], $courier_dstr)) {
                $order['district']['qty'] = 1;
                array_push($dstr_arr, $order['district']);
            }
            // if ($order['district_id'] != '' && $order['district'] != null) {
            //     if (!isset($dstr_arr[$order['district']]) && isset($order['district']['id'])) {
            //         $dstr_arr[$order['district']['id']] = $order['district'];
            //         $dstr_arr[$order['district']['id']]['qty'] = 1;
            //     } else {
            //         if (isset($order['district']['id'])) {
            //             $dstr_arr[$order['district']['id']]['qty'] += 1;   
            //         }
            //     }
            // } else {
            //     // the order doesn't have district   
            // }
            $no_dstr_orders++;
        }


        $i = 0;
        foreach ($dstr_arr as $key => $dstr) {
            foreach ($dstr_arr as $key_2 => $dstr_2) {
                if ($dstr['id'] == $dstr_2['id']) {
                    $dstr_arr[$key]['qty']++;
                }
            }
            $dstr_arr[$key]['qty']--;
        }

        $dstr_arr = array_unique($dstr_arr, SORT_REGULAR);

        usort($d_arr, function($a, $b) {
        $ad = $a['datetime'];
        $bd = $b['datetime'];

        if ($ad == $bd) {
            return 0;
        }

        return $ad < $bd ? -1 : 1;
        });
        // debug($d_arr); die;


        return $this->render('current-orders', compact('orders', 'd_arr', 'dstr_arr', 'no_dstr_orders'));
    }

    public function actionMonthlyList() {
        $this->layout = 'smartbook_courier';
        if (isset($_COOKIE['courier_id'])) {
            $courier_id = $_COOKIE['courier_id'];
        } else {
            return $this->redirect('/courier/orders/logout');
        }

        $months = [];
        $months_list = [];
        $orders = Orders::find()->asArray()->where(['courier_id' => $courier_id, 'view' => 1])->all();
        foreach ($orders as $key => $order) {
            $months[cutMonth($order['datetime'])][$key] = $order;
            $months_list[$key] = date('M', strtotime($order['datetime'])) . ', ' . date('Y', strtotime($order['datetime']));
        }
        $months_list = array_unique($months_list);
        asort($months_list);
        rsort($months);


        return $this->render('monthly-list', compact('months', 'months_list'));
    }
    
    public function actionDailyList() {
        $this->layout = 'smartbook_courier';

        if (isset($_COOKIE['courier_id'])) {
            $courier_id = $_COOKIE['courier_id'];
        } else {
            return $this->redirect('/courier/orders/logout');
        }

        $d = Yii::$app->request->get('d');
        $orders = Orders::find()->asArray()->where(['like', 'datetime', $d])->andWhere(['courier_id' => $courier_id, 'view' => 1])->all();
        if (empty($orders)) {
            return $this->redirect('/courier/orders/monthly-list');
        }

        return $this->render('daily-list', compact('orders'));
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        setcookie("role", "", time() - 3600);
        setcookie("courier_id", "", time() - 3600);

        return $this->redirect(['/site/login']);
    }

}
