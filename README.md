# omnipay-zalopay
ZaloPay gateway for [Omnipay League](https://github.com/thephpleague/omnipay).

## Installation

WIP: via [Composer](https://getcomposer.org):

```bash
composer require gemfourmedia/omnipay-zalopay
```
## Usage

### Init gateway:

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('ZaloPay');
$gateway->initialize([
    'app_user' => 'Your App Name',
    'app_id' => 'Provided by ZaloPay',
    'key1' => 'Provided by ZaloPay',
    'key2' => 'Provided by ZaloPay',
    'testMode' => true // 'Enable sandbox mode',
]);
```

This gateway object will use to handle request/response from ZaloPay

### Create Purchase:

```php
$appTime = floor(microtime(true) * 1000);
$appTransId = date('ymd').$this->order->order_number.$appTime;

$response =  $gateway->purchase([
    // Required parameters
    'app_trans_id' => $appTransId,
    'app_time' => $appTime,
    'amount' => $order->amount, //Eg: 1000000
    'description' => 'YOUR APP - Payment for order No. #'.$order->order_number,
    'item' => json_encode([]),
    'embed_data' => json_encode((object)['redirecturl' => 'https://your-domain.com/callback_url']),
    'bank_code' => '', //''|CC|ATM|Domestic bank code detail at https://docs.zalopay.vn/v2/docs/gateway/api.html#mo-ta_dac-ta-api
    'returnUrl'    => 'https://your-domain.com/callback_listener', // This will assign to callback_url is use by ZaloPay
    
    // Optional parameters
    'order_type' => 'GOODS', // can be:GOODS/TRANSPORTATION/HOTEL/FOOD/TELCARD/BILLING
    'title' => 'Order Title',
    'device_info' => json_encode([]),
    'currency' => 'VND',
    'phone' => '0902381299',
    'email' => 'gemfourmedia@gmail.com',
    'address' => '123 Alexandre De Rhodes',
    'sub_app_id' => '',
])->send();

if ($response->isRedirect()) {
    $redirectUrl = $response->getRedirectUrl();
    
    // TODO: redirect to $redirectUrl for customer can make payment via ZaloPay
}
```

Read more detail [here](https://docs.zalopay.vn/v2/general/overview.html#tao-don-hang_thong-tin-don-hang).

### Validate ZaloPay redirect:

```php
$response = $gateway->completePurchase()->send();

if ($response->isSuccessful()) {
    // TODO: Handle data.
    $data = $response->getData();
    $appTransId = $data['apptransid'];

    // SUGGESTION: do query transaction to make sure transaction is successful:
    // $gateway()->queryTransaction(['app_trans_id' => $appTransId])->send()
    
} else {

    print $response->getMessage();
}
```

Read more detail [here](https://docs.zalopay.vn/v2/docs/gateway/api.html#redirect).

### Check callback (IPN) from ZaloPay

```php
$response = $gateway->notification()->send();

if ($response->isSuccessful()) {
	// TODO: Handle data.
	$data = $response->getData();
} else {
	print $response->getMessage();
}

```

Read more detail [here](https://docs.zalopay.vn/v2/general/overview.html#callback_dac-ta-api).

### Query transaction:

```php
$gateway()->queryTransaction(['app_trans_id' => $appTransId])->send()

if ($response->isSuccessful()) {
    // TODO: handle data.
    $data = $response->getData()
    
} else {
    print $response->getMessage();
}
```

Read more detail [here](https://docs.zalopay.vn/v2/general/overview.html#truy-van-trang-thai-thanh-toan-cua-don-hang_dac-ta-api_du-lieu-truyen-vao-api).

### Refund:

WIP

### Query Refund:

WIP

### Debug:

Some general methods use when `isSuccessful()` return `FALSE`:

```php
    print $response->getCode(); // Error Code From ZaloPay.
    print $response->getMessage(); // Error Message From ZaloPay.
```

Detail status errors for `getCode()` read [here](https://docs.zalopay.vn/v2/general/errors.html).
