<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message\Default;

use Omnipay\ZaloPay\Message\AbstractSignatureResponse as BaseAbstractSignatureResponse;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractSignatureResponse extends BaseAbstractSignatureResponse
{
    /**
     * Get return code from ZaloPay. 1 is success; 2 is cancelled; 3 is pending;
     *
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->data['return_code'] ?? null;
    }

    /**
     * Transaction ID use for reference
     *
     * @return null|string
     */
    public function getTransactionId(): ?string
    {
        return $this->data['zp_trans_token'] ?? null;
    }

    /**
     * Transaction ID use for reference
     *
     * @return null|string
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['zp_trans_token'] ?? null;
    }
}
