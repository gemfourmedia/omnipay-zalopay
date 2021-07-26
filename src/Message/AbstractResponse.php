<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    use Concerns\ResponseProperties;

    /**
     * {@inheritdoc}
     */
    public function isSuccessful(): bool
    {
        return '1' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function isCancelled(): bool
    {
        return '2' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function isPending(): bool
    {
        return '3' === $this->getCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): ?string
    {
        return $this->data['return_message'] ?? null;
    }

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
