<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractSignatureResponse extends AbstractResponse
{
    use Concerns\ResponseSignatureValidation;

    /**
     *
     * @param  \Omnipay\Common\Message\RequestInterface  $request
     * @param $data
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        // Validate 
        $this->validateSignature();

    }

}
