<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMsg extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(isset($this->data['attachment'])){
            return $this->from('carspares54@gmail.com','Kasedu Contact-Us')
            ->subject($this->data['subject'])
            ->attachData($this->data['attachementFullPath'], 'file.png', ['mime' => 'image/jpeg'])
            // ->attach($this->data['attachment']->getRealPath(),[
                // 'as'=>'file'.$this->data['attachment']->getClientOriginalExtension(),
                // 'mime'=>$this->data['attachment']->getClientMimeType()])
            ->view('admin.mails.sendMsgBody')
            ->with(['data'=>$this->data]);
        }
        return $this->from('carspares54@gmail.com','Kasedu Contact-Us')
        ->subject($this->data['subject'])
        ->view('admin.mails.sendMsgBody')
        ->with(['data'=>$this->data]);

    }
}
