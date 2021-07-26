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
 */
class IncomingResponse extends AbstractSignatureResponse
{
	/**
     * When construct we already validated mac signature, if passt it'll always success
     */
    public function isSuccessful(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'data'
        ];
    }
    /**
     * {@inheritdoc}
     */
    protected function getSignatureChecksum(): string
    {
        return 'mac';
    }
}
