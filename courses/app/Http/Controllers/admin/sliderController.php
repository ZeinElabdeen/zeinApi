<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\sliderModel;
use Illuminate\Support\Facades\Storage;

class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allSliders = sliderModel::getAllSliders();
        return view('admin.slider.allSliders',[
            'allSliders' => $allSliders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.sliderForm',[
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
            'slider_title'=>'required',
            'slider_title_ar'=>'required',
            'slider_details'=>'required',
            'slider_details_ar'=>'required',
            'slider_link'=>'required',
            'slider_photo'=>'required|image|mimes:png,jpg,jpeg'

        ]);
        
        $data = $request->except('_token','_method');
        $request->validate([
            'slider_photo'=>'image|mimes:png,jpg,jpeg'
        ]);

        $file_name= time() . '.' . $request->slider_photo->extension();
        $request->slider_photo->move(storage_path('app/public/images/sliders'), $file_name);
        $data['slider_photo'] = $file_name;
    
        sliderModel::insertSlider($data);
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
        $slider = sliderModel::getSlider($id);
        return view('admin.slider.sliderForm',[
            'slider' => $slider,
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
            'slider_title'=>'required',
            'slider_title_ar'=>'required',
            'slider_details'=>'required',
            'slider_details_ar'=>'required',
            'slider_link'=>'required',
        ]);
        
        $data = $request->except('_token','_method');

        if($request->has('slider_photo')){
            $request->validate([
                'slider_photo'=>'image|mimes:png,jpg,jpeg'
            ]);

            $file_name= time() . '.' . $request->slider_photo->extension();
            $request->slider_photo->move(storage_path('app/public/images/sliders'), $file_name);
            $oldPhotoName = sliderModel::getSliderPhoto($id);
            if(Storage::delete('public/images/sliders/'.$oldPhotoName)){
                $data['slider_photo'] = $file_name;
                sliderModel::editSlider($data,$id);
                return redirect()->back()->with('Success','Infromation has been updated');
            }

        }
    
        sliderModel::editSlider($data,$id);
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
        $sliderCount = sliderModel::SliderCount();
        if($sliderCount > 1){
            $photoName = sliderModel::deleteSlider($id);
            if(Storage::delete('public/images/sliders/'.$photoName)){
                return redirect()->back()->with("Success","You Have Successfully Removed Slider number : ".$id);
            }  
            return redirect()->back()->with("Error","Please try again");
        }
        return redirect()->back()->with("Error","Slider must have at least one record");
    }
}
