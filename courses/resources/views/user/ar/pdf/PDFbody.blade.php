
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

   
</head>
<style>
    body { 
        font-family: DejaVu Sans;
        {{$lang == '' ? 'direction: ltr;text-align: left;' : 'direction: rtl;text-align: right;'}}   
        }


    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-size: 1.1em;

    }

    .container {
    width: 100%;
    }


    table { 
	width: 750px; 
	border-collapse: collapse; 
	/* margin:50px auto; */
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

thead th { 
	background: #ffae00; 
	color: white; 
	font-weight: bold; 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: {{$lang == '' ? 'left' : 'right'}}; 
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}
   

</style>
<body>

    <div class="container">
        <div class="row">
            <div class="col-4"  style="width:33.33%;float: {{$lang == '' ? 'right' : 'left'}};text-transform: capitalize;">
                <img src="{{public_path('storage\images\logo\\'.$logo)}}" alt="logo" style="width:100%">
            </div>
            <div class="col-4"  style="width:31.66%;float: {{$lang == '' ? 'right' : 'left'}};text-transform: capitalize;">
                &nbsp;
            </div>
            <div class="col-4"  style="width:35%;float: {{$lang == '' ? 'right' : 'left'}};text-transform: capitalize;">


                <h6 >   {{$resrvDetails->institute_name}}    </h6>
                <h6>     {{ $resrvDetails->country }} , {{ $resrvDetails->city_name }}   </h6>
                <h6 >   {{$website->info_phone}}  </h6>
                <h6 >   {{$website->info_mail}}   </h6>
                <h6 >   {{ url('/') }}   </h6>


            </div>

        </div>
   
        <div class="row">
            <div class="col-12">
               
                <h6 class="lead"> {{$lang == '' ? 'Dear' : 'عزيزي'}} {{$resrvDetails->student_name}}, </h6>
                <h6 class="lead"> {!! $lang==''?'Thank you for your application to '.$resrvDetails->institute_name.', We are pleased to inform you that we are making
                    you a <b class="font-wieght-bolder"> conditional offer   of a place to study at '.$resrvDetails->institute_name.'.':'  . '.$resrvDetails->institute_name.' نحن سعداء لتقديم هذالعرض الشيق في جامعة  '.$resrvDetails->institute_name.' یرجى التأكد من تفاصیل الطلب على النحو التالي:' !!}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered lead">
                    <thead class="bg-warning text-light">
                    <tr>
                        <th colspan=3>  {{$lang == '' ? 'Details of Your Offer' : 'تفاصيل العرض'}}   </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                {{$lang == '' ? 'Name' : 'الاسم'}}
                            </th>
                            <td colspan=2>

                                {{$resrvDetails->student_name}}

                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? ' Course of Study:' : 'اسم الدوره'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->course_name}}

                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? ' Academy:' : 'اسم المعهد'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->institute_name}}

                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? ' Student ID Number:' : 'رقم الطالب'}}

                            </th>
                            <td colspan=2>


                                    {{$resrvDetails->student_id}}

                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? ' Applicant Number:' : 'رقم الحجز'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->reservation_id}}

                            </td>

                        </tr>


                        <tr>
                            <th>
                                {{$lang == '' ? ' Course Start Date:' : 'تاريخ بدء الدوره'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->start_at}}

                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? ' Course End Date:' : 'تاريخ نهاية الدوره'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->end_date}}

                            </td>

                        </tr>


                        <tr>
                            <th>
                                {{$lang == '' ? ' Residence:' : 'الاقامه'}}

                            </th>
                            <td>

                                    {{$resrvDetails->living_name}}

                            </td>
                            <td>

                                    {{$resrvDetails->living_price}}  {{$lang == '' ? 'SAR' : 'رس'}}


                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? 'Insurance:' : 'التأمين'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->medical_insurance_price}} {{$lang == '' ? 'SAR' : 'رس'}}


                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? 'Course Price :' : 'سعر الدوره'}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->week_price * $resrvDetails->reserved_weeks_number }}

                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? ' Registration Fees :' : 'رسوم التسجيل'}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->registration_fees}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </td>

                        </tr>


                        <tr>
                            <th>
                                {{$lang == '' ? ' Residence Fees:' : 'رسوم الأقامه'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->living_fees}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </td>

                        </tr>


                        <tr>
                            <th>
                                {{$lang == '' ? ' Airport Reception:' : 'رسوم الاستقبال '}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->airport_rec_price}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </td>

                        </tr>


                        <tr>
                            <th>
                                {{$lang == '' ? 'Carrier  Fees:' : 'رسوم البريد '}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->mail_fees}} {{$lang == '' ? 'SAR' : 'رس'}}
 
                            </td>

                        </tr>

                        <tr>
                            <th>
                                {{$lang == '' ? 'Summer Fees:' : 'رسوم الأقامة الصيفية'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->summer_fees}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </td>

                        </tr>


                        <tr>
                            <th>
                                {{$lang == '' ? 'Books Fees:' : 'رسوم الكتب'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->book_fees}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </td>

                        </tr>


                        <tr>
                            <th>
                                {{$lang == '' ? 'Vat:' : 'قيمة الضريبة المضافة'}}

                            </th>
                            <td colspan=2>

                                    {{$resrvDetails->tax_fees * 100}} %

                            </td>

                        </tr>

                        <tr class="text-warning">
                            <th>
                                {{$lang == '' ? 'Total' : 'المجموع الكلي'}}
                            </th>
                            <td colspan=2 class="font-weight-bolder">

                                    {{$resrvDetails->total}} {{$lang == '' ? 'SAR' : 'رس'}}

                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <h6>

                    {{$lang == '' ? 'Information about Course:' : 'معلومات الكورس في الرابط التالي:'}}

                </h6>
            </div>
            <div style="margin: auto;text-align: center">
                <h6 >
                    <a href="{{url('courses-details/'.$resrvDetails->course_id)}}" target="_blank">  {{$lang == '' ? 'Click here' : 'أضغط هنا'}} </a>
                </h6>
                <h6>
                    {{$lang == '' ? 'Dear student, the site administration will contact you to submit the application' : 'عزیزي الطالب سوف تقوم إدارة الموقع بالتواصل معك من أجل تقدیم الطلب'}}

                </h6>
            </div>
          
        </div>

    </div>
</body>
</html>
