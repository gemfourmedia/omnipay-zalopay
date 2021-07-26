<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractIncomingRequest extends AbstractRequest
{

    protected $responseClass;
    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        foreach ($this->getIncomingParameters() as $parameter => $value) {
            $this->setParameter($parameter, $value);
        }

        return $this;
    }

	/**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data)
    {
        $responseClass = $this->responseClass;
        return $this->response = new $responseClass($this, $data);
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        call_user_func_array(
            [$this, 'validate'],
            array_keys($parameters = $this->getIncomingParameters())
        );

        return $parameters;
    }

    /**
     * Return parameters from ZaloPay callback API.
     *
     * @return array
     */
    abstract protected function getIncomingParameters(): array;

    /**
     * Return request parameter bag.
     *
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     */
    abstract protected function getIncomingParametersBag(): ParameterBag;
}
