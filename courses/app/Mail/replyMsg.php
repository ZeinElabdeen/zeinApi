<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class replyMsg extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$subject ='Message Reply')
    {
        $this->data = $data;
        $this->subject = $subject;

        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('carspares54@gmail.com','Kasedu Contact-Us')->subject($this->subject)->view('admin.mails.replyBody')->with(['data'=>$this->data]);
    }


}
