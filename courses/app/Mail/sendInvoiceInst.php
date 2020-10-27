<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendInvoiceInst extends Mailable
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
        return $this->from('carspares54@gmail.com','NEW BOOKING, Kasedu')
        ->subject('NEW BOOKING-ID: '.$this->data->reservation_id)
        ->view('user.ar.mails.invoiceBodyInstitute')
        ->attachData($this->pdf, 'NewBooking.pdf', [
            'mime' => 'application/pdf'])
        ->with(['resrvDetails'=>$this->data,'lang'=>$this->lang,'website'=>$this->website,'socialMedia'=>$this->socialMedia,'fullPath'=>$this->fullPath]);
    }
}
