<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Mail;

class SendMailCreateTravelReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $username;
    protected $usermail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, $usermail)
    {
        //
        $this->queue = 'SendMailCreateTravelReport';
        $this->username = $username;
        $this->usermail = $usermail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $usermail = $this->usermail;
        Log::info('Start to send mail');
        Mail::send('frontend.mail.create-report', ['user_name' => $this->username], function ($m) use ($usermail) {
            $m->from('hello@app.com', 'Travel Maker');

            $m->to($usermail['email'])->subject('Create Report');
        });
        Log::info('End send mail');
    }
}
