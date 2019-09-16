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

    const CURRENCY_JPY_STR = 'JPY';
    const CURRENCY_KZT_STR = 'KZT';
    const CURRENCY_LVL_STR = 'LVL';
    const CURRENCY_RUR_STR = 'RUR';
    const CURRENCY_GBP_STR = 'GBP';
    const CURRENCY_USD_STR = 'USD';
    const CURRENCY_AZN_STR = 'AZN';
    const CURRENCY_BYR_STR = 'BYR';
    const CURRENCY_BGN_STR = 'BGN';
    const CURRENCY_EUR_STR = 'EUR';
    const CURRENCY_UAH_STR = 'UAH';
    const CURRENCY_GEL_STR = 'GEL';
    const CURRENCY_PLN_STR = 'PLN';

    private $currencies = [
        self::CURRENCY_JPY => self::CURRENCY_JPY_STR,
        self::CURRENCY_KZT => self::CURRENCY_KZT_STR,
        self::CURRENCY_LVL => self::CURRENCY_LVL_STR,
        self::CURRENCY_RUR => self::CURRENCY_RUR_STR,
        self::CURRENCY_GBP => self::CURRENCY_GBP_STR,
        self::CURRENCY_USD => self::CURRENCY_USD_STR,
        self::CURRENCY_AZN => self::CURRENCY_AZN_STR,
        self::CURRENCY_BYR => self::CURRENCY_BYR_STR,
        self::CURRENCY_BGN => self::CURRENCY_BGN_STR,
        self::CURRENCY_EUR => self::CURRENCY_EUR_STR,
        self::CURRENCY_UAH => self::CURRENCY_UAH_STR,
        self::CURRENCY_GEL => self::CURRENCY_GEL_STR,
        self::CURRENCY_PLN => self::CURRENCY_PLN_STR
    ];

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