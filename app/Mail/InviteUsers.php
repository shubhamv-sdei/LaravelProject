<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Config;

class InviteUsers extends Mailable
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

        if(isset($this->maildata['share']) && $this->maildata['share']){
            return $this->from(Config::get('mail.from.address'))
                    ->subject('You have been invited to ClinicalMatch')
                    ->view('mails.shareInvite')
                    ->with($this->maildata);
        }

        if($this->maildata['role'] == '1'){
            return $this->from('sender@example.com')
                    ->view('mails.physicanInvite')
                    ->with($this->maildata);
        }else if($this->maildata['role'] == '2'){
            return $this->from('sender@example.com')
                    ->view('mails.patientInviteByPatient')
                    ->with($this->maildata);
        }else{
            return $this->from('sender@example.com')
                    ->view('mails.principalInvInvite')
                    ->with($this->maildata); 
        }
        
    }
}
