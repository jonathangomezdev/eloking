<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HelpDeskFaqController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\PageController::class, 'home']);
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about']);
Route::get('/jobs', [\App\Http\Controllers\PageController::class, 'jobs']);
Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact']);
Route::post('/contact', [\App\Http\Controllers\PageController::class, 'handleSubmittedForm']);

/* CS:GO */
Route::get('/csgo', [\App\Http\Controllers\PageController::class, 'csgo']);
Route::get('/csgo/rank-boost', [\App\Http\Controllers\PageController::class, 'csgoRank']);
Route::get('/csgo/esea-boost', [\App\Http\Controllers\PageController::class, 'csgoEsea']);
Route::get('/csgo/faceit-boost', [\App\Http\Controllers\PageController::class, 'csgoFaceit']);

/* Valorant */
Route::get('/valorant-boost', [\App\Http\Controllers\PageController::class, 'valorant']);

/* League of Legends */
Route::get('/lol-boost', [\App\Http\Controllers\PageController::class, 'lol']);

/* Blog */
Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);
Route::get('/blog/lol', [\App\Http\Controllers\BlogPostController::class, 'lol']);
Route::get('/blog/valorant', [\App\Http\Controllers\BlogPostController::class, 'valorant']);
Route::get('/blog/csgo', [\App\Http\Controllers\BlogPostController::class, 'csgo']);
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogPostController::class, 'show']);

/* API Endpoints  */
Route::post('/api/rank/calculate', [\App\Http\Controllers\RankController::class, 'calculate']);

/* Static pages */
Route::get('/privacy-policy', [\App\Http\Controllers\PageController::class, 'privacyPolicy']);
Route::get('/terms-for-players', [\App\Http\Controllers\PageController::class, 'termsForPlayers']);
Route::get('/terms-for-users', [\App\Http\Controllers\PageController::class, 'termsForUsers']);

Route::get('/member/login', [\App\Http\Controllers\LoginController::class, 'show']);
Route::get('/logout', [\App\Http\Controllers\LogoutController::class, 'logout']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('auth.login');

Route::post('/password/email/verify', [\App\Http\Controllers\ForgotPassword::class, 'sendEmailToken']);
Route::get('/password/reset', [\App\Http\Controllers\ForgotPassword::class, 'passwordResetForm'])->name('password.reset');
Route::post('/password/reset', [\App\Http\Controllers\ForgotPassword::class, 'passwordReset']);

Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index']);

/* Payment Routes */
Route::post('/api/checkout/intent', [\App\Http\Controllers\CheckoutController::class, 'intent']);
Route::post('/set-paypal-express-checkout', [\App\Http\Controllers\CheckoutController::class, 'intentForPaypal']);
Route::post('/paypal/intent/validate', [\App\Http\Controllers\CheckoutController::class, 'paypalIntentVerification']);
Route::get('/api/customer', [\App\Http\Controllers\CustomerController::class, 'show']);
Route::post('/api/order', [\App\Http\Controllers\OrderController::class, 'store']);
Route::put('/api/order/{order}/success', [\App\Http\Controllers\OrderController::class, 'orderSuccess']);
Route::post('/api/customer', [\App\Http\Controllers\CustomerController::class, 'savePassword']);

/* Admin Routes */
Route::middleware('admin.routes')
        ->namespace('Admin')
        ->prefix('/panel')
    ->group(function() {
        Route::get('/admin/user', [\App\Http\Controllers\Admin\UserController::class, 'index']);
        Route::get('/admin/user/create', [\App\Http\Controllers\Admin\UserController::class, 'create']);
        Route::get('/admin/user/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit']);
        Route::put('/admin/user/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update']);
        Route::post('/admin/user', [\App\Http\Controllers\Admin\UserController::class, 'store']);
        Route::delete('/admin/user/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy']);
        Route::get('/booster/{user}/payouts/create', [\App\Http\Controllers\BoosterPayoutController::class, 'create']);
        Route::put('/booster/payout/{payout}/status', [\App\Http\Controllers\BoosterPayoutStatusController::class, 'update']);
        Route::post('/booster/{user}/payouts', [\App\Http\Controllers\BoosterPayoutController::class, 'store']);

        Route::get('/payout/{payout}', [\App\Http\Controllers\BoosterPayoutController::class, 'show']);
        Route::put('/payout/{payout}', [\App\Http\Controllers\BoosterPayoutController::class, 'update']);

        Route::get('/order/{order}/edit', [\App\Http\Controllers\OrderController::class, 'edit']);
        Route::put('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'update']);
        Route::post('/order/{order}/refund', [\App\Http\Controllers\RefundController::class, 'store']);

        Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'adminIndex']);
        Route::post('/blog', [\App\Http\Controllers\BlogPostController::class, 'store']);
        Route::get('/blog/create', [\App\Http\Controllers\BlogPostController::class, 'create']);
        Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']);
        Route::put('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'update']);

        Route::get('/order-log', [\App\Http\Controllers\OrderLogController::class, 'index']);
        Route::get('/order-log/cleanup', [\App\Http\Controllers\OrderLogController::class, 'destroy']);
        Route::get('/order-log/{order}', [\App\Http\Controllers\OrderLogController::class, 'store']);

        Route::get('/help/add', [HelpDeskFaqController::class, 'add']);
        Route::post('/help/save', [HelpDeskFaqController::class, 'save'])->name('save');
        Route::post('/help/update', [HelpDeskFaqController::class, 'update'])->name('update');
        Route::get('/help/delete/{faq_id}', [HelpDeskFaqController::class, 'delete'])->name('delete');
        Route::get('/help/edit/{faq_id}', [HelpDeskFaqController::class, 'edit'])->name('edit');

    });

