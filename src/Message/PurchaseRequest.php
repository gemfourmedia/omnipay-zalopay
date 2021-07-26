<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 *
 * //Init gateway example:
 * $gateway = $gateway = Omnipay::create('ZaloPay_Default');
 * $gateway->initialize([
 *  'app_id' => 'Provided by ZaloPay',
 *  'key1' => 'Provided by ZaloPay',
 *  'key2' => 'Provided by ZaloPay',
 *  'app_user' => 'Identify of customer like id/username/name/phone/email, ...; Eg: guest',
 * ]);
 *
 * // Create order request
 * Detail at https://docs.zalopay.vn/v2/general/overview.html#tao-don-hang_thong-tin-don-hang
 * $response = $gateway->purchase([
 *  // Required parameters
 *  'app_trans_id' => date('ymd').$order->id,
 *  'app_time' => microtime(false),
 *  'amount' => $order->amount, //Eg: 1000000
 *  'description' => 'Gem Four Media - Payment for order No.#123456',
 *  'item' => $order->products->pluck('item_id', 'item_name', 'item_price', 'item_quantity')->toJson(),
 *  'embed_data' => json_encode([]),
 *  'bank_code' => '', //''|CC|ATM|Domestic bank code detail at https://docs.zalopay.vn/v2/docs/gateway/api.html#mo-ta_dac-ta-api
 *  
 *  // Optional parameters
 *  'order_type' => 'GOODS', // can be:GOODS/TRANSPORTATION/HOTEL/FOOD/TELCARD/BILLING
 *  'title' => 'Order Title',
 *  'callback_url' => 'https://gemfourmedia.com/callback',
 *  'device_info' => json_encode([]),
 *  'currency' => 'VND',
 *  'phone' => '0902381299',
 *  'email' => 'gemfourmedia@gmail.com',
 *  'address' => '123 Alexandre Rodes',
 *  'sub_app_id' => '',
 * ]);
 *
 */
class PurchaseRequest extends AbstractSignatureRequest
{
    protected $testEndpoint = 'https://sb-openapi.zalopay.vn/v2/create';

    protected $productionEndpoint = 'https://openapi.zalopay.vn/v2/create';
    
    /**
     * {@inheritdoc}
     */
    protected $responseClass = PurchaseResponse::class;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        $this->setOrderType($this->getParameter('order_type') ?? 'GOODS');
        $this->setDeviceInfo($this->getParameter('device_info') ?? "{}");
        $this->setItem($this->getParameter('item') ?? json_encode([]));
        
        $this->setCurrency($this->getParameter('currency') ?? 'VND');
        $this->setEmbedData($this->getParameter('embed_data') ?? "{}");
        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getAppTime(): ?int
    {
        return $this->getParameter('app_time');
    }

    public function setAppTime(?int $data)
    {
        return $this->setParameter('app_time', $data);
    }

    public function getOrderType(): ?string
    {
        return $this->getParameter('order_type');
    }

    public function setOrderType(?string $data)
    {
        return $this->setParameter('order_type', $data);
    }

    public function getDeviceInfo(): ?string
    {
        return $this->getParameter('device_info');
    }

    public function setDeviceInfo(?string $data)
    {
        return $this->setParameter('device_info', $data);
    }

    public function getItem(): ?string
    {
        return $this->getParameter('item');
    }

    public function setItem(?string $data)
    {
        return $this->setParameter('item', $data);
    }

    public function getCurrency(): ?string
    {
        return $this->getParameter('currency');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function getBankCode(): ?string
    {
        return $this->getParameter('bank_code');
    }

    public function setBankCode(?string $data)
    {
        return $this->setParameter('bank_code', $data);
    }

    /**
     * Get Embed Data for ZaloPay.
     *
     * @return null|string
     */
    public function getEmbedData(): ?string
    {
        return $this->getParameter('embed_data');
    }

    /**
     * Set Embed Data for ZaloPay.
     *
     * @param  null|string  $data
     * @return $this
     */
    public function setEmbedData(?string $data)
    {
        return $this->setParameter('embed_data', $data);
    }

    /**
     * Get App transaction ID
     *
     * @return null|string
     */
    public function getAppTransId(): ?string
    {
        return $this->getParameter('app_trans_id');
    }

    /**
     * Set App transaction ID
     *
     * @param  null|string  $id
     * @return $this
     */
    public function setAppTransId(?string $id)
    {
        return $this->setParameter('app_trans_id', $id);
    }

    /**
     * @return null|string
     */
    public function getCallbackUrl(): ?string
    {
        return $this->getReturnUrl();
    }

    /**
     * @param  null|string  $url
     * @return $this
     */
    public function setCallbackUrl(?string $url)
    {
        return $this->setReturnUrl($url);
    }

    /**
     * {@inheritdoc}
     */
    public function getReturnUrl(): ?string
    {
        return $this->getParameter('callback_url');
    }

    /**
     * {@inheritdoc}
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('callback_url', $value);
    }

    /**
     * Define fields use for generate mac (sinature)
     */
    protected function getSignatureParameters(): array
    {
        return [
            'app_id', 'app_trans_id', 'app_user', 'amount', 'app_time', 'embed_data', 'item'
        ];
    }
}
