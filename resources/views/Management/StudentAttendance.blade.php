@extends('layouts.app')
@section('head')

@endsection
@section('content')
<!--Main-Content-->
<div class="main-content p-3">
    <section class="content-header p-2 text-right d-flex justify-content-between">
        <h5>حضور غیاب دانشجو</h5>
    </section>
    <section class="content-body">
        <form action="{{ route('GetSemesterLessonStudentAttendance') }}" method="post" id="SemesterLessonStudentList">
            @csrf
            <div class="row text-right mb-4">
                <div class="col-md-3">
                    <label for="">دانشکده</label>
                    <select name="CollegeId" id="CollegeId" class="form-control" onchange="SemesterLessonSearch(this)">
                        @foreach($College as $college)
                            <option value="{{ $college->id }}">{{ $college->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <div class="loader" hidden id="LessonCircleLoader" style="top: 5px;margin: 0;right: 97px;">Loading...</div>
                    <label for="LessonList">لیست دروس</label>
                    <select name="LessonList" id="LessonList" class="form-control" onchange="SemesterLessonSelect(this)">
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="loader" hidden id="HoldingDateCircleLoader" style="top: 5px;margin: 0;right: 97px;">Loading...</div>
                    <label for="">تاریخ برگزاری</label>
                    <select name="HoldingDate" id="HoldingDate" class="form-control">

                    </select>
                </div>
                <div class="col-md-1 mt-auto">
                    <div class="loader" hidden id="StudentListCircleLoader" style="top: 8px;margin: 0;left: -21px;">Loading...</div>
                    <button type="submit" class="btn btn-primary">جستجو</button>
                </div>
            </div>
        </form>
        <div class="row">
            <ul class="list-unstyled w-100 d-flex justify-content-around pr-3" id="ClassInf">
                <li>عنوان کلاس:<span class="text-primary"></span> </li>
                <li>نام درس:<span class="text-primary"></span> </li>
                <li>استاد:<span class="text-primary"></span> </li>
            </ul>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="text-center" style="width: 20px;">#</th>
                            <th scope="col" class="text-right" style="width: 150px;">شماره دانشجویی</th>
                            <th scope="col" class="text-right">نام و نام خانوادگی</th>
                            <th scope="col" class="text-right">وضعیت حضور</th>
                        </tr>
                        </thead>
                        <tbody id="StudentList">

                        </tbody>
                    </table>
                    <ul class="pagination justify-content-center flex-row-reverse">
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <small class="custom-message" id="ShowMsg" style="opacity: 0;pointer-events: none">
        <i class="fa fa-exclamation-circle"></i>
        <span>پیغام اینجا نمایش داده می شود.</span>
    </small>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            document.getElementById('CollegeId').onchange();
        })
        function SemesterLessonSearch($this) {
            let CollegeId=$($this).val();
            if (CollegeId !== '') {
                document.getElementById('LessonCircleLoader').removeAttribute('hidden');
                axios.post('{{ route('StudentAttendanceGetLesson') }}',{
                    '_token':'{{csrf_token()}}',
                    'CollegeId':CollegeId,
                })
                .then((response)=>{
                    let SemesterLessonList=document.getElementById('LessonList');
                    let HoldingDateList=document.getElementById('HoldingDate');
                    SemesterLessonList.options.length=0;
                    HoldingDateList.options.length=0;
                    SemesterLessonList.options[SemesterLessonList.options.length]=new Option('انتخاب درس','');
                    HoldingDateList.options[HoldingDateList.options.length]=new Option('تاریخ برگزاری','');
                    document.getElementById('LessonCircleLoader').setAttribute('hidden','hidden');
                    response.data.forEach(function(Lesson) {
                        if (Lesson.Week==0){var Week='هر هفته';}
                        else if(Lesson.Week==1){var Week='هفته زوج';}
                        else if(Lesson.Week==2){var Week='هفته فرد';}
                        SemesterLessonList.options[SemesterLessonList.options.length]=new Option(Lesson.LessonName+'('+Lesson.TeacherName+')'+'|کد:'+Lesson.LessonCode+'|'+Week,Lesson.ScheduleId)
                    });
                })
            }
        }
        function SemesterLessonSelect($this) {
            let ScheduleId=$($this).val();
            if (ScheduleId !== '') {
                document.getElementById('HoldingDateCircleLoader').removeAttribute('hidden');
                axios.post('{{ route('StudentAttendanceGetHoldingDate') }}',{
                    '_token':'{{csrf_token()}}',
                    'ScheduleId':ScheduleId,
                    'CollegeId':document.getElementById('CollegeId').value,
                })
                    .then((response)=>{
                        document.getElementById('HoldingDateCircleLoader').setAttribute('hidden','hidden');
                        let HoldingDateList=document.getElementById('HoldingDate');
                        HoldingDateList.options.length=0;
                        HoldingDateList.options[HoldingDateList.options.length]=new Option('تاریخ برگزاری','');
                        response.data.forEach(function(HoldingDate) {
                            HoldingDateList.options[HoldingDateList.options.length]=new Option(HoldingDate.replaceAll('-','/'),HoldingDate)
                        });
                    })
            }
        }
        document.getElementById('SemesterLessonStudentList').addEventListener('submit',function (event) {
            event.preventDefault();
            let date=document.getElementById('HoldingDate').value;
            let lesson=document.getElementById('LessonList').value;
            if (date!='' && lesson!='') {
                document.getElementById('StudentListCircleLoader').removeAttribute('hidden');
                let Form=new FormData(this);
                axios.post(this.action,Form)
                    .then((response)=>{
                        console.log(response.data);
                        document.getElementById('ClassInf').innerHTML=`
                    <li>عنوان کلاس:<span class="text-primary">${response.data.ClassInf.ClassTitle}</span> </li>
                    <li>نام درس:<span class="text-primary">${response.data.ClassInf.LessonName}</span> </li>
                    <li>استاد:<span class="text-primary">${response.data.ClassInf.TeacherName}</span></li>
                `;
                        let html='';
                        response.data.StudentList.forEach(function (Student,index) {
                            if (Student.Status==0){
                                var status=`
                            <a href="#" class="btn btn-sm btn-success" id="PRBtn${index}" onclick="AttendPr(${Student.StudentCode} , ${index})">حاضر</a>
                            <a href="#" class="btn btn-sm btn-danger" id="ABBtn${index}" onclick="AttendAb(${Student.StudentCode} , ${index})">غایب</a>
                            <div class="loader" hidden id="Attend${index}" style="top: 19px;margin: 0;right: -15px;">Loading...</div>
                        `;
                            }else if(Student.Status=='1'){
                                var status=`
                            حاضر
                            <a href="#" class="btn btn-sm btn-success" hidden id="PRBtn${index}" onclick="AttendPr(${Student.StudentCode} , ${index})">حاضر</a>
                            <a href="#" class="btn btn-sm btn-danger" id="ABBtn${index}" onclick="AttendAb(${Student.StudentCode} , ${index})">غایب</a>
                            <div class="loader" hidden id="Attend${index}" style="top: 19px;margin: 0;right: -15px;">Loading...</div>
                        `;
                            }
                            else if(Student.Status==2){
                                var status=`
                            غایب
                            <a href="#" class="btn btn-sm btn-success" id="PRBtn${index}" onclick="AttendPr(${Student.StudentCode} , ${index})">حاضر</a>
                            <a href="#" class="btn btn-sm btn-danger" hidden id="ABBtn${index}" onclick="AttendAb(${Student.StudentCode} , ${index})">غایب</a>
                            <div class="loader" hidden id="Attend${index}" style="top: 19px;margin: 0;right: -15px;">Loading...</div>
                        `;
                            }
                            var temp=`<tr>
                            <th scope="row" class="text-center">${index+1}</th>
                            <td class="text-right">${Student.StudentCode}</td>
                            <td class="text-right">${Student.StudentName}</td>
                            <td class="text-right" style="position:relative;">
                                ${status}
                            </td>
                        </tr>`
                            html+=temp;
                        })
                        document.getElementById('StudentList').innerHTML=html;
                        document.getElementById('StudentListCircleLoader').setAttribute('hidden','hidden');
                    })
                    .catch((error)=>{
                        console.log(error);
                    })
            }
            else {
                ShowMsg('لطفا درس و تاریخ برگزاری کلاس را مشخص کنید.','red')
            }
        })
        function ShowMsg(text,bgcolor) {
            document.getElementById('ShowMsg').children[1].textContent=text;
            document.getElementById('ShowMsg').style.opacity=1;
            setTimeout(function () {
                document.getElementById('ShowMsg').style.opacity=0;
            },2000)
        }
        function AttendAb(StNo,Loader) {
            document.getElementById('Attend'+Loader).removeAttribute('hidden');
            axios.post('{{ route('StudentAttendanceAB') }}',{
                '_token':'{{ csrf_token() }}',
                'ScheduleId':document.getElementById('LessonList').value,
                'StudentNumber':StNo,
                'HoldingDate':document.getElementById('HoldingDate').value,
            })
            .then((response)=>{
                document.getElementById('ABBtn'+Loader).setAttribute('hidden','hidden');
                document.getElementById('PRBtn'+Loader).removeAttribute('hidden');
                document.getElementById('Attend'+Loader).setAttribute('hidden','hidden');
            })
            .catch((error)=>{
                console.log(error.data)
            })
        }
        function AttendPr(StNo,Loader) {
            document.getElementById('Attend'+Loader).removeAttribute('hidden');
            axios.post('{{ route('StudentAttendancePR') }}',{
                '_token':'{{ csrf_token() }}',
                'ScheduleId':document.getElementById('LessonList').value,
                'StudentNumber':StNo,
                'HoldingDate':document.getElementById('HoldingDate').value,
            })
                .then((response)=>{
                    console.log(response.data);
                    document.getElementById('PRBtn'+Loader).setAttribute('hidden','hidden');
                    document.getElementById('ABBtn'+Loader).removeAttribute('hidden');
                    document.getElementById('Attend'+Loader).setAttribute('hidden','hidden');
                })
                .catch((error)=>{
                    console.log(error.data)
                })
        }
    </script>
@endsection
