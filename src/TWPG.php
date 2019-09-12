<?php

namespace jonston\Payment;

use num8er\TranzWarePaymentGateway\CurrencyCodes;
use num8er\TranzWarePaymentGateway\TranzWarePaymentGatewayRequestFactory;

class TWPG implements PaymentInterface{

    const ORDER_STATUS_CREATED          = 'CREATED';
    const ORDER_STATUS_ON_PAYMENT       = 'ON-PAYMENT';
    const ORDER_STATUS_ON_LOCK          = 'ON-LOCK';
    const ORDER_STATUS_APPROVED         = 'APPROVED';
    const ORDER_STATUS_CANCELED         = 'CANCELED';
    const ORDER_STATUS_DECLINED         = 'DECLINED';
    const ORDER_STATUS_ON_REFUND        = 'ON-REFUND';
    const ORDER_STATUS_REFUNDED         = 'REFUNDED';
    const ORDER_STATUS_PREAUTH_APPROVED = 'PREAUTH-APPROVED';
    const ORDER_STATUS_EXPIRED          = 'EXPIRED';
    const ORDER_STATUS_ERROR            = 'ERROR';

    const CURRENCY_JPY = 392;
    const CURRENCY_KZT = 398;
    const CURRENCY_LVL = 428;
    const CURRENCY_RUR = 810;
    const CURRENCY_GBP = 826;
    const CURRENCY_USD = 840;
    const CURRENCY_AZN = 944;
    const CURRENCY_BYR = 974;
    const CURRENCY_BGN = 975;
    const CURRENCY_EUR = 978;
    const CURRENCY_UAH = 980;
    const CURRENCY_GEL = 981;
    const CURRENCY_PLN = 985;

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