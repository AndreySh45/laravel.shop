<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSubscriptionMessage;
use App\Models\Sku;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sku;
    protected $subscription;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sku $sku, $subscription)
    {
        $this->sku = $sku;
        $this->subscription = $subscription;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->subscription->email)->send(new SendSubscriptionMessage($this->sku));
    }
}
