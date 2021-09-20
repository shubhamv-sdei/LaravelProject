<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Config;

class SendStaffInvite extends Mailable
{
    use Queueable, SerializesModels;
     public $maildata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->maildata = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(isset($this->maildata['type']) && isset($this->maildata['type'])){
            return $this->from(Config::get('mail.from.address'))
                    ->view('mails.MMInvite')
                    // ->text('Reset Password')
                    ->with($this->maildata);
        }else{
            return $this->from(Config::get('mail.from.address'))
                    ->view('mails.staffInvite')
                    // ->text('Reset Password')
                    ->with($this->maildata);
        }
       
    }
}
