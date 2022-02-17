# Laravel Integration

```bash
composer require ashraam/evoliz-php
```

Add this keys to your `.env` file

```bash
# Your Evoliz company ID
EVOLIZ_COMPANY=

# Your Evoliz public key
EVOLIZ_KEY=

# Your Evoliz secret key
EVOLIZ_SECRET=

# This config is optional, the default endpoint is https://www.evoliz.io/api/v1
# EVOLIZ_ENDPOINT=
```

You can publish the config file using the `vendor:publish` command but this step is optional

```bash
php artisan vendor:publish --provider="Ashraam\Evoliz\EvolizServiceProvider"
```

Once the step above are done you will be able to resolve the different classes through the Service Container like this:

## Example
```php
<?php

namespace App\Http\Controllers;

use Ashraam\Evoliz\Sales\Invoice;

class TestController extends Controller
{
    public function index(Invoice $invoices)
    {
        return $invoices->list();
    }
}
```

