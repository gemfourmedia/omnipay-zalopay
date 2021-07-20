<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Concerns;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
trait Parameters
{

    /**
     * Get app_id provided by Zalo
     *
     * @return null|string
     */
    public function getAppId(): ?string
    {
        return $this->getParameter('app_id');
    }

    /**
     * Set app_id provied by Zalo
     *
     * @param  null|string  $code
     * @return $this
     */
    public function setAppId(?string $code)
    {
        return $this->setParameter('app_id', $code);
    }

    /**
     * Get key1 provided by Zalo (Key1 use for mac hash)
     *
     * @return null|string
     */
    public function getKey1(): ?string
    {
        return $this->getParameter('key1');
    }

    /**
     * Set key1 provied by Zalo
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setKey1(?string $key)
    {
        return $this->setParameter('key1', $key);
    }

    /**
     * Get key2 provided by Zalo (Key 2 Use for validate Callback)
     *
     * @return null|string
     */
    public function getKey2(): ?string
    {
        return $this->getParameter('key2');
    }

    /**
     * Set key2 provied by Zalo
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setKey2(?string $key)
    {
        return $this->setParameter('key2', $key);
    }

    /**
     * Get app_user provided by Zalo
     *
     * @return null|string
     */
    public function getAppUser(): ?string
    {
        return $this->getParameter('app_user');
    }

    /**
     * Set app_user provied by Zalo
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setAppUser(?string $key)
    {
        return $this->setParameter('app_user', $key);
    }

   
}
