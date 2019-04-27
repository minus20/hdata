<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Waavi\Sanitizer\Sanitizer;

class CompanyController extends Controller
{

    /**
     * Pass data to sanitize user input
     *
     * @param $data array
     * @return Sanitizer
     */
    public function sanitize($data)
    {
        return \Sanitizer::make($data, [
            'name' => 'strip_tags|escape'
        ])->sanitize();
    }

    public function validator($data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191', 'unique:companies']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = $this->sanitize($request->all());
        $this->validator($company)->validate();
        return Company::create($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($company)
    {
        return Company::findOrFail($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company = $this->sanitize($request->all());
        $this->validator($company)->validate();
        $company->update($request->all());

        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json(null, 204);
    }
}