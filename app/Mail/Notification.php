<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    protected $header;
    protected $img;
    protected $messenger;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($header, $img, $messenger)
    {
        $this->header = $header;
        $this->img = $img;
        $this->messenger = $messenger;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->messenger);
        return $this->from('khanh0704495681@gmail.com')->markdown('template.sendnotification', ['title' => $this->header, 'logo' => $this->img, 'messenger' => $this->messenger]);
    }
}
