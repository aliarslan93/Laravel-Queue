<?php

namespace App\Jobs;

use App\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FlushImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $payload;
    protected $img_src;
    protected $id;

    protected function start() {
        //  start logic
    }

    protected function stop() {
        //  stop logic
    }
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($img_src,$id)
    {
        $this->img_src = $img_src;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        $this->start();

        $image = new Image(array(
            'img_src' => $this->img_src,
            'source_id' => $this->id
        ));
        $image->save();
    }
}
