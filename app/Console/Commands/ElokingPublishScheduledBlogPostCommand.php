<?php

namespace App\Console\Commands;

use App\BlogPost;
use Illuminate\Console\Command;

class ElokingPublishScheduledBlogPostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eloking:blog:post:scheduled:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will publish all scheduled blog post';

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
        $this->info('Fetching all scheduled blog posts for today.');
        $posts = BlogPost::where('status', BlogPost::STATUS_DRAFT)->whereDate('schedule_publish_at', now());

        $this->info('Found ' . $posts->count() . ' blog posts to be published today');
        $posts->each(function($post) {
            $this->info('Publishing ' . $post->slug);
            $post->update([
                'status' => BlogPost::STATUS_PUBLISHED,
            ]);
            $this->info('Published ' . $post->slug);
        });

        $this->info('All Blog Posts published. Cheers!');
        return 0;
    }
}
