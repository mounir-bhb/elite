<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $video;
    protected $request;
    /**
     * Create a new job instance.
     */
    public function __construct(Video $video, Request $request)
    {
        $this->video = $video;
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /* if($request->file('caption')){
            $video->caption=$request->file('caption')->store('video_captions','public');
        } */
        if($this->request->file('video_url'))
            $this->video->video_url= $this->request->file('video_url')->store('videos','public');
        $this->video->save();
    }
}
