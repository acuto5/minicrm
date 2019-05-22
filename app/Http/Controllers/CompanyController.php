<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyEditRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class CompanyController
 * @package App\Http\Controllers
 */
class CompanyController extends Controller
{
    /**
     * Logo store path
     */
    const LOGO_DIRECTORY = 'companies';

    /**
     * Entries per page
     */
    const PER_PAGE = 5;

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $companies = Company::latest()->paginate(self::PER_PAGE);

        return view('company.list', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyCreateRequest $request
     * @return RedirectResponse
     */
    public function store(CompanyCreateRequest $request): RedirectResponse
    {
        Company::create([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'logo' => $request->getLogo() ? $request->getLogo()->store(self::LOGO_DIRECTORY) : null,
            'website' => $request->getWebsite(),
        ]);

        return redirect()->route('company.index')
            ->with('status', 'Company created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return View
     */
    public function edit(Company $company): View
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyEditRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(CompanyEditRequest $request, Company $company): RedirectResponse
    {
        $data = [
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'website' => $request->getWebsite(),
        ];

        if ($request->getLogo()) {
            $data['logo'] = $request->getLogo()->store(self::LOGO_DIRECTORY);
        }

        $company->update($data);

        return redirect()->route('company.index')
            ->with('status', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect()->route('company.index')
            ->with('status', 'Company deleted successfully!');
    }
}
