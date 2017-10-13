# Clickatell SMS

A simple Clickatell Laravel wrapper for Laravel 5.4/5.

### Installation

```php
composer require billowapp/clickatell-sms
```

### Env Configuration

```
CLICKATELL_API_KEY=your_api_key
```

### Usage

```php
use Facades\Billow\Utilities\SMS; // Real-time facade

SMS::recipient('27112223333')->content('your text message content')->send();
```

The `send()` method will return a boolean. If sending the SMS failed, check your logs for the error.