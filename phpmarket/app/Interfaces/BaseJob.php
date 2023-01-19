<?php

namespace App\Interfaces;

use App\Exceptions\ValidationException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class BaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected function __construct()
    {
        $valid = $this->validate();
        if (!$valid) {
            throw new ValidationException("Validation failed!", 402);
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public abstract function handle();

    /*
     * Validate the job and ensure it can run
     */
    public abstract function validate();
}
