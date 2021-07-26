<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @link https://docs.zalopay.vn/v2/docs/gateway/api.html#redirect_du-lieu-truyen-vao-query-string-khi-zalopay-redirect-ve-trang-cua-merchant
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
class CompletePurchaseRequest extends AbstractIncomingRequest
{
    protected $responseClass = CompletePurchaseResponse::class;

	/**
     * {@inheritdoc}
     */
    protected function getIncomingParameters(): array
    {
        $data = [];
        $params = [
            'appid', 'apptransid', 'pmcid', 'bankcode', 'amount', 'discountamount', 'status', 'checksum'
        ];
        $bag = $this->getIncomingParametersBag();

        foreach ($params as $param) {
            $data[$param] = $bag->get($param);
        }
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    protected function getIncomingParametersBag(): ParameterBag
    {
        return $this->httpRequest->query;
    }
}
