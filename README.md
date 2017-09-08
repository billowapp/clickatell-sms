# clickatell-sms

A simple Clickatell Laravel wrapper for Laravel 5.4+.

### Installation

```php
composer require billowapp/clickatell-sms
```

### env

```
CLICKATELL_API_KEY=your_api_key
```

### Facade Import

```php
use Facades\Billow\Utilities\SMS;
```

### Usage example

```php
SMS::recipient('27112223333')->content('your text message content')->send();
```