<?php


namespace app\services;

use GuzzleHttp\Client;
use Yii;
use yii\helpers\Json;

/**
 * Class PayKeeper
 * @package common\services
 *
 * @property array token
 */
class PayKeeperApi
{

    // region statuses
    /**
     * @var string STATUS_PENDING
     */
    public const STATUS_PENDING            = 'pending';

    /**
     * @var string STATUS_OBTAINED
     */
    public const STATUS_OBTAINED           = 'obtained';

    /**
     * @var string STATUS_CANCELED
     */
    public const STATUS_CANCELED           = 'canceled';

    /**
     * @var string STATUS_SUCCESS
     */
    public const STATUS_SUCCESS            = 'success';

    /**
     * @var string STATUS_FAILED
     */
    public const STATUS_FAILED             = 'failed';

    /**
     * @var string STATUS_STUCK
     */
    public const STATUS_STUCK              = 'stuck';

    /**
     * @var string STATUS_REFUNDED
     */
    public const STATUS_REFUNDED           = 'refunded';

    /**
     * @var string STATUS_REFUNDING
     */
    public const STATUS_REFUNDING          = 'refunding';

    /**
     * @var string STATUS_PARTIALLY_REFUNDED
     */
    public const STATUS_PARTIALLY_REFUNDED = 'partially_refunded';
    //endregion

    /**
     * @var Client $client
     */
    private $client;

    /**
     * PayKeeper constructor.
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Get correct token from PayKeeper
     *
     * @return array|bool
     */
    public function getToken()
    {
        $response = $this->client->get(Yii::$app->params['paykeeper']['domain'].'/info/settings/token',[
            'auth' => [
                Yii::$app->params['paykeeper']['user'],
                Yii::$app->params['paykeeper']['password']
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
        if($response->getStatusCode() === 200) {
            return Json::decode($response->getBody()->getContents())['token'];
        }

        return false;
    }

    /**
     * @param string $client_id
     * @param string $client_email
     * @param string $service_name
     * @param int $order_id
     * @param float $order_sum
     * @param string $phone
     * @return array
     */
    public function getPayLink(string $client_id, string $client_email, string $service_name, int $order_id, float $order_sum, $phone = '') {

        $response = $this->client->post(Yii::$app->params['paykeeper']['domain'].'/change/invoice/preview/', [
            'auth' => [
                Yii::$app->params['paykeeper']['user'],
                Yii::$app->params['paykeeper']['password']
            ],
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'pay_amount' => $order_sum,
                'clientid' => $client_id,
                'orderid' => $order_id,
                'client_email' => $client_email,
                'service_name' => $service_name,
                'client_phone' => $phone,
                'token' => $this->getToken()
            ]
        ]);

        $result = $response->getBody()->getContents();

        return self::requestHelper($response->getStatusCode(), $result);
    }

    /**
     * @param string $client_id
     * @param float $order_sum
     * @return array
     */
    public function getCreate(string $client_id, float $order_sum) {

        $response = $this->client->post(Yii::$app->params['paykeeper']['domain'].'/create', [
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'sum' => $order_sum,
                'clientid' => $client_id,
            ]
        ]);

        echo $response->getBody()->getContents();
    }

    /**
     * @param int $invoice_id
     * @return array
     */
    public function getInvoiceInfo(int $invoice_id) {
        $response = $this->client->get(Yii::$app->params['paykeeper']['domain'].'/info/invoice/byid/', [
            'auth' => [
                Yii::$app->params['paykeeper']['user'],
                Yii::$app->params['paykeeper']['password']
            ],
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'query' => [
                'id' => $invoice_id,
            ]
        ]);

        $body = $response->getBody()->getContents();

        return self::requestHelper($response->getStatusCode(), $body);
    }

    /**
     * @param $id
     * @param int $amount
     * @param bool $partial
     * @param $token
     * @param $refund_cart
     * @return mixed
     */
    public function reverse($id, $token, $refund_cart, $amount = 0, $partial = false)
    {
        $response = $this->client->post(Yii::$app->params['paykeeper']['domain'].'/change/payment/reverse/', [
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form-params' => [
                'id' => $id,
                'amount' => $amount,
                'partial'   => $partial,
                'token' => $token,
                'refund_cart' => $refund_cart
            ]
        ]);

        return self::requestHelper($response->getStatusCode(), $response->getBody()->getContents());
    }

    /**
     * Get the payment by id
     *
     * @param int $id
     * @return mixed
     */
    public function getPaymentById(int $id)
    {
        $response = $this->client->get(Yii::$app->params['paykeeper']['domain'].'/info/payments/byid/', [
            'auth' => [ Yii::$app->params['paykeeper']['user'], Yii::$app->params['paykeeper']['password'] ],
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
            ],
            'query' => [
                'id' => $id
            ]
        ]);

        return self::requestHelper($response->getStatusCode(), $response->getBody()->getContents());
    }

    /**
     * Additional info of the payment by id
     *
     * @param integer $id
     * @return mixed
     */
    public function getPaymentAdditionalById(int $id)
    {
        $response = $this->client->get(Yii::$app->params['paykeeper']['domain'].'/info/options/byid/', [
            'auth' => [ Yii::$app->params['paykeeper']['user'], Yii::$app->params['paykeeper']['password'] ],
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
            ],
            'query' => [
                'id' => $id
            ]
        ]);

        return self::requestHelper($response->getStatusCode(), $response->getBody()->getContents());
    }

    /**
     * Request information on refunds for the payment by id
     *
     * @param integer $id
     * @return mixed
     */
    public function getRefundsById(int $id)
    {
        $response = $this->client->get(Yii::$app->params['paykeeper']['domain'].'/info/refunds/bypaymentid/', [
            'auth' => [ Yii::$app->params['paykeeper']['user'], Yii::$app->params['paykeeper']['password'] ],
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
            ],
            'query' => [
                'id' => $id
            ]
        ]);

        return self::requestHelper($response->getStatusCode(), $response->getBody()->getContents());
    }

    /**
     * @param $status
     * @param $body
     * @return array
     */
    private static function requestHelper($status, $body)
    {
        $body = Json::decode($body) ?? $body;
        return ['status' => $status, 'body' => $body];
    }
}
