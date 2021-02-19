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
use Prgayman\LaraFcm\Message\Topics;
use LaraFcm;
```

#### Sending a Downstream Message to a Device

```php

// Get all tokens form database return array you can set string token
$tokens = LaraFcmToken::getDbTokens();

// Send Notifications without data
$downstreamResponse = LaraFcm::to($tokens)
notification(
    (new Notification)
        ->setTitle('New Order')
        ->setBody('You have placed order')
        ->setColor('#f00')
)
->options(
    (new Options)
    ->setTimeToLive(60*20)
    ->setContentAvailable(true)
)
->send();

// Send Notifications with data
$downstreamResponse = LaraFcm::to($tokens)
notification(
    (new Notification)
        ->setTitle('New Order')
        ->setBody('You have placed order')
        ->setColor('#f00')
)
->data(
    (new Data)
    ->addData(['key'=>"value"])
)
->options(
    (new Options)
    ->setTimeToLive(60*20)
    ->setContentAvailable(true)
)
->send();

// Send data message
$downstreamResponse = LaraFcm::to($tokens)
->data(
    (new Data)
    ->addData(['key'=>"value"])
)
->options(
    (new Options)
    ->setTimeToLive(60*20)
    ->setContentAvailable(true)
)
->send();

$downstreamResponse->numberSuccess();
$downstreamResponse->numberFailure();
$downstreamResponse->numberModification();

// return Array - you must remove all this tokens in your database
$downstreamResponse->tokensToDelete();

// return Array (key : oldToken, value : new token - you must change the token in your database)
$downstreamResponse->tokensToModify();

// return Array - you should try to resend the message to the tokens in the array
$downstreamResponse->tokensToRetry();

// return Array (key:token, value:error) - in production you should remove from your database the tokens
$downstreamResponse->tokensWithError();
```

> Kindly refer [Downstream message error response codes](https://firebase.google.com/docs/cloud-messaging/http-server-ref#error-codes) documentation for more information.

#### Sending a Message to a Topic

```php
$topicResponse = LaraFcm::notification(
    (new Notification)
        ->setTitle('New Order')
        ->setBody('You have placed order')
        ->setColor('#f00')
)
->options(
    (new Options)
    ->setTimeToLive(60*20)
    ->setContentAvailable(true)
)
->topics(
    (new Topics)
    ->topic('larafcm')
)
->send();

$topicResponse->isSuccess();
$topicResponse->shouldRetry();
$topicResponse->error();
```

#### Sending a Message to Multiple Topics

It sends notification to devices registered at the following topics:

- larafcm and ecommerce
- larafcm and news

> Note : Conditions for topics support two operators per expression

```php
$topicResponse = LaraFcm::notification(
    (new Notification)
        ->setTitle('New Order')
        ->setBody('You have placed order')
        ->setColor('#f00')
)
->options(
    (new Options)
    ->setTimeToLive(60*20)
    ->setContentAvailable(true)
)
->topics(
    (new Topics)
    ->topic('larafcm')
    ->andTopic(function($condition) {
	    $condition->topic('ecommerce')->orTopic('news');
    });
)
->send();

$topicResponse->isSuccess();
$topicResponse->shouldRetry();
$topicResponse->error());

```

## Options

LaraFcm supports options based on the options of Firebase Cloud Messaging. These options can help you to define the specificity of your notification.

You can construct an option as follows:

```php
use Prgayman\LaraFcm\Message\Options;

$options = new Options;
$options->setTimeToLive(42*60)
        ->setCollapseKey('a_collapse_key');
```

## Notification Messages

Notification payload is used to send a notification, the behaviour is defined by the App State and the OS of the receptor device.

**Notification messages are delivered to the notification tray when the app is in the background.** For apps in the foreground, messages are handled by these callbacks:

- didReceiveRemoteNotification: on iOS
- onMessageReceived() on Android. The notification key in the data bundle contains the notification.

See the [official documentation](https://firebase.google.com/docs/cloud-messaging/concept-options#notifications).

```php
use Prgayman\LaraFcm\Message\Notification;
$notification = new Notification();
$notification->setTitle('title')
             ->setBody('body')
             ->setSound('sound')
             ->setBadge('badge');
```

## Notification & Data Messages

App behavior when receiving messages that include both notification and data payloads depends on whether the app is in the background or the foreground—essentially, whether or not it is active at the time of receipt ([source](https://firebase.google.com/docs/cloud-messaging/concept-options#messages-with-both-notification-and-data-payloads)).

- **Background**, apps receive notification payload in the notification tray, and only handle the data payload when the user taps on the notification.
- **Foreground**, your app receives a message object with both payloads available.

## Topics

For topics message, LaraFcm offers an easy to use api which abstract firebase conditions. To make the condition given for example in the firebase official documentation it must be done with LaraFcm like below:

**Official documentation condition**

```
'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)
```

```php
use Prgayman\LaraFcm\Message\Topics;

$topics = new Topics;
$topics->topic('TopicA')
       ->andTopic(function($condition) {
	       $condition->topic('TopicB')->orTopic('TopicC');
       });
```

## Helper fucntions

```php
    $topicResponse = larafcm()
    ->notification(
        (new Notification)
            ->setTitle('New Order')
            ->setBody('You have placed order')
            ->setColor('#f00')
    )
    ->options(
        (new Options)
        ->setTimeToLive(60*20)
        ->setContentAvailable(true)
    )
    ->data(
        (new Data)
        ->addData(['key'=>"value"])
    )
    ->topics(
        (new Topics)
        ->topic('larafcm')
    )
    ->send();
```

## Licence

This library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

Some of this documentation is coming from the official documentation. You can find it completely on the [Firebase Cloud Messaging](https://firebase.google.com/docs/cloud-messaging/) Website.
