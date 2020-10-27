<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\user\staticPageModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class staticPageController extends Controller
{
    //
    public function getPhoto()
    {
        $lang = parent::detectUserLang();
        $photos =staticPageModel::showPhoto();

        $totalPhotos = [];
        foreach ($photos as $key => $value) {
            $recordPhoto = [
                "photo_id"            =>intval($value->photo_id),
                "photo_name"          =>$value->photo_name,
                "photo_title"         =>$value->{'photo_title'.$lang},
            ];
            array_push($totalPhotos , $recordPhoto);
        }
        if($lang == '_ar'){
            return view('user.ar.photoGallery',[
                'photos'=>$totalPhotos,
                'photosPage'=>$photos
            ]);
        }else{
            return view('user.en.photoGallery',[
                'photos'=>$totalPhotos,
                'photosPage'=>$photos
            ]);
        }
    }
    public function getvedio()
    {
        $lang = parent::detectUserLang();
        $vedios = staticPageModel::showVedio();

        $totalVedios = [];
        foreach($vedios as $key => $value){
            $recordVedio = [
                'video_id'      =>intval($value->video_id) ,
                'video_url'     =>$value->video_url,
                'video_title'   =>$value->{'video_title'.$lang},
                'cover_photo'   =>$value->cover_photo
            ];
            array_push($totalVedios,$recordVedio);
        }
        if($lang == '_ar'){
            return view('user.ar.videoGallery',[
                'vedios'=>$totalVedios,
                'vedioPage'=>$vedios

            ]);
        }else{
            return view('user.en.videoGallery',[
                'vedios'=>$totalVedios,
                'vedioPage'=>$vedios
            ]);
        }
    }

    public function getTermsAndCondition()
    {

        $lang = parent::detectUserLang();
        $terms = staticPageModel::termsAndCondition();

        $totalterms = [];
        foreach($terms as $key => $value){
            $recordTerms = [
                'term_id'        =>intval($value->term_id) ,
                'term_title'     =>$value->{'term_title'.$lang},
                'term_details'   =>$value->{'term_details'.$lang}
            ];
            array_push($totalterms,$recordTerms);
        }
        // dump($totalterms);
        // return $lang;
        // return $recordTerms['term_title'];
        if($lang == '_ar'){
            return view('user.ar.termsAndCondition',[
                'terms'=>$totalterms
            ]);
        }else{
            return view('user.en.termsAndCondition',[
                'terms'=>$totalterms
            ]);
        }

    }

    public function getWish(Request $request)
    {
        $request->validate([
            'page'=>'numeric'
        ]);
        
        $lang = parent::detectUserLang();
        $allWishlist = staticPageModel::getWishlist(Session()->get('user_id'));
        // if($allWishlist->isEmpty()){
        //     if($lang == '_ar'){
        //         return view('user.ar.wishlist',[
        //         ]);
        //     }else{
        //         return view('user.en.wishlist',[
        //         ]);
        //     }
        // }

        $totalWishCourses = [];
        foreach ($allWishlist as $key => $value) {
            $recordCourse = [
                "course_id"             =>intval($value->course_id),
                "course_photo"          =>$value->course_photo,
                "avg_rate_c"            =>$value->avg_rate_c,
                "institute_name"        =>$value->{'institute_name'.$lang},
                "course_name"           =>$value->{'course_name'.$lang},
                "course_price"          =>floatval($value->course_price),
                'course_details'        =>$value->{'course_details'.$lang},
            ];        
            array_push($totalWishCourses , $recordCourse);
        }

        // echo('<preg>');print_r($allWishlist);echo('</preg>');return 'ok';

        if($lang == '_ar'){
            return view('user.ar.wishlist',[
                'totalWishCourses'=>$totalWishCourses,
                'allWishlist'=>$allWishlist,
            ]);
        }else{
            return view('user.en.wishlist',[
                'totalWishCourses'=>$totalWishCourses,
                'allWishlist'=>$allWishlist,

            ]);
        }

    
    }
    public function addWishList(Request $request,$course_id)
    {
        $STID = Session()->get('user_id');
        if(staticPageModel::checkWish($course_id,$STID)){
            if(staticPageModel::removeWish($course_id,$STID)){
                return redirect()->back();

            }else{
                abort(500);
            }
        }else{
                if(staticPageModel::addWishlist($course_id,$STID)){
                    return redirect()->back();
                }else{
                    abort(500);                
                }
        }
    }

    public function getContactUs()
    {
        $lang = parent::detectUserLang();
        $typeOfMsgs = staticPageModel::typeOfMsg();
        $totalmsg = [];
        foreach($typeOfMsgs as $key => $value){
            $recordmsg = [
                'message_title_id'  =>intval($value->message_title_id) ,
                'message_title'     =>$value->{'message_title'.$lang},
            ];
            array_push($totalmsg,$recordmsg);
        }
        $information = staticPageModel::getInformation();
        $information->info_mail = $information->info_mail;
        $information->info_phone = $information->info_phone;
        $information->info_city = $information->{'info_city'.$lang};
        $information->info_country = $information->{'info_country'.$lang};

        // return $typeOfMsgs['message_title'];
        if($lang == '_ar'){
            return view('user.ar.contact-us',[
                'typeOfMsgs' =>$totalmsg,
                'info'=>$information,
            ]);
        }else{
            return view('user.en.contact-us',[
                'typeOfMsgs' =>$totalmsg,
                'info'=>$information,
            ]);
        }
    }

    public function contactUs(Request $request)
    {
        $lang = parent::detectUserLang();
        $STID = Session()->get('user_id');
        $request->validate([
            'student_id'=>'numeric',
            'message_title_id'=>'required|numeric',
            'message'=>'required'
        ]);
        $data = new staticPageModel;
        $data->student_id = $STID;
        $data->message_title_id = $request->message_title_id;
        $data->message = $request->message;
        // staticPageModel::sendmsg($data);
        // return $data;

        if(staticPageModel::sendmsg($data)){
            if($lang == '_ar'){
                return redirect()->back()->with('Success','تم ارسال الرسالة');
            }else{
                return redirect()->back()->with('Success','Message has been sent');
            }
        }
        return redirect()->back()->with('Errors','error');
    }
    public function aboutUs()
    {
        $lang = parent::detectUserLang();
        $about = staticPageModel::getaboutUs();
        $about->title = $about->{'title'.$lang};
        $about->details = $about->{'details'.$lang};
        if($lang == '_ar'){
            return view('user.ar.aboutUs',[
                'about' =>$about
            ]);
        }else{
            return view('user.en.aboutUs',[
                'about' =>$about
            ]);
        }
    }

    public function bankAccount()
    {
        $lang = parent::detectUserLang();
        $account = staticPageModel::bankAccount();
        if($lang == '_ar'){
            return view('user.ar.banksAcc',[
                'accounts'=>$account,

            ]);
        }else{
            return view('user.en.banksAcc',[

                'accounts'=>$account,
            ]);
        }
        // return view('user.en.banksAcc');
    }
    
    public function allNotes(Request $request)
    {
        
        $lang = parent::detectUserLang();
        if($lang == "_ar"){
            Carbon::setLocale('ar');
        }

        $STID = Session()->get('user_id');

        $valid = validator::make($request->all(),[
            'page'=>'numeric'

        ]);
        if($valid->fails()){
            abort(404);
        }

       $allNotes = staticPageModel::getAllNotes($STID);

        if($lang == '_ar'){
            return view('user.ar.allNotes',[
                'allNotes' =>$allNotes,

            ]);
        }else{
            return view('user.en.allNotes',[
                'allNotes' =>$allNotes,

            ]);
        }
           
        
    }
    public function getAddNote(Request $request)
    {
        $lang = parent::detectUserLang();
        if($lang == '_ar'){
            return view('user.ar.addNote',[
            ]);
        }else{
            return view('user.en.addNote',[
            ]);
        }
    }

    public function addNote(Request $request)
    {

        // return $request->all();
        $lang = parent::detectUserLang();

        if($lang == '_ar'){
            $request->validate([
                'note_details'=>"required",
            ],[
                'note_details.required'=>'يرجى ادخال الملاحظة',
            ]);
        }else{
            $request->validate([
                'note_details'=>"required",
            ]);
        }

        $data = $request->except('_token');
        $data['student_id'] = Session()->get('user_id');

        if($request->note_photo != null){
            if($lang == '_ar'){
                $request->validate([
                    'note_photo'=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:10240",
                ],[
                    'note_photo.image'=>'هذة الصورة غير صالحة ',
                    'note_photo.required'=>'يجب أضافة صورة للملاحظة',
                    'note_photo.mimes'=>'هذة الصورة غير صالحة ',
                    'note_photo.max'=>'يجب ادخال صورة أقل من 1 ميجابيت',
                ]);
            }else{
                $request->validate([
                    'note_photo'=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:10240",
                ]);
            }


            try {
            $file_name= time() . '.' . $request->note_photo->extension();
            $s = $request->note_photo->move(storage_path('app/public/images/notes'), $file_name);
            // return $s;
            $data['note_photo'] = $file_name;
            }catch(FileNotFoundException $e){
                return 'please try again';
            }
           


        }

        staticPageModel::insertNote($data);

        if($lang == '_ar'){
            return redirect('all-notes');
        }else{
            return redirect('all-notes');
        }

    }
    

    public function editNote(Request $request,$STID,$note_id)
    {
      // return $request->all();
        $lang = parent::detectUserLang();
        if($lang == '_ar'){
            $request->validate([
                'note_details'=>"required",
            ],[
                'note_details.required'=>'يرجى ادخال الملاحظة',
            ]);
        }else{
            $request->validate([
                'note_details'=>"required",
            ]);
        }
        

        $data = $request->except('_token');
        $data['student_id'] = Session()->get('user_id');

        if($request->note_photo != null){
            if($lang == '_ar'){
                $request->validate([
                    'note_photo'=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:10240",
                ],[
                    'note_photo.image'=>'هذة الصورة غير صالحة ',
                    'note_photo.required'=>'يجب أضافة صورة للملاحظة',
                    'note_photo.mimes'=>'هذة الصورة غير صالحة ',
                    'note_photo.max'=>'يجب ادخال صورة أقل من 1 ميجابيت',
                ]);
            }else{
                $request->validate([
                    'note_photo'=>"required|image|mimes:jpeg,png,jpg,gif,svg|max:10240",
                ]);
            }
            
            try{
            $file_name= time() . '.' . $request->note_photo->extension();
            $request->note_photo->move(storage_path('app/public/images/notes'), $file_name);
            $data['note_photo'] = $file_name;
            }catch(FileNotFoundException $e){
                return 'please try again';
            }
            if($oldPhotoName = staticPageModel::updateNote($STID,$note_id,$data)){
                if($oldPhotoName != 'default.jpg'){
                    if(Storage::delete('public/images/notes/'.$oldPhotoName)){
                        if($lang == '_ar'){
                            return redirect('all-notes')->with('Success','تم تعديل الملحوظة بنجاح ');
                        }else{
                            return redirect('all-notes')->with('Success','You have successfully edit your note');
                        }
                    }
                }else{
                    if($lang == '_ar'){
                        return redirect('all-notes')->with('Success','تم تعديل الملحوظة بنجاح ');
                    }else{
                        return redirect('all-notes')->with('Success','You have successfully edit your note');
                    }
                }

            }else{
                if($lang == '_ar'){
                    return redirect('all-notes')->with('Error','من فضلك اعد المحاولة');
                }else{
                    return redirect('all-notes')->with('Error','Please try again');
                }
            }


            
        }
        $data = $request->except('_token','note_photo');
        staticPageModel::updateNote($STID,$note_id,$data);

        if($lang == '_ar'){
            return redirect('all-notes');
        }else{
            return redirect('all-notes');
        }
    }

    public function deleteNote(Request $request,$STID,$note_id)
    {
        
        $lang = parent::detectUserLang();
        
        $photoName = staticPageModel::deleteNote($STID,$note_id);
        // return $photoName;
        if($photoName != 'default.jpg'){
            if(Storage::delete('public/images/notes/'.$photoName)){
                if($lang == '_ar'){
                    return redirect()->back()->with('Success','لقد تم حذف الملحوظة بنجاح');
    
                }else{
                    return redirect()->back()->with('Success','Note has been successfully deleted');
                }
            }else{
                if($lang == '_ar'){
                    return redirect()->back()->with('Success','لقد تم حذف الملحوظة بنجاح');
    
                }else{
                    return redirect()->back()->with('Success','Note has been successfully deleted');
                }
            }
        }else{
            if($lang == '_ar'){
                return redirect()->back()->with('Success','لقد تم حذف الملحوظة بنجاح');

            }else{
                return redirect()->back()->with('Success','Note has been successfully deleted');
            }
        }
        

    }

    
    

}
