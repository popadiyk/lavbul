<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Invoice;

class SendInvoiceToUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $invoice = null;
    protected $link = null;
    public $subject = null;

    protected $order = null;

    protected $recipient_email = null;
    /**
     * SendInvoiceToUser constructor.
     * @param Invoice $invoice
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;

        $this->link = $this->initLink();

        $this->subject = $this->initSubject();

        $this->order = $this->initOrder();
    }

    /**
     * @return \App\Order
     */
    private function initOrder()
    {
        return $this->invoice->order;
    }

    /**
     * @return string
     */
    private function initSubject()
    {
        return 'Рахунок для проплати в магазині "Лавка-булавка"';
    }

    /**
     * Init link to generate psf of Invoice
     *
     * @return string
     */
    private function initLink()
    {
        $base = env('APP_BASE_URL');

        return $base."/invoices/generatePdf/".$this->invoice->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->order->email)
            ->subject($this->subject)
            ->view('mail.send_invoice_to_user', [
                'user' => $this->order->user,
                'order' => $this->order,
                'invoice' => $this->invoice,
                'link' => $this->link
            ]);
    }
}
