<?php

namespace Payment;

interface PaymentInterface{
    public function createOrder($params);

    public function getOrderStatus($params);
}