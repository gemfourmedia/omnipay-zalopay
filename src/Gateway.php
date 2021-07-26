<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\ZaloPay\Message\PurchaseRequest;
use Omnipay\ZaloPay\Message\CompletePurchaseRequest;
use Omnipay\ZaloPay\Message\QueryTransactionRequest;
use Omnipay\ZaloPay\Message\NotificationRequest;
// use Omnipay\ZaloPay\Message\ZalopayGateway\RefundRequest;
// use Omnipay\ZaloPay\Message\ZalopayGateway\QueryRefundRequest;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
class Gateway extends AbstractGateway
{
    use Concerns\Parameters;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'ZaloPay';
    }

    /**
     * Create order request to ZaloPay Server
     * @return \Omnipay\Common\Message\RequestInterface|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Validate order status from ZaloPay Server to complete purchase
     *
     * @return \Omnipay\Common\Message\RequestInterface|CompletePurchaseRequest
     */
    public function completePurchase(array $options = []): CompletePurchaseRequest
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    /**
     * Handle Zalo Callback (IPN)
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|NotificationRequest
     */
    public function notification(array $options = []): NotificationRequest
    {
        return $this->createRequest(NotificationRequest::class, $options);
    }

    /**
     * Create order query request to ZaloPay Server
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|QueryTransactionRequest
     */
    public function queryTransaction(array $options = []): QueryTransactionRequest
    {
        return $this->createRequest(QueryTransactionRequest::class, $options);
    }

    /**
     * Create refund request to ZaloPay Server
     *
     * @return \Omnipay\Common\Message\RequestInterface|RefundRequest
     */
    public function refund(array $options = [])
    {
        // return $this->createRequest(RefundRequest::class, $options);
    }

    /**
     * Create refund query request to ZaloPay Server
     *
     * @return \Omnipay\Common\Message\RequestInterface|QueryRefundRequest
     */
    public function queryRefund(array $options = [])
    {
        // return $this->createRequest(QueryRefundRequest::class, $options);
    }
}
