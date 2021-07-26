<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Message\Concerns;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
trait RequestEndpoint
{

    /**
     * @var string
     */
    protected $productionEndpoint;

    /**
     * @var string
     */
    protected $testEndpoint;

    /**
     * Return current api endpoint
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->productionEndpoint;
    }
}
