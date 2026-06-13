<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Subscription\Entities\ClientProject;
use Modules\Subscription\Entities\ClientProjectInstallment;

class ClientProjectInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public ClientProjectInstallment $installment;
    public ClientProject $project;
    public $user;

    public function __construct(
        ClientProjectInstallment $installment,
        ClientProject $project,
        $user
    ) {
        $this->installment = $installment;
        $this->project     = $project;
        $this->user        = $user;
    }

    public function build(): static
    {
        return $this->view('emails.client-project-invoice')
            ->subject('Invoice #' . $this->installment->invoice_number . ' - ' . $this->project->name);
    }
}
