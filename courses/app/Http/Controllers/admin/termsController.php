<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\termsModel;

class termsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTerms = termsModel::getAllTerms();
        return view('admin.terms.termsConditions',[
            'allTerms'=>$allTerms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.terms.termsConditionsForm',[
            'add'=>1
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'term_title'=>'required',
            'term_title_ar'=>'required',
            'term_details_ar'=>'required',
            'term_details'=>'required',

        ]);

        $data = $request->except('_token','_method');
        termsModel::insertTerm($data);
        return redirect()->back()->with('Success','Infromation has been updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $term = termsModel::getTerm($id);
        return view('admin.terms.termsConditionsForm',[
            'term' => $term,
            'add'=>0,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'term_title'=>'required',
            'term_title_ar'=>'required',
            'term_details_ar'=>'required',
            'term_details'=>'required',

        ]);

        $data = $request->except('_token','_method');
        termsModel::editTerm($id,$data);
        return redirect()->back()->with('Success','Infromation has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(termsModel::deleteTerm($id)){
            return redirect()->back()->with("Success","You Have Successfully Removed Term number : ".$id);
        }
        return redirect()->back()->with("Error","Please try again");
    }
}
