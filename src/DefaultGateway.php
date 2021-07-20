<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\ZaloPay\Message\Default\PurchaseRequest;
use Omnipay\ZaloPay\Message\Default\CompletePurchaseRequest;
// use Omnipay\ZaloPay\Message\Default\RefundRequest;
// use Omnipay\ZaloPay\Message\Default\QueryRefundRequest;
// use Omnipay\ZaloPay\Message\Default\NotificationRequest;
// use Omnipay\ZaloPay\Message\Default\QueryTransactionRequest;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
class DefaultGateway extends AbstractGateway
{
    use Concerns\Parameters;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'ZaloPay - Default';
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\RequestInterface|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\RequestInterface|CompletePurchaseRequest
     */
    public function completePurchase(array $options = []): CompletePurchaseRequest
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    /**
     * Tạo request notification gửi từ MoMo.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|NotificationRequest
     */
    // public function notification(array $options = []): NotificationRequest
    public function notification(array $options = [])
    {
        // return $this->createRequest(NotificationRequest::class, $options);
    }

    /**
     * Tạo yêu cầu truy vấn thông tin giao dịch đến MoMo.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|QueryTransactionRequest
     */
    public function queryTransaction(array $options = []): QueryTransactionRequest
    {
        // return $this->createRequest(QueryTransactionRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\RequestInterface|RefundRequest
     */
    public function refund(array $options = [])
    {
        // return $this->createRequest(RefundRequest::class, $options);
    }

    /**
     * Tạo yêu cầu truy vấn thông tin hoàn tiền đến MoMo.
     *
     * @return \Omnipay\Common\Message\RequestInterface|QueryRefundRequest
     */
    public function queryRefund(array $options = [])
    {
        // return $this->createRequest(QueryRefundRequest::class, $options);
    }
}
