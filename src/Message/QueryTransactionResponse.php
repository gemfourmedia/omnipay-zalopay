<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

/**
 * @link https://docs.zalopay.vn/v2/general/overview.html#truy-van-trang-thai-thanh-toan-cua-don-hang_dac-ta-api_tham-so-api-tra-ve
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
class QueryTransactionResponse extends AbstractResponse
{
    /**
     * Transaction ID use for reference
     *
     * @return null|string
     */
    public function getTransactionId(): ?string
    {
        return $this->data['zp_trans_id'] ?? null;
    }

    /**
     * Transaction ID use for reference
     *
     * @return null|string
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['zp_trans_id'] ?? null;
    }
}
