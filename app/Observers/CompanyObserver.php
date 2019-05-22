<?php

namespace App\Observers;

use App\Company;
use App\Mail\SendCompanyCreatedMail;
use Illuminate\Support\Facades\Mail;

/**
 * Class CompanyObserver
 * @package App\Observers
 */
class CompanyObserver
{
    /**
     * Handle the company "created" event.
     *
     * @param Company $company
     * @return void
     */
    public function created(Company $company)
    {
        Mail::to('admin@admin.com')
            ->send(new SendCompanyCreatedMail($company));
    }

    /**
     * Handle the company "updated" event.
     *
     * @param Company $company
     * @return void
     */
    public function updated(Company $company)
    {
        //
    }

    /**
     * Handle the company "deleted" event.
     *
     * @param Company $company
     * @return void
     */
    public function deleted(Company $company)
    {
        //
    }

    /**
     * Handle the company "restored" event.
     *
     * @param Company $company
     * @return void
     */
    public function restored(Company $company)
    {
        //
    }

    /**
     * Handle the company "force deleted" event.
     *
     * @param Company $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        //
    }
}
