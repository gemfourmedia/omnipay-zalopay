<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message\Concerns;

use Omnipay\ZaloPay\Support\Signature;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
trait RequestSignature
{
    /**
     * Generate mac
     *
     * @param  string  $hashType
     * @return string
     */
    protected function generateSignature(string $hashType = 'sha256'): string
    {
        $data = [];

        $signature = new Signature(
            $this->getKey1(),
            $hashType
        );

        foreach ($this->getSignatureParameters() as $parameter) {
            $data[$parameter] = $this->getParameter($parameter);
        }

        return $signature->generate(implode('|', $data));
    }

    /**
     * Return parameters using for generate mac signature
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;
}
