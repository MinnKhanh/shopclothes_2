<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    protected $messenger;
    protected $type;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messenger, $type, $data)
    {
        $this->messenger = $messenger;
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('khanh0704495681@gmail.com')->view($this->type == 1 ? 'template.email' : 'template.resetpassword', ['messenger' => $this->messenger, 'email' => $this->data]);
    }
}
