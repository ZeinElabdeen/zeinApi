<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\APIS\pagesApiModel;
use App\APIS\reservationApiModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;



class pagesApiController extends Controller
{

    public function staticPages(Request $request)
    {
        // return URL::to('/');
        $lang = parent::detectLang($request);
        // return $lang;
            $valid = validator::make($request->all(),[
                'page_id'=>'numeric|exists:pages'

            ]);

        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);


        }

        if($pageContent = pagesApiModel::getPage($request->page_id)){

                $pageRecord = [
                    "title"=>$pageContent->{'title'.$lang},
                    "details"=>$pageContent->{'details'.$lang}
                ];

            return response()->json(['success'=>true,"result"=>["page_content"=>$pageRecord]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);

        }
    }

    public function allNotes(Request $request)
    {

        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);
        if($lang == "_ar"){
            Carbon::setLocale('ar');
        }
        $valid = validator::make($request->all(),[
            'page'=>'numeric'

        ]);

        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }
        // return $STID;
        if($allNotes = pagesApiModel::getAllNotes($STID)){

            if($allNotes->isEmpty()){
                if($lang == "_ar"){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لا توجد ملاحظات","details"=>array()]],401);
                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No Notes  ","details"=>array()]],401);

            }

            $total_records = array();
            $record = array();

            foreach ($allNotes as $key => $value) {

                $record = [
                    "note_id"=>$value->note_id,
                    "note"=>$value->{'note_details'},
                    "note_date"=>Carbon::parse($value->note_created_at)->diffForHumans()

                ];
                array_push($total_records,$record);
                $pagination = [

                                "current_page"      =>$allNotes->currentPage(),
                                "next_page_url"     =>$allNotes->nextPageUrl(),
                                "pervious_page_url" =>$allNotes->previousPageUrl(),
                                "total_records"     =>$allNotes->total(),
                                "per_page"          =>$allNotes->perPage(),
                                "last_item"         =>$allNotes->lastItem(),
                                "last_page"         =>$allNotes->lastPage(),

                ];
            }
           


            return response()->json(['success'=>true,"result"=>["notes"=>$total_records,"pagination"=>$pagination]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);
        }
    }

    public function noteDetails(Request $request)
    {
        $lang = parent::detectLang($request);
        // return $lang;
            $valid = validator::make($request->all(),[
                'note_id'=>'numeric|exists:notes'

            ]);

        if($valid->fails()){


            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);


        }

        if($pageContent = pagesApiModel::getNoteDetails($request->note_id)){

            $photo_path =  URL::to('/').'/storage/images/notes/';
            $photo = $photo_path.$pageContent->note_photo;
            if($pageContent->note_photo == null){
                $photo = null;
            }
            
            $pageRecord = [
                "note"=>$pageContent->{'note_details'},
                "note_photo"=>$photo,
            ];

        return response()->json(['success'=>true,"result"=>["note_details"=>$pageRecord]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again! ","details"=>array()]],500);

        }


    }

    public function addNote(Request $request)
    {

        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);
        // return $lang;                "passport_photo.image" =>"هذا الملف غير صحيح",
            if($lang == '_ar'){
                $valid = validator::make($request->all(),[
                    'note'=>'required',
                    'note_photo'=>'image',

                ],[
                    'note.required'=>'يرجى ادخال الملاحظة',
                    'note_photo.image'=>'هذة الصورة غير صالحة ',
                ]);
            }else{
                $valid = validator::make($request->all(),[
                    'note'=>'required',  // |regex:/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/
                    'note_photo'=>'image',

                ]);
            }


        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);

        }


            $data = new pagesApiModel;
            $data->student_id = $STID;
            $data->note_details = $request->note;

            if($request->has('note_photo')){
                $file_name= time() . '.' . $request->note_photo->extension();
                $request->note_photo->move(storage_path('App\public\images\notes'), $file_name);
                $data->note_photo = $file_name;
            }

            if(pagesApiModel::insertNote($data)){
                return response()->json(['success'=>true,"result"=>(object)[]],200);
            }else{
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again!! ","details"=>array()]],500);
            }
        

    }
    public function editNote(Request $request)
    {
        $access_token = $request->header('access_token');
        $photoFlag = $request->header('photo');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);
        
        // return $lang;                "passport_photo.image" =>"هذا الملف غير صحيح",
            if($lang == '_ar'){
                $valid = validator::make($request->all(),[
                    'note_id'=>'required',
                    'note'=>'required',
                    'note_photo'=>'image',

                ],[
                    'note.required'=>'يرجى ادخال الملاحظة',
                    'note_photo.image'=>'هذة الصورة غير صالحة ',
                ]);
            }else{
                $valid = validator::make($request->all(),[
                    'note'=>'required',  // |regex:/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/
                    'note_photo'=>'image',

                ]);
            }


        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);

        }

        $data = new pagesApiModel;
        $data->student_id = $STID;
        $data->note_details = $request->note;
        $data->note_id = intval($request->note_id);

        
        // return $data;
        
        

        if($photoFlag == 0){
            if(pagesApiModel::editNoteOnly($data)){
                return response()->json(['success'=>true,"result"=>(object)[]],200);
            }else{
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again !! ","details"=>array()]],500);
            }
        }

        if($photoFlag == 1){

            if($request->has('note_photo')){
                $file_name= time() . '.' . $request->note_photo->extension();
                $request->note_photo->move(storage_path('App\public\images\notes'), $file_name);
                $data->note_photo = $file_name;

                if(pagesApiModel::editNote($data)){
                    return response()->json(['success'=>true,"result"=>(object)[]],200);
                }else{
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again !! ","details"=>array()]],500);
                }
            }

            if(pagesApiModel::deletePhotoOnly($data)){
                return response()->json(['success'=>true,"result"=>(object)[]],200);
            }else{
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again !! ","details"=>array()]],500);
            }

        }

    }
    
    public function deleteNote(Request $request)
    {
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);

        $valid = validator::make($request->all(),[
            'note_id'=>'required|numeric|exists:notes',

        ]);
        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                foreach($vs as $val)
                {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            //return error with validation errors
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);

        }

        // return $request->all();
        
        if(pagesApiModel::deleteNote($STID,$request->note_id)){
            return response()->json(['success'=>true,"result"=>(object)[]],200);
        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please Try again!! ","details"=>array()]],500);
        }
    }

    public function getPhotos(Request $request)
    {

        $lang = parent::detectLang($request);

        if($lang == '_ar'){
            $valid = validator::make($request->all(),[
                'page'=>'numeric'

            ],[
                'page.numeric'=>"يجب ان تحتوي عللى ارقام فقط "
            ]);
            // return "arabic";

        }else{
            $valid = validator::make($request->all(),[
                'page'=>'numeric'

            ]);
        }
        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }

        $photo_path = URL::to('/').'/storage/images/gallery/';

        
        if($photo = pagesApiModel::photos()){

            if($photo->isEmpty()){
                if($lang == '_ar'){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لاتوجد صور حاليا","details"=>array()]],401);

                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No current photos","details"=>array()]],401);

            }

            $allphotos = array();
            $photoRecord = array();
            $pagination = array();
            foreach ($photo as $key => $value) {
                $photoRecord = [
                    "photo_title" =>$value->{'photo_title'.$lang},
                    "photo" =>$photo_path.$value->photo_name
                ];
                array_push($allphotos,$photoRecord);

            }
            $pagination = [

                "current_page"      =>$photo->currentPage(),
                "next_page_url"     =>$photo->nextPageUrl(),
                "pervious_page_url" =>$photo->previousPageUrl(),
                "total_records"     =>$photo->total(),
                "per_page"          =>$photo->perPage(),
                "last_item"         =>$photo->lastItem(),
                "last_page"         =>$photo->lastPage(),

                ];
                if($pagination == null){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"no pages ","details"=>array()]],500);
                }
         return response()->json(['success'=>true,"result"=>["all_photos"=>$allphotos,"pagination"=>$pagination]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>""]],500);
        }

    }

    public function getVideos(Request $request)
    {


        $lang = parent::detectLang($request);

        if($lang == '_ar'){
            $valid = validator::make($request->all(),[
                'page'=>'numeric'

            ],[
                'page.numeric'=>"يجب ان تحتوي عللى ارقام فقط "
            ]);
            // return "arabic";

        }else{
            $valid = validator::make($request->all(),[
                'page'=>'numeric'

            ]);
        }

        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }

        $video_path = URL::to('/').'/storage/videos/';
        $photo_path = URL::to('/').'/storage/videos/covers/';


        if($vedio = pagesApiModel::vedios()){

            if($vedio->isEmpty()){
                if($lang == '_ar'){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لاتوجد فيديوهات حاليا","details"=>array()]],401);

                }
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No current videos","details"=>array()]],401);

            }

            $allvedios = array();
            $vedioRecord = array();
            $pagination = array();
            foreach ($vedio as $key => $value) {
                $vedioRecord = [
                    "video_title" =>$value->{'video_title'.$lang},
                    "video" =>$video_path.$value->video_url,
                    "cover" =>$photo_path.$value->cover_photo
                ];
                array_push($allvedios,$vedioRecord);

            }

            $pagination = [

                "current_page"      =>$vedio->currentPage(),
                "next_page_url"     =>$vedio->nextPageUrl(),
                "pervious_page_url" =>$vedio->previousPageUrl(),
                "total_records"     =>$vedio->total(),
                "per_page"          =>$vedio->perPage(),
                "last_item"         =>$vedio->lastItem(),
                "last_page"         =>$vedio->lastPage(),

                ];
            if($pagination == null){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"no pages ","details"=>array()]],500);
            }
         return response()->json(['success'=>true,"result"=>["all_videos"=>$allvedios,"pagination"=>$pagination]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>""]],500);
        }
    }

    public function termsAndCondition(Request $request)
    {

        $lang = parent::detectLang($request);
        if($term = pagesApiModel::termsandcond()){

            if($term->isEmpty()){
                if($lang == '_ar'){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لاتوجد شروط واحكام حاليا","details"=>array()]],401);

                }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No terms and  condtions currently","details"=>array()]],401);
            }


            $termsRecord = array();
            $allTerms = array();

            foreach ($term as $key => $value) {
                $termsRecord = [
                    "term_title"     =>$value->{'term_title'.$lang},
                    "term_details"   =>$value->{'term_details'.$lang}
                ];
                array_push($allTerms,$termsRecord);
            }


        return response()->json(['success'=>true,"result"=>["termsAndCond"=>$allTerms]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>""]],500);
        }
    }

    public function getContactUs(Request $request)
    {
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);

        if($contact = pagesApiModel::getContact()){

            $allContacts = array();
            $contactRecord = array();
            foreach ($contact as $key => $value) {
                $contactRecord = [
                    'subject_id'=>$value->message_title_id,
                    'subject_name'=>$value->{'message_title'.$lang},
                ];
                array_push($allContacts,$contactRecord);

            }

            if($social = pagesApiModel::getSocial()){

                $allSocial = array();
                $socialRecord = array();
                foreach ($social as $key => $value) {
                    $socialRecord = [
                        'social_id'=>$value->social_id,
                        'social_link'=>$value->social_link,
                    ];
                    array_push($allSocial,$socialRecord);
    
                }
            }

            return response()->json(['success'=>true,'result' =>["contact"=>["message_subject"=>$allContacts,"social_links"=>$allSocial]]],200);

        }

        return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>(object)[]]],500);

    }

    public function contactUs(Request $request)
    {

        // if($access_token = $request->header('access_token')){
        //     $STID = Session()->get($access_token);
        // }else{
        //     $STID = '';
        // }
        $access_token = $request->header('access_token');
        $STID = parent::getUserId($access_token);
        $lang = parent::detectLang($request);
        if($lang == '_ar'){
            $valid = validator::make($request->all(),[
                'page'=>'numeric',
                'message'=>'required',
                'message_title_id' =>'required|exists:message_title'

            ],[
                'page.numeric'=>"يجب ان تحتوي عللى ارقام فقط ",
                'message.required'=>'يرجي ادخال الرساله',
                'message_title_id.required'=>'يرجي ادخال عنوان الرساله',
                'message_title_id.exists'=>'هذا الاختيار غير موجود'
            ]);
            }else{
                $valid = validator::make($request->all(),[
                    'page'=>'numeric',
                    'message'=>'required',// |regex:/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/
                    'message_title_id' =>'required|exists:message_title'
                ]);
        }
        if($valid->fails()){

            $arr = array();
            $jsonError = array();
            foreach ($valid->errors()->toArray() as $k => $vs) {
                   foreach($vs as $val)
                   {

                    $arr["key"]= $k;
                    $arr["value"]= $val;
                    array_push($jsonError,$arr);

                    }
            }
            return response()->json(['success'=>false,"error"=>["case"=>1,"message"=>"","details"=>$jsonError]],401);
        }
            $contact = new pagesApiModel;
            $contact->student_id = $STID;
            $contact->message = $request->message;
            $contact->message_title_id = $request->message_title_id;
            if(pagesApiModel::contact($contact)){

                return response()->json(['success'=>true,'result' =>(object)[]],200);
            }
            if($lang == '_ar'){
                return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"يرجي اعاده المحاولة ","details"=>(object)[]]],500);
            }

            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>(object)[]]],500);

    }

    public function bankAccounts(Request $request)
    {

        $lang = parent::detectLang($request);
        if($term = pagesApiModel::getBankAcc()){

            if($term->isEmpty()){
                if($lang == '_ar'){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لاتوجد حسابات بنكيه حاليا","details"=>array()]],401);

                }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No banks account currently","details"=>array()]],401);
            }


            $banksRecord = array();
            $allBanksAcc = array();

            foreach ($term as $key => $value) {
                $banksRecord = [
                    "account_name"     =>$value->account_name,
                    "account_number"   =>$value->account_number,
                    "bank_name"        =>$value->bank_name,
                    "statement"        =>$value->statement
                ];
                array_push($allBanksAcc,$banksRecord);
            }


        return response()->json(['success'=>true,"result"=>["all_acc"=>$allBanksAcc]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>""]],500);
        }

    }

    public function socailMedia(Request $request)
    {
        $lang = parent::detectLang($request);
        if($social = pagesApiModel::getsocial()){

            if(empty($social)){
                if($lang == '_ar'){
                    return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"لاتوجد مواقع تواصل  حاليا","details"=>array()]],401);

                }
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"No social media currently","details"=>array()]],401);
            }


            $banksRecord = array();
            $allSocialMeidia = array();

            foreach ($social as $key => $value) {
                $socialRecord = [
                    "social_id"         =>$value->social_id,
                    "social_link"       =>$value->social_link,
                ];
                array_push($allSocialMeidia,$socialRecord);
            }


        return response()->json(['success'=>true,"result"=>["all_social"=>$allSocialMeidia]],200);

        }else{
            return response()->json(['success'=>false,"error"=>["case"=>0,"message"=>"Please try again ","details"=>""]],500);
        }
    }

}
