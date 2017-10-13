# Clickatell-SMS

A simple Clickatell Laravel wrapper for Laravel 5.4.

### Installation

```php
composer require billowapp/clickatell-sms
```

### Env Configuration

```
CLICKATELL_API_KEY=your_api_key
```

### Real-time Facade Import

```php
use Facades\Billow\Utilities\SMS;
```

### Usage

```php
SMS::recipient('27112223333')->content('your text message content')->send();
```