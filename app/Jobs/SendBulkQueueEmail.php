<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use Mail;

class SendBulkQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = User::select('firstname','lastname','email')->where('subscribed','1')->where('verified','1')->where('is_deleted','1')->get();
        $input['subject'] = $this->details['subject'];
        $input['body'] = $this->details['newsLetter']->html_body;
        // dd($data);
        foreach ($data as $key => $value) {
            $input['email'] = $value->email;
            $input['name'] = ucfirst($value->firstname).' '.ucfirst($value->lastname);
            \Mail::send('mails.newsLetter', $input, function($message) use($input){
                $message->to($input['email'], $input['name'])
                    ->subject($input['subject']);
            });
        }
    }
}
