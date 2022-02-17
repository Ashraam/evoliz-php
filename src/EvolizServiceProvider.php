<?php

namespace Ashraam\Evoliz;

use Ashraam\Evoliz\Files\File;
use Ashraam\Evoliz\Sales\Credit;
use Ashraam\Evoliz\Purchases\Buy;
use Ashraam\Evoliz\Sales\Advance;
use Ashraam\Evoliz\Sales\Invoice;
use Ashraam\Evoliz\Apps\MyUnisoft;
use Ashraam\Evoliz\Banks\BankItem;
use Ashraam\Evoliz\Clients\Client;
use Ashraam\Evoliz\Sales\Delivery;
use Ashraam\Evoliz\Catalog\Article;
use Ashraam\Evoliz\Reports\Reports;
use Ashraam\Evoliz\Clients\Prospect;
use Ashraam\Evoliz\Banks\BankAccount;
use Ashraam\Evoliz\Journals\Journals;
use Ashraam\Evoliz\Sales\DocumentLink;
use Ashraam\Evoliz\Administration\User;
use Illuminate\Support\ServiceProvider;
use Ashraam\Evoliz\Clients\ContactClient;
use Ashraam\Evoliz\Clients\ContactProspect;
use Ashraam\Evoliz\Purchases\SupplierCredit;
use Ashraam\Evoliz\Administration\Subscription;
use Ashraam\Evoliz\Sales\Payment;
use Ashraam\Evoliz\Sales\Quote;
use Ashraam\Evoliz\Sales\SaleOrder;
use Ashraam\Evoliz\Settings\Accounts;
use Ashraam\Evoliz\Settings\Analytics;
use Ashraam\Evoliz\Settings\PaymentTerms;
use Ashraam\Evoliz\Settings\PaymentTypes;
use Ashraam\Evoliz\Settings\PurchaseAffectation;
use Ashraam\Evoliz\Settings\PurchaseClassification;
use Ashraam\Evoliz\Settings\SaleAffectation;
use Ashraam\Evoliz\Settings\SaleClassification;
use Ashraam\Evoliz\Settings\UnitCodes;
use Ashraam\Evoliz\Settings\VatRates;

class EvolizServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/evoliz.php' => config_path('evoliz.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/evoliz.php', 'evoliz');

        $evoliz = new Evoliz(config('evoliz.company'), config('evoliz.key'), config('evoliz.secret'), config('evoliz.endpoint'));

        $this->app->singleton(Subscription::class, function () use ($evoliz) {
            return new Subscription($evoliz);
        });

        $this->app->singleton(User::class, function () use ($evoliz) {
            return new User($evoliz);
        });

        $this->app->singleton(MyUnisoft::class, function () use ($evoliz) {
            return new MyUnisoft($evoliz);
        });

        $this->app->singleton(BankAccount::class, function () use ($evoliz) {
            return new BankAccount($evoliz);
        });

        $this->app->singleton(BankItem::class, function () use ($evoliz) {
            return new BankItem($evoliz);
        });

        $this->app->singleton(Article::class, function () use ($evoliz) {
            return new Article($evoliz);
        });

        $this->app->singleton(Client::class, function () use ($evoliz) {
            return new Client($evoliz);
        });

        $this->app->singleton(ContactClient::class, function () use ($evoliz) {
            return new ContactClient($evoliz);
        });

        $this->app->singleton(ContactProspect::class, function () use ($evoliz) {
            return new ContactProspect($evoliz);
        });

        $this->app->singleton(Prospect::class, function () use ($evoliz) {
            return new Prospect($evoliz);
        });

        $this->app->singleton(File::class, function () use ($evoliz) {
            return new File($evoliz);
        });

        $this->app->singleton(Journals::class, function () use ($evoliz) {
            return new Journals($evoliz);
        });

        $this->app->singleton(Buy::class, function () use ($evoliz) {
            return new Buy($evoliz);
        });

        $this->app->singleton(SupplierCredit::class, function () use ($evoliz) {
            return new SupplierCredit($evoliz);
        });

        $this->app->singleton(Reports::class, function () use ($evoliz) {
            return new Reports($evoliz);
        });

        $this->app->singleton(Advance::class, function () use ($evoliz) {
            return new Advance($evoliz);
        });

        $this->app->singleton(Credit::class, function () use ($evoliz) {
            return new Credit($evoliz);
        });

        $this->app->singleton(Delivery::class, function () use ($evoliz) {
            return new Delivery($evoliz);
        });

        $this->app->singleton(DocumentLink::class, function () use ($evoliz) {
            return new DocumentLink($evoliz);
        });

        $this->app->singleton(Invoice::class, function () use ($evoliz) {
            return new Invoice($evoliz);
        });

        $this->app->singleton(Payment::class, function () use ($evoliz) {
            return new Payment($evoliz);
        });

        $this->app->singleton(Quote::class, function () use ($evoliz) {
            return new Quote($evoliz);
        });

        $this->app->singleton(SaleOrder::class, function () use ($evoliz) {
            return new SaleOrder($evoliz);
        });

        $this->app->singleton(Accounts::class, function () use ($evoliz) {
            return new Accounts($evoliz);
        });

        $this->app->singleton(Analytics::class, function () use ($evoliz) {
            return new Analytics($evoliz);
        });

        $this->app->singleton(PaymentTerms::class, function () use ($evoliz) {
            return new PaymentTerms($evoliz);
        });

        $this->app->singleton(PaymentTypes::class, function () use ($evoliz) {
            return new PaymentTypes($evoliz);
        });

        $this->app->singleton(PurchaseAffectation::class, function () use ($evoliz) {
            return new PurchaseAffectation($evoliz);
        });

        $this->app->singleton(PurchaseClassification::class, function () use ($evoliz) {
            return new PurchaseClassification($evoliz);
        });

        $this->app->singleton(SaleAffectation::class, function () use ($evoliz) {
            return new SaleAffectation($evoliz);
        });

        $this->app->singleton(SaleClassification::class, function () use ($evoliz) {
            return new SaleClassification($evoliz);
        });

        $this->app->singleton(UnitCodes::class, function () use ($evoliz) {
            return new UnitCodes($evoliz);
        });

        $this->app->singleton(VatRates::class, function () use ($evoliz) {
            return new VatRates($evoliz);
        });
    }
}
