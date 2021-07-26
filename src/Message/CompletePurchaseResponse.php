<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

/**
 * @link https://docs.zalopay.vn/v2/docs/gateway/api.html#redirect_du-lieu-truyen-vao-query-string-khi-zalopay-redirect-ve-trang-cua-merchant
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
class CompletePurchaseResponse extends AbstractSignatureResponse
{
	/**
     * Override parent method getCode()
     * ZaloPay Redirect use "status" instead of "return_code"
     *
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->data['status'] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'appid', 'apptransid', 'pmcid', 'bankcode', 'amount', 'discountamount', 'status'
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureChecksum(): string
    {
        return 'checksum';
    }
}
