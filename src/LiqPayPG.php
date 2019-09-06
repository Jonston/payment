<?php

namespace Payment;

class LiqPayPG implements PaymentInterface{

    private $publicKey;

    private $privateKey;

    public function __construct($publicKey, $privateKey)
    {
        $this->publicKey = $publicKey;

        $this->privateKey = $privateKey;
    }

    public function createOrder($params)
    {
        $liqpay = new \LiqPay($this->publicKey, $this->privateKey);

        $response = $liqpay->api("request", array(
            'version'        => '3',
            'action'         => 'pay',
            'amount'         => $params['amount'],
            'currency'       => $params['currency'],
            'description'    => $params['description'],
            'order_id'       => $params['orderId']
        ));

        return $response;
    }

    public function getOrderStatus($params)
    {
        $liqpay = new \LiqPay($this->publicKey, $this->privateKey);

        $response = $liqpay->api("request", array(
            'version'       => '3',
            'action'        => 'status',
            'order_id'      => $params['orderId']
        ));

        return $response;
    }

    public function getOrders($params){
        $liqpay = new \LiqPay($this->publicKey, $this->privateKey);

        $response = $liqpay->api("request", array(
            'version'   => '3',
            'action'    => 'reports',
            'date_from' => $params['from'],
            'date_to'   => $params['to']
        ));

        return $response;
    }
}