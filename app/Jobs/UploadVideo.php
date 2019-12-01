<?php

namespace App\Jobs;

use File;
use Storage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = storage_path() . '/uploads/' . $this->filename;
        $s3 = 's3://env('S3_KEY'):env('S3_SECRET')@video.fishcube.co.uk'

        $job = Cocunut_job::create(array(
            'api_key' => 'env('COCONUT_API_KEY')',
            'source' => 'http://fishcube.co.uk/storage/uploads/video.mp4',
            'webhook' => 'http://fishcube.co.uk/webhook/cocunut',
            'outputs' => array(
                'mp4' => $s3 . '/videos/video_' . $file . '.mp4',
                'jpg:300x' => $s3 . '/previews/thumbs_#num#.jpg, number-1' 

            )
        ))
    }
}
