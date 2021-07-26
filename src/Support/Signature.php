<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Support;

use InvalidArgumentException;

/**
 * @author Sang Dang - Gem Four Media <gemfourmedia@gmail.com>
 * @since 1.0.0
 */
class Signature
{
    /**
     * Secret (ZaloPay use Key1).
     *
     * @var string
     */
    protected $hashSecret;

    /**
     * Hash algorithm
     *
     * @var string
     */
    protected $hashType;

    /**
     * Construct signature object
     *
     * @param  string  $hashSecret
     * @param  string  $hashType
     * @throws InvalidArgumentException
     */
    public function __construct(string $hashSecret, string $hashType = 'sha256')
    {
        if (! $this->isSupportHashType($hashType)) {
            throw new InvalidArgumentException(sprintf('Hash type: `%s` is not supported by ZaloPay', $hashType));
        }

        $this->hashType = $hashType;
        $this->hashSecret = $hashSecret;
    }

    /**
     * Generate mac string signature
     *
     * @param  array  $data
     * @return string
     */
    public function generate(string $data): string
    {
        return hash_hmac($this->hashType, $data, $this->hashSecret);
    }

    /**
     * Validate mac signature.
     *
     * @param  array  $data
     * @param  string  $expect
     * @return bool
     */
    public function validate(string $data, string $expect): bool
    {
        $actual = $this->generate($data);
        return 0 === strcasecmp($expect, $actual);
    }

    /**
     * Check hash algorithm supported by ZaloPay or Not.
     *
     * @param  string  $type
     * @return bool
     */
    protected function isSupportHashType(string $type): bool
    {
        return 0 === strcasecmp($type, 'md5') || 0 === strcasecmp($type, 'sha256');
    }
}
