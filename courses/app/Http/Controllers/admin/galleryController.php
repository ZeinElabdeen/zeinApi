<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\galleryModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;


class galleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // all Photos
        $allPhotos = galleryModel::allPhotos();
        $allVedios = galleryModel::allVedios();
        return view('admin.gallery.allGallery',[
            'photos'=>$allPhotos,
            'vedios'=>$allVedios,
        ]);
    }

    public function getAllvideos()
    {
        // all videos
        $allVedios = galleryModel::allVedios();
        return view('admin.gallery.allVideos',[
            'vedios'=>$allVedios,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //form of photo
        return view('admin.gallery.addPhoto');

    }

    public function createVedio()
    {
        //form of vedio
        return view('admin.gallery.addVedio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // add photo
        $request->validate([
            'photo_name'=>'required|image|mimes:jpeg,png,jpg|max:10240',
            'photo_title'=>'required',
            'photo_title_ar'=>'required',
        ]);
        $data = new galleryModel;
        $file_name= time() . '.' . $request->photo_name->extension();
        $request->photo_name->move(storage_path('app/public/images/gallery'), $file_name);
        $data->photo_name = $file_name;
        $data->photo_title     = $request->photo_title;
        $data->photo_title_ar  = $request->photo_title_ar;
        galleryModel::addPhoto($data);
        return redirect()->back()->with('Success','You have Successfully Added Photo');
    }

    public function storeVedio(Request $request)
    {
        // add video
        $request->validate([
            'cover_photo'=>'required|image|mimes:jpeg,png,jpg|max:10240',
            'video_url'=>'required|file|mimes:mp4|max:512000',
            'video_title'=>'required',
            'video_title_ar'=>'required',
        ]);
        $data = new galleryModel;

        $Cover_photo= time() . '.' . $request->cover_photo->extension();
        $request->cover_photo->move(storage_path('app/public/videos/covers'), $Cover_photo);

        $vedio_file = time().'.'. $request->video_url->extension();
        $request->video_url->move(storage_path('app/public/videos'), $vedio_file);

        $data->cover_photo = $Cover_photo;
        $data->video_url = $vedio_file;
        $data->video_title     = $request->video_title;
        $data->video_title_ar  = $request->video_title_ar;

        galleryModel::addvedio($data);
        return redirect()->back()->with('Success','You have Successfully Added vedio');
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
        $photos = galleryModel::showphoto($id);
        return view('admin.gallery.addPhoto',[
            'photosedit'=>$photos[0],
        ]);
    }

    public function showVedio($id)
    {
        //
        $vedios = galleryModel::showVideo($id);
        return view('admin.gallery.addVedio',[
            'videosedit'=>$vedios[0],
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
        // update photo
        $request->validate([
            'photo_name'=>'image|mimes:jpeg,png,jpg|max:10240',
            'photo_title'=>'required',
            'photo_title_ar'=>'required',
        ]);
        //  return $request->all();
        $data = $request->except('_token','_method');
        if($request->has('photo_name')){

            $file_name= time() . '.' . $request->photo_name->extension();
            $request->photo_name->move(storage_path('app/public/images/gallery'), $file_name);

            $oldPhoto = galleryModel::getoldPhoto($id);
            if(Storage::delete('public/images/gallery/'.$oldPhoto)){
                $data['photo_name'] = $file_name;
                galleryModel::updateImage($data,$id);
                return redirect()->back()->with('Success','You have Successfully updated');
            }
        }
        galleryModel::updateImage($data,$id);
        return redirect()->back()->with('Success','You have Successfully updated');

    }

    public function updateVedio(Request $request, $id)
    {
        $request->validate([


            'video_title'=>'required',
            'video_title_ar'=>'required',
        ]);
            $cover = false;
            $video = false;

        if($request->has('cover_photo')){
            $request->validate([
                'cover_photo'=>'required|image|mimes:jpeg,png,jpg|max:10240',
            ]);
            $photo= time() . '.' . $request->cover_photo->extension();
            $request->cover_photo->move(storage_path('app/public/videos/covers'), $photo);
            sleep(2);
            $cover = true;
            $oldPhotoCover = galleryModel::getVedioCover($id);
            if(Storage::delete('public/videos/covers/'.$oldPhotoCover)){
                $data = $request->except('_token','_method','video_url');
                $data['cover_photo'] = $photo;
                galleryModel::updatevideo($data,$id);
                return redirect()->back()->with('Success','You have Successfully updated');
            }
        }

        if($request->has('video_url')){
            $request->validate([
                'video_url'=>'required|file|mimes:mp4',
            ]);
            try{
            $vedio_file = time().'.'. $request->video_url->extension();
            $request->video_url->move(storage_path('app/public/videos'), $vedio_file);
                $video = true;
            }catch(FileNotFoundException $e){
                    return 'please try again';
                }

            $oldVideoUrl = galleryModel::getVedioUrl($id);
            if(Storage::delete('public/videos/'.$oldVideoUrl)){
                $data = $request->except('_token','_method','cover_photo');
                $data['video_url'] = $vedio_file;

                galleryModel::updatevideo($data,$id);
                return redirect()->back()->with('Success','You have Successfully updated');
            }
        }
        if($cover = false && $video = false){
            $data = $request->except('_token','_method');
            galleryModel::updatevideo($data,$id);
            return redirect()->back()->with('Success','You have Successfully updated');
        }

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
        $photoName = galleryModel::deletephoto($id);
        if(Storage::delete('public/images/gallery/'.$photoName)){
            return redirect()->back()->with("Success","You Have Successfully Removed photo number : ".$id);
        }
        return redirect()->back()->with("Success","You Have Successfully Removed photo number : ".$id);
    }
    public function destroyVideo($id)
    {
        $data = galleryModel::deleteVideo($id);
        if(Storage::delete('public/videos/'.$data->video_url) && Storage::delete('public/videos/covers/'.$data->cover_photo)){
            return redirect()->back()->with("Success","You Have Successfully Removed video number : ".$id);
        }
        return redirect()->back()->with("Success","You Have Successfully Removed video number : ".$id);
    }
}
