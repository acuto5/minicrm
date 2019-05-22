<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\EmployeeRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class EmployeeController
 * @package App\Http\Controllers
 */
class EmployeeController extends Controller
{
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
        $employees = Employee::latest()->paginate(self::PER_PAGE);

        return view('employee.list', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create()
    {
        $companies = Company::all();

        if (count($companies) < 1) {
            return redirect()->route('employee.index')
                ->with('error', 'Cannot create employee, if there are no companies yet!');
        }

        return view('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeeRequest $request): RedirectResponse
    {
        Employee::create($request->getData());

        return redirect()->route('employee.index')
            ->with('status', 'Employee added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return View
     */
    public function edit(Employee $employee): View
    {
        $companies = Company::all();

        return view('employee.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(EmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->getData());

        return redirect()->route('employee.index')
            ->with('status', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('employee.index')
            ->with('status', 'Employee deleted successfully!');
    }
}
