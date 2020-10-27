<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\partnersModel;
use Illuminate\Support\Facades\Storage;

class partnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPartners = partnersModel::getAllPartners();
        return view('admin.partners.allPartners',[
            'allPartners' => $allPartners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partners.partnerDetails',[
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
            'partner_photo'=>'required|image|mimes:png,jpg,jpeg'
        ]);

        $file_name= time() . '.' . $request->partner_photo->extension();
        $request->partner_photo->move(storage_path('app/public/images/partners'), $file_name);
        $data['partner_photo'] = $file_name;
        partnersModel::insertPartner($data);
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
        $partner = partnersModel::getPartner($id);
        return view('admin.partners.partnerDetails',[
            'partner' => $partner,
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
            'partner_photo'=>'required|image|mimes:png,jpg,jpeg'
        ]);

        $file_name= time() . '.' . $request->partner_photo->extension();
        $request->partner_photo->move(storage_path('app/public/images/partners'), $file_name);
        $oldPhotoName = partnersModel::getOldPhoto($id);

        if(Storage::delete('public/images/partners/'.$oldPhotoName)){
            $data['partner_photo'] = $file_name;
            partnersModel::editPartner($id,$data);
        }

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
        $photoName = partnersModel::deletePartner($id);
        if(Storage::delete('public/images/partners/'.$photoName)){
            return redirect()->back()->with("Success","You Have Successfully Removed Partner number : ".$id);
        }  
        return redirect()->back()->with("Error","Please try again");
    }
}
