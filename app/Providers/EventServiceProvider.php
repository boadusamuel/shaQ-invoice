<?php

namespace App\Providers;

use App\Events\InvoiceCreatedEvent;
use App\Events\InvoiceItemsUpdatedEvent;
use App\Listeners\InvoiceCreatedListener;
use App\Listeners\InvoiceItemsUpdatedListener;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Observers\InvoiceObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        InvoiceCreatedEvent::class => [
            InvoiceCreatedListener::class,
        ],
        InvoiceItemsUpdatedEvent::class => [
            InvoiceItemsUpdatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Invoice::observe(InvoiceObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
