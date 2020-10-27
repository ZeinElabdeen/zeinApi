<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\bankAccountModel;
class bankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allAccounts = bankAccountModel::allBankAcc();
        return view('admin.bankAccount.allbankAcc',[
            'allAccs'=>$allAccounts,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.bankAccount.addBankAcc');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'account_name'=>'required',
            'account_number'=>'required|unique:bank_accounts',
            'bank_name'=>'required',
            'statement'=>'required',
        ]);
        $data = $request->all();
        if(bankAccountModel::addBankAcc($data)){
            return redirect()->back()->with('Success','you successfuly add bank account');
        }
        return redirect()->back()->with('Error','please try again');
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
        $showAcc = bankAccountModel::showAccount($id);
        return view('admin.bankAccount.addBankAcc',[
            'showAcc'=>$showAcc[0]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $request->validate([
            'account_name'=>'required',
            'account_number'=>'required',
            'bank_name'=>'required',
            'statement'=>'required',
        ]);
        $data = $request->except('_token','_method');
        if(bankAccountModel::updateBankAcc($data,$id)){
            return redirect()->back()->with('Success','you successfuly update bank account');
        }
        return redirect()->back()->with('Error','please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        bankAccountModel::deleteAcc($id);
        return redirect()->back()->with('Success','you sussefully deleted account no: '.$id);
    }
}
