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
     * Response Class.
     *
     * @var string
     */
    protected $responseClass;


    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data)
    {

        $response = $this->httpClient->request('POST', $this->getEndpoint(), [
            'Content-Type' => 'application/json; charset=UTF-8',
        ], json_encode($data));


        $responseClass = $this->responseClass;
        $responseData = $response->getBody()->getContents();

        return $this->response = new $responseClass($this, json_decode($responseData, true) ?? []);
    }

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
        unset($parameters['key1'], $parameters['key2'], $parameters['testMode']);

        return $parameters;
    }
}
