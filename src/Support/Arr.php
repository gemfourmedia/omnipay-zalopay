<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-zalopay
 *
 * @copyright (c) Gem Four Media
 * @license [MIT](https://opensource.org/licenses/MIT)
 */

namespace Omnipay\ZaloPay\Support;

class Arr
{
    /**
     * Array Dots getting support
     *
     * @param  mixed  $element
     * @param  array  $arr
     * @param  null  $default
     * @return mixed
     */
    public static function getValue($element, array $arr, $default = null)
    {
        while (false !== ($pos = strpos($element, '.'))) {
            $sub = substr($element, 0, $pos);
            $element = substr($element, $pos + 1);

            if (isset($arr[$sub]) && is_array($arr[$sub])) {
                $arr = $arr[$sub];
            } else {
                break;
            }
        }

        if (false === strpos($element, '.')) {
            return $arr[$element] ?? $default;
        }

        return $default;
    }
}
