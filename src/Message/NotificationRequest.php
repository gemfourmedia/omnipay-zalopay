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
class NotificationRequest extends AbstractIncomingRequest
{

    protected $responseClass = IncomingResponse::class;
    /**
     * {@inheritdoc}
     */
    protected function getIncomingParameters(): array
    {
        $data = [];
        $params = [
            'data', 'mac', 'type'
        ];
        $bag = $this->getIncomingParametersBag();

        foreach ($params as $param) {
            $data[$param] = $bag->get($param);
        }
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    protected function getIncomingParametersBag(): ParameterBag
    {
    	if (0 === strpos($this->httpRequest->headers->get('Content-Type'), 'application/json')) {
        	return new ParameterBag(json_decode($this->httpRequest->getContent(), true));
    	}
    	return $this->httpRequest->request;
    }
}
