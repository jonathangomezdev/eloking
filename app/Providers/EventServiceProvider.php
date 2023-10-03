<?php

namespace App\Providers;

use App\Events\BoosterPayoutCreatedEvent;
use App\Events\BoosterTipAddedEvent;
use App\Events\InvoiceRegenerateEvent;
use App\Events\NewMessageEvent;
use App\Events\OrderCompletedEvent;
use App\Events\OrderCreatedEvent;
use App\Events\OrderMadeExtraPaymentEvent;
use App\Events\OrderPaymentCompletedEvent;
use App\Events\OrderPaymentFailedEvent;
use App\Events\OrderPickedUpEvent;
use App\Events\OrderRefundedEvent;
use App\Events\OrderStartedEvent;
use App\Events\OrderStatusChangedEvent;
use App\Events\OrderUpdatedEvent;
use App\Events\UserUpdatedEvent;
use App\Listeners\AddBoosterToChatListener;
use App\Listeners\BotMessageForPickedUpOrderListener;
use App\Listeners\CreateChatRoomForOrderListener;
use App\Listeners\BoosterPayoutCreatedListener;
use App\Listeners\CreateOrderCommentListener;
use App\Listeners\ElokingBotMessegerListener;
use App\Listeners\ElokingBotNewOrderMessageListener;
use App\Listeners\GameAccountDetailsListener;
use App\Listeners\GenerateInvoiceListener;
use App\Listeners\NewMessageNotifierListener;
use App\Listeners\NewUserSetupListener;
use App\Listeners\OrderCompletedNotificationListener;
use App\Listeners\OrderConfirmationSenderListener;
use App\Listeners\OrderCreatedNotificationListener;
use App\Listeners\OrderPaymentSuccessfulNotificationListener;
use App\Listeners\OrderPickedUpNotifierListener;
use App\Listeners\OrderRefundNotifierListener;
use App\Listeners\PaymentInfoStoreListener;
use App\Listeners\DuplicateOrderCleanerListener;
use App\Listeners\SendDiscordNotificationListener;
use App\Listeners\UserUpdaterListener;
use App\Notifications\OrderPaymentSuccessfulNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            NewUserSetupListener::class,
            UserUpdaterListener::class,
        ],
        OrderCreatedEvent::class => [
            CreateOrderCommentListener::class,
        ],
        OrderPaymentCompletedEvent::class => [
            CreateChatRoomForOrderListener::class,
            CreateOrderCommentListener::class,
            OrderCreatedNotificationListener::class,
            PaymentInfoStoreListener::class,
            ElokingBotNewOrderMessageListener::class,
            DuplicateOrderCleanerListener::class,
            OrderConfirmationSenderListener::class,
            SendDiscordNotificationListener::class
        ],
        OrderPaymentFailedEvent::class => [
            CreateOrderCommentListener::class,
        ],
        BoosterPayoutCreatedEvent::class => [
            BoosterPayoutCreatedListener::class,
        ],
        OrderCompletedEvent::class => [
            GameAccountDetailsListener::class,
            GenerateInvoiceListener::class,
            OrderCompletedNotificationListener::class,
        ],
        OrderRefundedEvent::class => [
            CreateOrderCommentListener::class,
            GameAccountDetailsListener::class,
            OrderRefundNotifierListener::class,
        ],
        NewMessageEvent::class => [
            NewMessageNotifierListener::class,
        ],
        OrderPickedUpEvent::class => [
            OrderPickedUpNotifierListener::class,
            AddBoosterToChatListener::class,
        ],
        OrderUpdatedEvent::class => [
            CreateOrderCommentListener::class,
        ],
        OrderMadeExtraPaymentEvent::class => [
            CreateOrderCommentListener::class,
        ],
        OrderStartedEvent::class => [
            CreateOrderCommentListener::class,
            BotMessageForPickedUpOrderListener::class
        ],
        BoosterTipAddedEvent::class => [
            ElokingBotMessegerListener::class,
        ],
        OrderStatusChangedEvent::class => [
            CreateOrderCommentListener::class,
        ],
        InvoiceRegenerateEvent::class => [
            GenerateInvoiceListener::class,
        ],
        UserUpdatedEvent::class =>[
            UserUpdaterListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
