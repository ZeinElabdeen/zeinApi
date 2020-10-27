<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sentInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $lang;
    public $pdf;

    public $website;
    public $socialMedia;
    public $fullPath;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf,$data,$lang,$website,$socialMedia,$fullPath)
    {
        $this->pdf = $pdf;
        $this->data = $data;
        $this->lang = $lang;
        $this->website = $website;
        $this->socialMedia = $socialMedia;
        $this->fullPath = $fullPath;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('carspares54@gmail.com','korsat invoice')->subject('Reservation Invoice')->view('user.ar.mails.invoiceBody')->with(['data'=>$this->data,'lang'=>$this->lang]);
        return $this->from('carspares54@gmail.com','Kasedu invoice')
        ->subject('Reservation Invoice')
        ->view('user.ar.mails.invoiceBody')
        ->attachData($this->pdf, 'Invoice.pdf', [
            'mime' => 'application/pdf'])
        ->with(['resrvDetails'=>$this->data,'lang'=>$this->lang,'website'=>$this->website,'socialMedia'=>$this->socialMedia,'fullPath'=>$this->fullPath]);
       
    }
}
