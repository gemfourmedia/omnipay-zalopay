<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     * {@inheritdoc}
     */
    public function isRedirect(): bool
    {
        return isset($this->data['order_url']);
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl(): string
    {
        return $this->data['order_url'];
    }

}
