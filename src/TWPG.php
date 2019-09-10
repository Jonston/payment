<?php

namespace jonston\Payment;

use num8er\TranzWarePaymentGateway\CurrencyCodes;
use num8er\TranzWarePaymentGateway\TranzWarePaymentGatewayRequestFactory;

class TWPG implements PaymentInterface{

    private $requestFactory;

    public function __construct($url, $merchantId, $approveUrl, $declineUrl, $cancelUrl, $lang = 'EN')
    {
        $this->requestFactory = new TranzWarePaymentGatewayRequestFactory(
            $url, $merchantId, $approveUrl, $declineUrl, $cancelUrl, $lang
        );
    }

    public function setCertificate($cert, $key, $pass){
        $this->requestFactory->setCertificate($cert, $key, $pass);
    }

    public function setDebugFile($file){
        $this->requestFactory->setDebugFile($file);
    }

    public function createOrder($params)
    {
        $orderRequest = $this->requestFactory->createOrderRequest(
            $params['amount'],
            $params['currency'],
            $params['description']
        );
        $orderRequestResult = $orderRequest->execute();

        if($orderRequestResult->success())
            return $orderRequestResult->getData();

        return false;
    }

    public function getOrderStatus($params)
    {
        $orderStatusRequest = $this->requestFactory->createOrderStatusRequest(
            $params['orderId'],
            $params['sessionId']
        );

        $orderStatusResult = $orderStatusRequest->execute();

        if($orderStatusResult->success())
            return $orderStatusResult->getData();

        return false;
    }
}