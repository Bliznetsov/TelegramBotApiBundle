TelegramBotApiBundle
===================

A symfony wrapper bundle for  [Telegram Bot API](https://core.telegram.org/bots/api).

## Install

Via Composer

``` bash
composer require ericomgroup/telegram-bot-api-bundle
```

Edit your app/AppKernel.php to register the bundle in the registerBundles() method as above:


```php
class AppKernel extends Kernel
{

    public function registerBundles()
    {
        $bundles = array(
            // ...
            // register the bundle here
            new EricomGroup\TelegramBotApiBundle\TelegramBotApiBundle()
        );
    }
}
```

## Configure the bundle

This bundle was designed to just work out of the box. The only thing you have to configure in order to get this bundle up and running is your bot [token](https://core.telegram.org/bots#botfather).

```yaml
# app/config/config.yml

telegram_bot_api:
    token: xxxxx:yyyyyyyyyyyyyyyyyyyy
    bot_name : zzzzzzz
```

If you want to use web-hook, just run tish command:

```bash
$ php bin/console telegram:set:webhook

```
*note: Telegram do not support http, your site should have valid SSL (HTTPS).*

## Usage


Wherever you have access to the service container :
```php
<?php
    // get the telegram api as a service
    $bot = $this->container->get('telegram_bot_api');

    // test the API by calling getMe method
    $user = $bot::getMe()->getResult();

?>
```
## Next...

Please refer to [Telegram Bot API Official Document](https://core.telegram.org/bots/api) for getting infomration about available methods and other informations:

## Troubleshooting

If you did all the configurations correctly but still getting errors (Http error 500) even on getMe method, it might be because of SSL Verification. Please make sure you have up-to-date CA root certificate bundle to be used with cURL.

You can configure you CA root certificate bundle by:

 1. Downloading up-to-date cacert.pem file from cURL website and
 2. Setting a path to it in your php.ini file, e.g. on Windows:

 `curl.cainfo=c:\php\cacert.pem`

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
