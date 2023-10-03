<?php

namespace App\Console\Commands;

use App\Notifications\UnreadNotification;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class NotificationSummaryOnEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eloking:notification:on-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'After certain time. It will email the customer all the unread notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Starting to find notifications");
        $unreadNotificationGroup = $this->getNotifications();
        $users = User::find($unreadNotificationGroup->pluck('notifiable_id'));
        $this->info("Users found " . $users->count());
        $users->each(function($user) {
            if ($user->allow_email_notifications) {
                $this->sendNotification($user);
            }
        });

        $this->info("Completed");
        return 0;
    }

    private function getNotifications()
    {
        return DB::table('notifications')
                ->select('notifiable_id')
                ->whereNull('read_at')
                ->where('notifiable_type', User::class)
                ->where('created_at', '>=', now()->subMinutes(30)->seconds(0)->toDateTimeString())
                ->where('created_at', '<=', now()->subMinutes(30)->seconds(59)->toDateTimeString())
                ->groupBy('notifiable_id')
                ->get();
    }

    private function sendNotification(User $user)
    {
        $user->notify(
            new UnreadNotification()
        );
    }
}
