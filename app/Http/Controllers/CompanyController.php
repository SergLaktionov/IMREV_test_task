<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Companies/Index', [
            'companies' => Company::paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Companies/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());

        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return Inertia::render('Companies/Show', [
            'company' => $company->load('clients'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return Inertia::render('Companies/Form', [
            'company' => $company->load('clients'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return redirect()->route('companies.show', [
            'company' => $company->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index');
    }

    /**
     * Return list of companies filtered by name without those already chosen
     */
    public function getFilteredCompanies(Request $request)
    {
        $companies = Company::when($request->selected, function ($query) use ($request) {
                $query->whereNotIn('id', $request->selected);
            })->where('name', 'like', '%' . $request->search . '%')
            ->paginate();

        return $companies;
    }
}
