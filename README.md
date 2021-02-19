# Laravel Firebase Cloud Messaging

## Introduction

LaraFcm is an easy to use package working with both Laravel and Lumen for sending push notification with [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging/) (FCM).

## Installation

To get the latest version of LaraFcm on your project, require it from "composer":

    $ composer require prgayman/larafcm

Or you can add it directly in your composer.json file:

```json
{
  "require": {
    "prgayman/larafcm": "1.0.0"
  }
}
```

Publish the package config and migrations files using the following command:

    $ php artisan vendor:publish --provider="Prgayman\LaraFcm\Providers\LaraFcmServiceProviderr"

migrate larafcm_tokens using the following command:

    $ php artisan migrate

### Laravel

Register the provider directly in your app configuration file config/app.php `config/app.php`:

Laravel >= 5.5 provides package auto-discovery, thanks to rasmuscnielsen and luiztessadri who help to implement this feature in LaraFcm, the registration of the provider and the facades should not be necessary anymore.

```php
'providers' => [
    Prgayman\LaraFcm\Providers\LaraFcmServiceProvider::class,
]
```

Add the facade aliases in the same file:

```php
'aliases' => [

  'LaraFcm' => Prgayman\LaraFcm\Facades\LaraFcm::class,

]
```

### Lumen

Register the provider in your bootstrap app file `boostrap/app.php`

Add the following line in the "Register Service Providers" section at the bottom of the file.

```php
$app->register(Prgayman\LaraFcm\Providers\LaraFcmServiceProvider::class);
```

For facades, add the following lines in the section "Create The Application" .

```php
class_alias(\Prgayman\LaraFcm\Facades\LaraFcm::class, 'LaraFcm');
```

### Package Configuration

In your `.env` file, add the server key and the secret key for the Firebase Cloud Messaging:

```php
LARAFCM_AUTHENTICATION_KEY=my_secret_server_key
LARAFCM_SENDER_ID=my_secret_sender_id
```

To get these keys, you must create a new application on the [firebase cloud messaging console](https://console.firebase.google.com/).

After the creation of your application on Firebase, you can find keys in `project settings -> cloud messaging`.

## Usage

Two types of messages can be sent using LaraFcm:

- Notification messages, sometimes thought of as "display messages"
- Data messages, which are handled by the client app

More information is available in the [official documentation](https://firebase.google.com/docs/cloud-messaging/concept-options).

### Larafcm tokens manager (Prgayman\LaraFcm\Services\LaraFcmToken)

```php
use Prgayman\LaraFcm\Services\LaraFcmToken;

// Store desvice token
(new LaraFcmToken)
->setTokens(['token'])
->store();

// Store desvice token to specific user
(new LaraFcmToken)
->setTokens('token')
->setModel(User::find(1))
->store();

// Can you set platform or locale to token both options is optional
(new LaraFcmToken)
->setTokens(['token'])
->setPlatform('android')
->setLocale('en')
->store();

/**
 * Get token from database you can use filter by model or locale ot platform to get tokens
 *
 * @param Illuminate\Database\Eloquent\Model|null $model
 * @param string|null $locale
 * @param string|null $platform
 *
 * @return array
 */
$tokens = LaraFcmToken::getDbTokens();

$removeTokens = [];
/**
 * Remove toknes from database
 * @param array $tokens
 *
 * @return bool
*/
$isDeleted = LaraFcmToken::removeDbTokens($removeTokens);
```

### Larafcm trait HasLaraFcm (Prgayman\LaraFcm\Traits\HasLaraFcm)

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Prgayman\LaraFcm\Traits\HasLaraFcm; // Add this line

class User extends Authenticatable
{
    use HasLaraFcm; // Add this line
}

$user = User::find(1);

/**
 * Get user tokens can you use filter by locale or platform
 *
 * @param string|null $locale
 * @param string|null $platform
 *
 * @return array
 */
$locale = null;
$platform = "ios";
$userTokens = $user->larafcmGetTokens($locale,$platform)

/**
 * store user tokens can you set platform or locale to token
 *
 * @param array|string $tokens
 * @param string|null  $locale
 * @param string|null  $platform
 *
 * @return bool
 */
$storeUserTokens = ['new_token'];
$user->larafcmStoreTokens($tokens, $locale, $platform)
```

### Downstream Messages

A downstream message is a notification message, a data message, or both, that you send to a target device or to multiple target devices using its registration_Ids.

The following use statements are required for the examples below:

```php
use Prgayman\LaraFcm\Message\Options;
use Prgayman\LaraFcm\Message\Data;
use Prgayman\LaraFcm\Message\Notification;
use LaraFcm;
```

## Licence

This library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

Some of this documentation is coming from the official documentation. You can find it completely on the [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging/) Website.
