

<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};">  {{$lang == '' ? 'Applicant\'s Name:' : ' عزيزي الطالب/ة: '}} {{$resrvDetails->student_name}} </p>
<p>&nbsp;</p>
<p style="text-align: center;"> {{$lang == '' ? 'Thank for choosing KAS International Education Consultancy.' : ':  شكرا لاختياركم كاس للخدمات التعليمي'}}</p>
<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};"> {{$lang == '' ? 'Your booking has been confirmed as follows:' : ' لقد تم تأكيد طلبك كما يلي: '}}  </p> 
<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};"> {{$lang == '' ? 'Applicant\'s Name: ' : '  أسم الطالب: '}} {{$resrvDetails->student_name}} </p>
<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};">  {{$lang == '' ? 'Application No.: ' : ' رقم الطلب:'}} {{$resrvDetails->reservation_id}}</p>
<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};">   {{$lang == '' ? 'Institution Name: ' : ' اسم المعهد/الجامعة: '}}  {{$resrvDetails->institute_name}}</p>
<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};">  {{$lang == '' ? 'Country : ' : ' الدولة: '}}   {{$resrvDetails->country}}</p> 
<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};">  {{$lang == '' ? 'City : ' : '  المدينة: '}} {{$resrvDetails->city_name}}</p>

<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};"> {{$lang == '' ? 'Course Name : ' : '  اسم البرنامج: '}} {{$resrvDetails->course_name}}</p> 
<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};"> {{$lang == '' ? 'Starting date : ' : '  تاريخ البداية: '}} {{$resrvDetails->start_at}}</p> 
<p style="text-align: {{$lang == '' ? 'left' : 'right'}};direction: {{$lang == '' ? 'ltr' : 'rtl'}};"> {{$lang == '' ? 'Course duration : ' : '  مدة الدراسة: '}} {{$resrvDetails->reserved_weeks_number}} {{$lang == '' ? 'ًWeeks ' : 'أسابيع'}}</p>
<p style="text-align: center;"> {{$lang == '' ? ' ' : '  سيتم الرد خلال موعد أقصاه خمسة أيام عمل'}} </p> 
<p style="text-align: center; direction: {{$lang == '' ? 'ltr' : 'rtl'}};">{{$lang == '' ? ' For further assistance don’t hesitate to contact us via email on ' : ' للاستفسار او مزيد من المعلومات يرجى التواصل عبر الايميل الالكتروني '}} <a href="mailto:{{$website->info_mail}}">{{$website->info_mail}}</a>  </p>  
<p style="text-align: center;direction: {{$lang == '' ? 'ltr' : 'rtl'}};"> {{$lang == '' ? 'Or on What\'s App ' : '  أو عبر الواتس اب على الرقم:  '}}  </p> <p style="text-align: center"> {{$website->info_phone}} </p>
<p>&nbsp;</p>
<p  style="text-align: center;" "> {{$lang == '' ? ' We will be happy to help you!' : ' تسرنا خدمتكم'}} </p>
<p style="text-align: center;"> {{$lang == '' ? 'Check our Services, latest offers and news on : ' : ' للاطلاع على خدماتنا و عروضنا و أخبارنا تابعونا على'}} </p> 
<p style="text-align: center;direction: {{$lang == '' ? 'ltr' : 'rtl'}};"> {{$lang == '' ? 'Instgram : ' : ' :انستغرام: '}} {{$socialMedia[3]->social_link}}</p> 
<p style="text-align: center;direction: {{$lang == '' ? 'ltr' : 'rtl'}};">  {{$lang == '' ? 'Twitter : ' : '  تويتر: '}} {{$socialMedia[2]->social_link}}</p> 
<p style="text-align: center;direction: {{$lang == '' ? 'ltr' : 'rtl'}};"> {{$lang == '' ? 'Or on our website: : ' : '  أو على موقع المؤسسة:  '}} <a href="{{URL::to('/')}}">{{URL::to('/')}}</a></p> 
<p style="text-align: center;"> {{$lang == '' ? 'Best Regards from KAS' : '  أطيب الأمنيات من كاس'}} </p>  

<div style="margin: auto;width:200px">
    <img src=" {{ $message->embed($fullPath)}} " alt="logo" style="width:200px;height:150px">
</div>
