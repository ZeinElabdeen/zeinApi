<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\ResponseController;
use App\Models\Answer;
use App\Models\Category;
use Validator;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;


class QuestionController extends ResponseController
{
    public function index()
    {
        $data = Question::orderBy('id','desc')->get();
        return view('dashboard.question.index',compact('data'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.question.create',compact('categories'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|regex:/[اأإء-ي]/ui',
            'category'  => 'required|integer|exists:categories,id',
            'type'  => 'required|integer|in:1,2',
            'answers'  => 'required|array',
            'image' => 'image|mimes:jpg,jpeg,png|max:5120',
        ]);
        if($request->hasFile('image'))
        {
          $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
          $imageMove = request()->file('image')->move(public_path('uploads/questions'),$imageName);
          if (!$imageMove) {
              return back()->with('error',trans('response.failed_image'));
          }
          $inputs['image'] = $imageName;
        }

        $inputs['title'] = $request->title;
        $inputs['type'] = $request->type;
        $inputs['category_id'] = $request->category;

        $create = Question::create($inputs);
        if (!$create) {
            return back()->with('error',trans('response.failed'));
        }
        foreach (request()->answers as $answer){
            if($answer != null){
                Answer::create([
                'question_id' => $create->id,
                'title' => $answer
            ]);
            }

        }
        return back()->with('success',trans('response.added'));
    }

    public function edit($id)
    {
        $this->validate(request(),['id' => $id],[
            'id'  => 'required|integer|exists:questions,id',
        ]);
        $data = Question::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.question.edit', compact('data','categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'  => 'required|integer|exists:questions,id',
            'title'  => 'required|string|regex:/[اأإء-ي]/ui',
            'category'  => 'required|integer|exists:categories,id',
            'type'  => 'required|integer|in:1,2',
            'image' => 'image|mimes:jpg,jpeg,png|max:5120',

        ]);
          $question = Question::find($request->id);


        if($request->hasFile('image'))
        {
          $imageName = md5(time()). '.'.request()->file('image')->getClientOriginalExtension();
          $imageMove = request()->file('image')->move(public_path('uploads/questions'),$imageName);
          if (!$imageMove) {
              return back()->with('error',trans('response.failed_image'));
          }
          $inputs['image'] = $imageName;
        }else{
          $inputs['image'] = $question->image;
        }
        $inputs['title'] = $request->title;
        $inputs['category'] = $request->category;
        $inputs['type'] = $request->type;

        $update = $question->update($inputs);

        if (!$update) {
            return back()->with('error',trans('response.failed'));
        }
        return back()->with('success',trans('response.updated'));
    }

    public function delete($id)
    {
        Validator::make(['id' => $id],[
            'id'  => 'required|integer|exists:questions,id',
        ])->validate();
        $question = Question::findOrFail($id);

        $delete = $question->delete();
        if (!$delete) {
            return back()->with('error','حدث شئ ما خطأ يرجى المحاولة مرة أخرى');
        }
        foreach ($question->answers as $answer) {
            $answer->delete();
        }
        return back()->with('success','تم حذف السؤال بنجاح');

    }

    public function import_execl()
    {
        $categories = Category::all();
        return view('dashboard.question.import_execl',compact('categories'));
    }

    public function import_execl_exe(Request $request)
    {
        $request->validate([
            'category'  => 'required|integer|exists:categories,id',
            'type'  => 'required|integer|in:1,2',
            'fileup' => 'required',
        ]);

        $arrin['type'] = $request->type;
        $arrin['category_id'] = $request->category;

        $path = $request->file('fileup')->getRealPath();
        $data = \Excel::load($path)->get();
        //dd($data);
		//set_time_limit(300);

        if($data->count())
        {
            for($i=0; $i < $data->count();$i++) {
				
			 if( !empty($data[$i]['ques']) ): 	
				  $arrin['title'] =  $data[$i]['ques'] ;
				  $arrin['image'] =  $data[$i]['image'] ;
				  $arrin['addfrom'] =  '2' ;
				  $create_qes = Question::create($arrin);
					for($j=1; $j < 5;$j++) {
					if( !empty($data[$i]['ans'.$j]) ):	
						  Answer::create([
						  'question_id' => $create_qes->id,
						  'title' => $data[$i]['ans'.$j]
						  ]);
					endif;  
				   }
			 endif;  
            }

       }
    return back()->with('success',trans('response.added'));
  }

  public function import_images()
  {
      return view('dashboard.question.import_images');
  }

  public function import_images_exe(Request $request)
  {
      $request->validate([
          'imageUpload' => 'required',
          'imageUpload.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);

      if($request->hasfile('imageUpload'))
      {
        foreach($request->file('imageUpload') as $image)
        {
               $name=$image->getClientOriginalName();
               $imageMove = $image->move(public_path().'/uploads/questions/', $name);

               if (!$imageMove) {
                   return back()->with('error',trans('response.failed_image'));
               }

               $qes = DB::table('questions')->where('image', $name)
                                            ->where('is_uploaded','0')
                                            ->where('addfrom','2')->get();
               foreach ($qes as $row) {
                 $x = DB::table('questions')
                 ->where('id',$row->id)
                 ->update(array('is_uploaded'=> '1' ));
               }
        }
            return back()->with('success',trans('response.updated'));
      }

  }



}
