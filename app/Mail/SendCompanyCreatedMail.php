<?php

namespace App\Mail;

use App\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class SendCompanyCreatedMail
 * @package App\Mail
 */
class SendCompanyCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Company
     */
    private $company;

    /**
     * Create a new message instance.
     *
     * @param $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.company.created', ['company' => $this->company]);
    }
}
