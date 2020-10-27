<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\websiteModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Mail;
use App\Mail\replyMsg;
use App\Mail\sendMsg;
use Illuminate\Support\Arr;

use App\models\admin\reservationsModel;

class websiteController extends Controller
{
    public function getAd()
    {
        $getAd = websiteModel::getAd();
        return view('admin.website.ads',[
            'getAd'=>$getAd
        ]);
    }
    public function editAd(Request $request)
    {
        // return $request->all();

        $request->validate([
            'ads_title'=>'required',
            'ads_title_ar'=>'required',
            'ads_details'=>'required',
            'ads_details_ar'=>'required',
            'ads_andriod_link'=>'required',
            'ads_ios_link'=>'required',
            'ads_cover_photo'=>'image|max:1024|mimes:png,jepg,jpg',
        ]);

        $data = $request->except('_token','_method');
        if($request->has('ads_cover_photo')){
            
            $file_name= time() . '.' . $request->ads_cover_photo->extension();
            $request->ads_cover_photo->move(storage_path('app/public/images'), $file_name);
            $oldPhotoName = websiteModel::getAppPhoto();
            if(Storage::delete('public/images/'.$oldPhotoName)){
                $data['ads_cover_photo'] = $file_name;
                websiteModel::editAdv($data);
                return redirect()->back()->with('Success','Infromation has been updated');
            }

        }

        $data = $request->except('_token','_method');
        websiteModel::editAdv($data);
        return redirect()->back()->with('Success','Infromation has been updated');

        
    }

    public function getInfo()
    {
        $info = websiteModel::getInfo();
        return view('admin.website.website_info',[
            'info'=>$info
        ]);
    }

    public function editInfo(Request $request)
    {
        // return $request->all();

        $request->validate([
            'info_mail'=>'required',
            'info_phone'=>'required',
            'info_city'=>'required',
            'info_city_ar'=>'required',
            'info_country'=>'required',
            'info_country_ar'=>'required',
            

        ]);

        
        $logo1 = false;
        $logo2 = false;

        if($request->has('logo')){
            $request->validate([
                'logo'=>'required|image|max:1024|mimes:png,jepg,jpg',
            ]);

            $file_name= time() . '.' . $request->logo->extension();
            $request->logo->move(storage_path('app/public/images/logo'), $file_name);
            sleep(2);
            $logo1 = true;

            $oldPhotoName = websiteModel::getInfoLogo();
            if(Storage::delete('public/images/logo/'.$oldPhotoName)){
                $data = $request->except('_token','_method','logo2');
                $data['logo'] = $file_name;
                websiteModel::editInfo($data);
                // return redirect()->back()->with('Success','Infromation has been updated');
            }

        }

        if($request->has('logo2')){
            $request->validate([
                'logo2'=>'required|image|max:1024|mimes:png,jepg,jpg',
            ]);

            $file_name2 = time() . '.' . $request->logo2->extension();
            $request->logo2->move(storage_path('app/public/images/logo'), $file_name2);
            sleep(2);
            $logo2 = true;

            $oldPhotoName2 = websiteModel::getInfoLogo2();
            if(Storage::delete('public/images/logo/'.$oldPhotoName2)){
                $data = $request->except('_token','_method','logo');
                $data['logo2'] = $file_name2;
                websiteModel::editInfo($data);
                // return redirect()->back()->with('Success','Infromation has been updated');
            }

        }

        if($logo1 == false && $logo2 == false){
            $data = $request->except('_token','_method');
            websiteModel::editInfo($data);
        }
        
        return redirect()->back()->with('Success','Infromation has been updated');

        
    }

    public function getSocial()
    {
        $socials = websiteModel::getSocial();
        return view('admin.website.social',[
            'socials'=>$socials
        ]);
    }

    public function editSocial(Request $request,$social_id)
    {
        // return $request->all();
        $request->validate([
            'social_link'=>'required',
            'social_photo'=>'image|max:1024|mimes:png,jepg,jpg',
            
        ]);

        if($request->has('social_photo')){

            $file_name= time() . '.' . $request->social_photo->extension();
            $request->social_photo->move(storage_path('app/public/images'), $file_name);
            $oldPhotoName = websiteModel::getAppPhoto();
            if(Storage::delete('public/images/'.$oldPhotoName)){
                $data['social_photo'] = $file_name;
                websiteModel::editSocial($data,$social_id);
                return redirect()->back()->with('Success','Infromation has been updated');
            }

        }

        $data = $request->except('_token','_method');
        websiteModel::editSocial($data,$social_id);
        return redirect()->back()->with('Success','Infromation has been updated');
    }

    public function allResets()
    {
        $allResets = websiteModel::getAllResets();
        return view('admin.website.resets',[
            'allResets' => $allResets
        ]);
    }

    public function deleteReset($reset_id)
    {
        websiteModel::deleteReset($reset_id);
        return redirect()->back()->with('Success','Reset id : '.$reset_id.' has been deleted');
    }

