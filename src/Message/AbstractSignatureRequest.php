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
abstract class AbstractSignatureRequest extends AbstractRequest
{
    use Concerns\RequestEndpoint;
    use Concerns\RequestSignature;

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $parameters = $this->getParameters();
        call_user_func_array(
            [$this, 'validate'],
            $this->getSignatureParameters()
        );
        $parameters['mac'] = $this->generateSignature();
        unset($parameters['key1'], $parameters['testMode'], $parameters['app_id']);

        return $parameters;
    }
}
