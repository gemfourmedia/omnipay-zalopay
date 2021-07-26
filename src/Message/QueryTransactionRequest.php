<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

/**
 * @link https://docs.zalopay.vn/v2/general/overview.html#truy-van-trang-thai-thanh-toan-cua-don-hang
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
class QueryTransactionRequest extends AbstractSignatureRequest
{
    protected $testEndpoint = 'https://sb-openapi.zalopay.vn/v2/query';

    protected $productionEndpoint = 'https://openapi.zalopay.vn/v2/query';

    /**
     * {@inheritdoc}
     */
    protected $responseClass = QueryTransactionResponse::class;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        
        $this->setAppTransId($this->getParameter('app_trans_id') ?? null);

        return $this;
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
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'app_id', 'app_trans_id', 'key1'
        ];
    }
}
