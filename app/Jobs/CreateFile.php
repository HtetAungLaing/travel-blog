<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

class CreateFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $coverName;
    public function __construct($coverName)
    {
        $this->coverName = $coverName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // square
        $image = Image::make(public_path('storage/cover/' . $this->coverName));
        $image->fit(300, 300)->save(public_path('storage/cover/square_' . $this->coverName));

        // 4:3
        $image = Image::make(public_path('storage/cover/' . $this->coverName));
        $ratio = 4 / 3;
        $image->fit($image->width(), intval($image->width() / $ratio))->save(public_path('storage/cover/customRatio_' . $this->coverName));

        // preview
        $image = Image::make(public_path('storage/cover/' . $this->coverName));
        $image->resize(300, null, function ($con) {
            $con->aspectRatio();
        })->save(public_path('storage/cover/preview_' . $this->coverName));

        // large
        $image = Image::make(public_path('storage/cover/' . $this->coverName));
        $image->resize(1024, null, function ($con) {
            $con->aspectRatio();
        })->save(public_path('storage/cover/large_' . $this->coverName));
    }
}