Route::middleware('auth')->prefix('panel')->group(function() {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show']);
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update']);
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index']);
    Route::get('/orders/create', [\App\Http\Controllers\OrderController::class, 'create']);
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show']);
    Route::get('/jobs', [\App\Http\Controllers\JobController::class, 'index']);
    Route::get('/rules', [\App\Http\Controllers\RuleController::class, 'index']);
    Route::put('/orders/{order}/status', [\App\Http\Controllers\OrderStatusController::class, 'update']);
    Route::post('/orders/{order}/gameAccount', [\App\Http\Controllers\OrderGameAccountDetails::class, 'store']);
    Route::delete('/orders/{order}/gameAccount/{gameAccountDetails}', [\App\Http\Controllers\OrderGameAccountDetails::class, 'destroy']);

    Route::post('/notifications/markAllSeen', [\App\Http\Controllers\NotificationController::class, 'markAllSeen']);
    Route::post('/order/{order}/extra-payment/intent', [\App\Http\Controllers\OrderController::class, 'extraPaymentIntent']);
    Route::post('/order/{order}/extra-payment/completed', [\App\Http\Controllers\OrderController::class, 'extraPaymentCompleted']);
    Route::post('/order/{order}/booster-tip/paymentIntent', [\App\Http\Controllers\BoosterTipController::class, 'paymentIntent']);
    Route::post('/order/{order}/booster-tip/completed', [\App\Http\Controllers\BoosterTipController::class, 'paymentCompleted']);
    Route::post('/booster/order/{order}/comment', [\App\Http\Controllers\OrderCommentController::class, 'store']);

    Route::post('/order/{order}/booster/drop', [\App\Http\Controllers\BoosterOrderController::class, 'drop']);

    Route::post('/orders/{order}/champions', [\App\Http\Controllers\OrderChampionsController::class, 'store']);
    Route::put('/orders/{order}/champions', [\App\Http\Controllers\OrderChampionsController::class, 'update']);

    Route::post('/chat-room/{chatRoom}/message', [\App\Http\Controllers\ChatRoomMessageController::class, 'store']);
    Route::put('/chat-room/{chatRoom}/message/{chatRoomMessage}', [\App\Http\Controllers\ChatRoomMessageController::class, 'update']);

    Route::get('/order/{order}/invoice/{for}/{order_number}-invoice.pdf', [\App\Http\Controllers\InvoiceController::class, 'download']);

    Route::post('/order/{order}/complete-order/intent', [\App\Http\Controllers\FailedOrderController::class, 'fullPayIntent']);
    Route::post('/order/{order}/start', [\App\Http\Controllers\OrderController::class, 'startOrder']);

    Route::get('/order/{order}/booster/unassigned', [\App\Http\Controllers\BoosterOrderController::class, 'destroy']);

    Route::prefix('/booster')->group(function() {
        Route::get('/payouts', [\App\Http\Controllers\BoosterPayoutController::class, 'index']);
        Route::get('/{user}', [\App\Http\Controllers\BoosterController::class, 'show']);
        Route::post('/order/{order}/pickup', [\App\Http\Controllers\BoosterOrderController::class, 'store']);
    });

    Route::get('/help', [HelpDeskFaqController::class, 'index']);
    Route::get('/help/add', [HelpDeskFaqController::class, 'add']);
    Route::post('/help/save', [HelpDeskFaqController::class, 'save'])->name('save');
    Route::get('/help/delete/{faq_id}', [HelpDeskFaqController::class, 'delete'])->name('delete');
    Route::get('/help/edit/{faq_id}', [HelpDeskFaqController::class, 'edit'])->name('edit');
    Route::post('/help/update', [HelpDeskFaqController::class, 'update'])->name('update');

    Route::get('/report', [\App\Http\Controllers\ReportController::class, 'index']);
});

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}
