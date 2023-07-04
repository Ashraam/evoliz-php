# PHP Wrapper for Evoliz API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ashraam/evoliz.svg?style=flat-square)](https://packagist.org/packages/ashraam/evoliz-php)
[![Total Downloads](https://img.shields.io/packagist/dt/ashraam/evoliz.svg?style=flat-square)](https://packagist.org/packages/ashraam/evoliz-php)

All the query, body parameters can be found on the official [API documentation](https://www.evoliz.io/documentation)

## Installation

You can install the package via composer:

```bash
composer require ashraam/evoliz-php
```

If your are using `Laravel` you can follow this [integration guide](LARAVEL-INTEGRATION.md).

## Example

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Clients\Client;

$evoliz = new Evoliz($companyId, $publicKey, $secretKey, $endpoint);

$client_repository = new Client($evoliz);

// Create a new client
$client = $client_repository->create([
    'name' => 'IT Consulting',
    'type' => 'Professionnel',
    'address' => [
        'postcode' => 20000,
        'town' => 'Ajaccio',
        'country' => 'France',
        'iso2' => 'FR'
    ]
]);

// Get the list of the clients of this company
$clients = $client_repository->list();
```

## Evoliz client

The client will be required for every sub classes.

It accepts 4 parameters
- `companyId` Int required
- `publicKey` String required
- `secretKey` String required
- `endpoint` String optional (default: `https://www.evoliz.io/api/v1/`)

```php
$evoliz = new Evoliz(12544, 'my_public_key', 'my_secret_key', 'https://my-custom-endpoint.com');
```

## Banks\BankAccount

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Banks\BankAccount;

$banks_repository = new BankAccount(new Evoliz(...));

// Return a list of banks visible by the current user, according to visibility restriction set in user profile
$banks_repository->list();

// Return a bank details by its specific id, according to visibility restriction set in user profile
$banks_repository->get($contactId);
```

## Banks\BankItem

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Banks\BankItem;

$bank_items_repository = new BankItem(new Evoliz(...));

// Return a list of bank items visible by the current User, according to visibility restriction set in user profile
$bank_items_repository->list();

// Return a bank item by its speficied id
$bank_items_repository->get($bankItemId);

// Lock a bank item
$bank_items_repository->lock($bankItemId);

// Unlock a bank item
$bank_items_repository->unlock($bankItemId);
```

## Sales\Invoice

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Sales\Invoice;

$invoices_repository = new Invoice(new Evoliz(...));

// Return a list of invoices visible by the current User, according to visibility restriction set in user profile
$invoices_repository->list();

// Create a new draft invoice with given data. Totals, margins, retention, included VAT fields are automatically calculated.
$draft = $invoices_repository->create([
    'external_document_number' => 'my-custom-id',
    'documentdate' => '2022-02-14',
    'clientid' => 3045161,
    'term' => [
        'paytermid' => 1,
        'recovery_indemnity' => true
    ],
    'items' => [
        [
            'designation' => 'Item 1',
            'quantity' => 4,
            'unit_price_vat_exclude' => 5.73
        ]
    ]
]);

// Return an invoice by its speficied id
$invoices_repository->get($invoiceId);

// Save the invoice with a definitive document number. The status must be “filled” and will be changed to “created”
$invoices_repository->save($invoiceId);

// Send an email with a link to the invoice
$invoices_repository->send($invoiceId, [
    'to' => ['romain@itconsulting-solutions.com']
]);

// Create a new payement with given data
$invoices_repository->payment($invoiceId, [
    'paydate' => '2022-02-14',
    'label' => 'Test paiement',
    'paytypeid' => 1,
    'amount' => 2
]);

// List all payments of the given invoice
$invoices_repository->payments($invoiceId);
```

## Sales\Quote

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Sales\Quote;

$quote_repository = new Quote(new Evoliz(...));

// Return a list of quotes visible by the current User, according to visibility restriction set in user profile
$quote_repository->list();

// Create a new draft quote with given data. Totals, margins, retention, included VAT fields are automatically calculated.
$draft = $quote_repository->create([
    'external_document_number' => 'my-custom-id',
    'documentdate' => '2022-02-14',
    'clientid' => 3045161,
    'term' => [
        'paytermid' => 1,
        'recovery_indemnity' => true
    ],
    'items' => [
        [
            'designation' => 'Item 1',
            'quantity' => 4,
            'unit_price_vat_exclude' => 5.73
        ]
    ]
]);

// Return a quote by its speficied id
$quote_repository->get($quoteId);

// Create a new invoice from the given quote
$quote_repository->invoice($quoteId);
```

## Sales\SaleOrder

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Sales\SaleOrder;

$sale_order_repository = new SaleOrder(new Evoliz(...));

// Return a list of sale orders visible by the current User, according to visibility restriction set in user profile
$sale_order_repository->list();

// Create a new sale order with given data. Totals, margins, included VAT fields are automatically calculated.
$sale_order_repository->create([
    'external_document_number' => uniqid(),
    'documentdate' => '2022-02-15',
    'clientid' => 3045161,
    'term' => [
        'paytermid' => 1
    ],
    'items' => [
        [
            'designation' => 'Item 1',
            'quantity' => 2,
            'unit_price_vat_exclude' => 10,
            'vat_rate' => 20
        ]
    ]
]);

// Return a sale order by its speficied id
$sale_order_repository->get($orderId);

// Create a new invoice from the given sale order
$sale_order_repository->invoice($orderId);
```

## Sales\Delivery

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Sales\Delivery;

$delivery_repository = new Delivery(new Evoliz(...));

// Return a list of deliveries visible by the current User, according to visibility restriction set in user profile
$delivery_repository->list();

// Return a delivery by its speficied id
$delivery_repository->get($deliveryId);
```

## Sales\Payment

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Sales\Payment;

$payments_repository = new Payment(new Evoliz(...));

// Return a list of payments visible by the current User, according to visibility restriction set in user profile
$payments_repository->list();

// Return a payment by its speficied id
$payments_repository->get($paymentId);
```

## Sales\Credit

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Sales\Credit;

$credit_repository = new Credit(new Evoliz(...));

// Return a list of credits visible by the current User, according to visibility restriction set in user profile
$credit_repository->list();

// Return a credit by its speficied id
$credit_repository->get($creditId);
```

## Sales\Advance

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Sales\Advance;

$advance_repository = new Advance(new Evoliz(...));

// Return a list of advances visible by the current User, according to visibility restriction set in user profile
$advance_repository->list();

// List all payments of the given advance
$advance_repository->payments($advanceId);

// Create a new payment with given data
$advance_repository->payment($advanceId, [
    'paydate' => '2022-02-10',
    'label' => 'My label',
    'paytypeid' => 1,
    'amount' => 100,
    'comment' => 'My comment'
]);

// Return an advance by its speficied id
$advance_repository->get($advanceId);
```

## Sales\DocumentLink

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Sales\DocumentLink;

$documents_repository = new DocumentLink(new Evoliz(...));

// Return a list of documents links associated to the requested document
$documents_repository->get($documentType, $documentId);
```

## Purchases\Buy

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Purchases\Buy;

$buys = new Buy(new Evoliz(...));

// Return a list of buys visible by the current User, according to visibility restriction set in user profile
$buys->list();

// Return a buy by its speficied id
$buys->get($buyId);

// Update buy state to locked
$buys->lock($buyId);

// Update buy state to unlocked
$buys->unlock($buyId);
```

## Purchases\SupplierCredit

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Purchases\SupplierCredit;

$credits = new Buy(new Evoliz(...));

// Return a list of Supplier credits visible by the current User, according to visibility restriction set in user profile
$credits->list();

// Return a supplier credit by its speficied id
$credits->get($supplierCreditId);

// Update supplier credit state to locked
$credits->lock($supplierCreditId);

// Update supplier credit state to unlocked
$credits->unlock($supplierCreditId);
```

## Reports\Reports

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Reports\Reports;

$reports = new Reports(new Evoliz(...));

// Get amount of overdue payments by period categories
$reports->payments();

// Get amount of overdue settlements by period categories
$reports->settlements();

// Get turnover report data
$reports->turnover();
```

## Journals\Journals

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Journals\Journals;

$Journals = new Journals(new Evoliz(...));

// Get trial balance data
$journal->trial_balance();

// Get general ledger data
$journal->general_ledger();

// Get FEC journal entries
$journal->fec();

// Get banks journal entries
$journal->banks();

// Get Cashes journal entries
$journal->cash();

// Get sales journal entries
$journal->sales();

// Get purchases journal data
$journal->purchases();

// Get miscellaneous operations journal entries
$journal->miscellaneous();

// Get opening balance journal entries
$journal->opening_balance();
```

## Clients\Client

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Clients\Client;

$clients_repository = new Client(new Evoliz(...));

// Return the client list of the specified or current user company
$clients_repository->list();

// Create a new client with given data
$client = $clients_repository->create([
    'name' => "IT Consulting",
    'type' => "Professionnel",
    'address' => [
        'postcode' => 20000,
        'town' => 'Ajaccio',
        'country' => 'France',
        'iso2' => 'FR'
    ],
    'vat_number' => 'N/C'
]);

// Return a client by its speficied id
$clients_repository->get($clientId);
```

## Client\ContactClient

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Clients\ContactClient;

$contacts_repository = new ContactClient(new Evoliz(...));

// Return a client contact list
$contacts_repository->list();

// Create a new client contact with given data
$client = $contacts_repository->create([
    'clientid' => 3045161,
    'firstname' => 'Romain',
    'lastname' => 'Bertolucci',
    'email' => 'romain@itconsulting-solutions.com'
]);

// Return a client contact by it's id
$contacts_repository->get($contactId);
```

## Client\Prospect

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Clients\Prospect;

$prospects_repository = new Prospect(new Evoliz(...));

// Return the prospect list of the specified or current user company
$prospects_repository->list();

// Return a prospect by it's id
$prospects_repository->get($prospectId);
```

## Client\ContactProspect

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Clients\ContactProspect;

$contacts_repository = new ContactProspect(new Evoliz(...));

// Return a prospect contact list
$contacts_repository->list();

// Return a prospect contact by it's id
$contacts_repository->get($contactId);
```

## Catalog\Article

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Clients\Article;

$articles_repository = new Article(new Evoliz(...));

// Return a list of articles
$articles_repository->list();

// Return article by it's id
$articles_repository->get($articleId);

// Create a new article
$articles_repository->create([
    'reference' => 'ref-001',
    'designation' => 'Article 001',
    'nature' => 'product',
    'unit_price' => 12
]);
```

## Files\File

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Files\File;

$files_repository = new File(new Evoliz(...));

// Return file content encoded in base64
$files_repository->get($documentType, $documentId);
```

## Settings\PurchaseClassification

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\PurchaseClassification;

$classifications = new PurchaseClassification(new Evoliz(...));

// Return a list of Purchases classifications
$classifications->list();

// Return a purchase classification by its specified Id
$classifications->get($classificationId);
```

## Settings\SaleClassification

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\SaleClassification;

$classifications = new SaleClassification(new Evoliz(...));

// Return a list of sales classifications
$classifications->list();

// Return a sale classification by its specified Id
$classifications->get($classificationId);
```

## Settings\PurchaseAffectation

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\PurchaseAffectation;

$affectations = new PurchaseAffectation(new Evoliz(...));

// Return a list of purchases affectations
$affectations->list();

// Return a purchase affectation by its specified Id
$affectations->get($affectationId);
```

## Settings\SaleAffectation

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\SaleAffectation;

$affectations = new SaleAffectation(new Evoliz(...));

// Return a list of sales affectations
$affectations->list();

// Return a sale affectation by its specified Id
$affectations->get($affectationId);
```

## Settings\Analytics

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\Analytics;

$analytics = new Analytics(new Evoliz(...));

// Return a list of analytics axis
$analytics->list();

// Return an analytic axis by its specified Id
$analytics->get($analyticId);
```

## Settings\Accounts

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\Accounts;

$accounts = new Accounts(new Evoliz(...));

// Return a list of accounting classification visible by the current user.
$accounts->list();

// Create a new accounting classification with given data
$accounts->create([
    'code' => '0001',
    'label' => 'Test'
]);

// Return an accounting account by its specified Id.
$accounts->get($accountId);
```

## Settings\PaymentTypes

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\PaymentTypes;

$payment_types = new PaymentTypes(new Evoliz(...));

// Return a list of payment types
$payment_types->list();

// Return a payment type by its specified id
$payment_types->get($payTypeId);
```

## Settings\PaymentTerms

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\PaymentTerms;

$payment_terms = new PaymentTerms(new Evoliz(...));

// Return a list of payment types
$payment_terms->list();

// Return a payment type by its specified id
$payment_terms->get($payTermId);
```

## Settings\UnitCodes

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\UnitCodes;

$units = new UnitCodes(new Evoliz(...));

// Return a list of units codes, used in various endpoints
$units->list();

// Return a unit code by its specified Id
$units->get($unitCodeId);
```

## Settings\VatRates

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Settings\VatRates;

$rates = new VatRates(new Evoliz(...));

// Return a list of vat rates visible by the current user
$rates->list();

// Return a vat rate by its specified Id
$rates->get($vatRateId);
```

## Apps\MyUnisoft

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Apps\MyUnisoft;

$unisoft = new File(new Evoliz(...));

// Connect MyUnisoft application in company with api key
$unisoft->connect($myunisoft_api_key);
```

## Administration\User

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Administration\User;

$users_repository = new User(new Evoliz(...));

// Return a list of users visible by the current User, according to visibility restriction set in user profile.
$users_repository->list();

// Get the detail of a user by it's id
$users_repository->get($userId);
```

## Administration\Subscription

```php
use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\Administration\Subscription;

$subscriptions_repository = new USubscriptionser(new Evoliz(...));

// Return the list of the company's subscriptions.
$subscriptions_repository->list();
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email romain@itconsulting-solutions.com instead of using the issue tracker.

## Credits

-   [Romain Bertolucci (IT Consulting)](https://github.com/ashraam)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
