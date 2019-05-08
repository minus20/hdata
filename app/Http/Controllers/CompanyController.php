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
            'name' => ['required', 'string', 'max:191', 'unique:companies'],
            'description' => ['nullable', 'string'],
            'approved' => ['nullable', 'boolean']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // все поля select кроме аггрегаций должны дублироваться в groupBy
        $companies = \DB::table('companies')
            ->select(['companies.id','companies.name',\DB::raw('AVG(reviews.rating) AS average_rating')])
            ->leftJoin('reviews', 'companies.id', '=', 'reviews.company_id')
            ->groupBy('companies.id', 'companies.name')
            ->orderBy('average_rating', 'desc')
            ->get();
        return response()->json($companies);
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
        if (\Auth::user()->can('update', $company)) {
            $company->approved = $request->all()['approved'];
            $company->save();
        }
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
