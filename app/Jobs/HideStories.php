<?php

namespace App\Jobs;

use App\Story;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HideStories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $story_id;

    /**
     * Create a new job instance.
     * @param $story_id
     * @return void
     */
    public function __construct($story_id)
    {
        $this->story_id = $story_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $story_id = $this->story_id;

        $story = Story::find($story_id);

        if($story) {
            $story->show = 0;
            $story->save();
        }
    }
}