    public function getPages()
    {
        $allPages = websiteModel::getAllPages();
        $pages = [
            1=>[
                'page'=>'Splash',
                'page_ar'=>'اسبلاش',
                'app'=>'Mobile',
            ],
            2=>[
                'page'=>'ًWelcome Screen 1',
                'page_ar'=>'شاشة افتتاحية 1',
                'app'=>'Mobile',
            ],
            3=>[
                'page'=>'Screen 2',
                'page_ar'=>'شاشة افتتاحية 2',
                'app'=>'Mobile',
            ],
            4=>[
                'page'=>'Screen 3',
                'page_ar'=>'شاشة افتتاحية 3',
                'app'=>'Mobile',
            ],
            18=>[
                'page'=>'Complete Reservation',
                'page_ar'=>'أتمام الحجز',
                'app'=>'Mobile',
            ],
            34=>[
                'page'=>'About Us',
                'page_ar'=>'من نحن',
                'app'=>'Mobile , Web',
            ],
            39=>[
                'page'=>'Contact Us',
                'page_ar'=>'تواصل معنا',
                'app'=>'Mobile , Web',
            ],
        ];
      
        return view('admin.website.allPages',[
            'pages'=>$pages,
            'allPages'=>$allPages,
        ]);
    }

    public function getEditPage($id)
    {
        $page =  websiteModel::getPage($id);
        return view('admin.website.editPage',[
            'page'=>$page,
        ]);
    }

    public function editPage(Request $request,$page_id)
    {
        $request->validate([
            'title'=>'required',
            'title_ar'=>'required',
            'details'=>'required',
            'details_ar'=>'required',
        ]);
        
        $data = $request->except('_token','_method');
        if($request->has('page_photo')){
            $request->validate([
                'page_photo'=>'image|mimes:png,jpg,jpeg'
            ]);

            $file_name= time() . '.' . $request->page_photo->extension();
            $request->page_photo->move(storage_path('app/public/images'), $file_name);
            $oldPhotoName = websiteModel::getPagePhoto($page_id);
            if(Storage::delete('public/images/'.$oldPhotoName)){
                $data['page_photo'] = $file_name;
                websiteModel::editPages($data,$page_id);
                return redirect()->back()->with('Success','Infromation has been updated');
            }

        }

    
        websiteModel::editPages($data,$page_id);
        return redirect()->back()->with('Success','Infromation has been updated');
    }

    public function getMessages($message_id = null)
    {        
        $openModal = null;
        if($message_id){
            $openModal = $message_id;
            websiteModel::markMessage($message_id);
        }
        $allMessages =  websiteModel::getAllMessages();
        return view('admin.website.messages',[
            'allMessages'=>$allMessages,
            'openModal'=>$openModal,
        ]);
    }

    public function getSentMessages()
    {
        $allSentMessages =  websiteModel::getAllSentMessages();
        return view('admin.website.sentMessages',[
            'allSentMessages'=>$allSentMessages,
        ]);
    }
    

    public function replyMsg(Request $request)
    {
        $request->validate([
            'message_id'=>'required|exists:contact_us',
            'message_reply'=>'required',
            'student_email'=>'required|exists:students',
            
        ]);

        $res = Mail::to($request->student_email)->send(new replyMsg($request->message_reply));
        if ($res == null){
            $data = $request->except('_token','_method','student_email');
            websiteModel::updateReply($data);
            return redirect()->back()->with('Success','Reply has been sent');
        }
        return redirect()->back()->with('Error','Error in Sending Email');

       
    }

    public function deleteMsg($message_id)
    {
        if(websiteModel::deleteMsg($message_id)){
            return redirect()->back()->with('Success','Infromation has been updated');
        }
        return redirect()->back()->with('Error','Something went wrong');

    }

    public function getSendMsg()
    {
        
        return view('admin.website.send_message',[
        ]);

    }

    public function sendMsg(Request $request)
    {
        // return $request->all();
        // echo('<preg>');
        // print_r($request->attachment);
        // echo('</preg>');return 'ok';


        $request->validate([
            'message_reply'=>'required',
            'student_email'=>'required|exists:students',
            'subject'=>'required',
        ]);

        if($request->has('attachment')){
            $request->validate([
                'attachment'=>'required|max:32768'
            ]);
            $file_name= time() . '.' . $request->attachment->extension();
            $mime =  $request->attachment->getClientMimeType();
            $request->attachment->move(public_path('attachments'), $file_name);
            $attachementFullPath = public_path('attachments\\'.$file_name);
            // return $attachementFullPath;
            $data['attachementFullPath'] = $attachementFullPath;
            // $data['attachment'] = $request->attachment;
            
            $data['extension'] =  $request->attachment->getClientOriginalExtension();
            // return $data['attachment']->getClientMimeType();
            $data['attachment_type'] = $mime;
            $data['attachment'] = $file_name;
                // return $data['attachment_type'];
            // $data['extension'] = $request->attachment->extension();

        }

        if($request->has('includeLogo')){
            if($request->includeLogo == 1){
                $logo = reservationsModel::getLogo();
                $logoPath = 'storage\images\logo\\';
                $logoFullPath = public_path($logoPath.$logo);
                $data['logo'] = $logoFullPath;
            }else{
                return redirect()->back();
            }
        }

        $data['message'] = $request->message_reply;
        $data['subject'] = $request->subject;
        $data['addressee_email'] = $request->student_email;
        // return $data;
        $res = Mail::to($request->student_email)->send(new sendMsg($data));
        if ($res == null){
            $data =  Arr::except($data, 'attachementFullPath');
            $data =  Arr::except($data, 'extension');
            $data =  Arr::except($data, 'attachment_type');
            // return $data;

            websiteModel::insertMsg($data);
            return redirect()->back()->with('Success','Message has been Sent');
        }
        return redirect()->back()->with('Error','Error in Sending Email');
    }
    
}
