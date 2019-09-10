<?php

namespace jonston\Payment;

interface PaymentInterface{
    public function createOrder($params);

    public function getOrderStatus($params);
}