<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message\Concerns;

use Omnipay\ZaloPay\Support\Arr;
use Omnipay\ZaloPay\Support\Signature;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
trait ResponseSignatureValidation
{
    /**
     * Validate checksum from ZaloPay
     *
     * @throws InvalidResponseException
     */
    protected function validateSignature(): void
    {
        $data = $this->getData();

        if (! isset($data['checksum'])) {
            throw new InvalidResponseException(sprintf('Response from ZaloPay is invalid!'));
        }

        $dataSignature = [];
        $signature = new Signature(
            $this->getRequest()->getKey2()
        );

        foreach ($this->getSignatureParameters() as $pos => $parameter) {
            if (! is_string($pos)) {
                $pos = $parameter;
            }

            $dataSignature[$pos] = Arr::getValue($parameter, $data);
        }

        if (! $signature->validate($dataSignature, $data['checksum'])) {
            throw new InvalidResponseException(sprintf('Data signature response from ZaloPay is invalid!'));
        }
    }

    /**
     * Return parameters use for generate Checksum
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;
}
