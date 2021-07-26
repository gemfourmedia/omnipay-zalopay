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
     * Validate mac from ZaloPay IPN|redirect
     *
     * @throws InvalidResponseException
     */
    protected function validateSignature(): void
    {
        $data = $this->getData();

        // $dataSignature = Arr::getValue('data', $data, null);
        // $macSignature = Arr::getValue('mac', $data, null);
        
        // Get checksum|mac from ZaloPay reponse
        $macSignature = Arr::getValue($this->getSignatureChecksum(), $data, '');

        // Get valid field use for generate checksum|mac using for validate
        $dataSignature = [];
        foreach ($this->getSignatureParameters() as $parameter) {
            $dataSignature[$parameter] = Arr::getValue($parameter, $data, null);
        }

        if (!$macSignature || !$dataSignature) {
            throw new InvalidResponseException(sprintf('Response from ZaloPay is invalid!'));
        }

        $signature = new Signature(
            $this->getRequest()->getKey2()
        );

        // Zalopay IPN use 'mac'; Zalopay Redirect use 'checksum' => Stupid!!!
        $generatedSignature = ($this->getSignatureChecksum() === 'checksum') 
                            ? implode('|', $dataSignature) 
                            : Arr::getValue('data', $dataSignature, '');
                            
        if (! $signature->validate($generatedSignature, $macSignature)) {
            throw new InvalidResponseException(sprintf('Data signature response from ZaloPay is invalid!'));
        }
    }


    /**
     * Return parameters use for generate signature
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;


    /**
     * Return parameters use for validate
     *
     * @return array
     */
    abstract protected function getSignatureChecksum(): string;
}
