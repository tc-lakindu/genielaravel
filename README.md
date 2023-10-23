# Dialog Genie IPG for Laravel

Dialog Genie IPG for Laravel is a PHP Laravel Package W

## Installation

Use the package manager composer to install package.

```bash
composer require techcouchits/genie
```

Add Dialog Genie API Key and Callback URL it .env file

```env
//ENV FILE
GENIE_API = YOUR_API_KEY
GENIE_REDIRECT_URL = YOUR_REDIRECT_URL
```

Update Service Provider (config/app.php)

```php
    'providers' => ServiceProvider::defaultProviders()->merge([
        \Techcouchits\Genie\GenieIpgServiceProvider::class
    ])->toArray(),
```

## Usage

Redirect to below route with Payment amount and reference

```php
Controller
return redirect(amount,reference);
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
