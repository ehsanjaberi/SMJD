@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>نمرات دانشجویان</h5>
        </section>
        <section class="content-body">
            <div class="row text-right mb-4">
                <div class="col-md-4">
                    <label for="UniversityId">دانشگاه</label>
                    <select name="University" id="UniversityId" class="form-control" onchange="SemesterSearch(this)">
                        @foreach($University as $uni)
                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="loader" hidden id="SemesterLoader" style="top: 40px;margin: 0;left: 40px;">Loading...</div>
                    <label for="SemesterId">نیمسال</label>
                    <select name="SemesterId" id="SemesterId" class="form-control" onchange="LessonSearch(this)">
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="loader" hidden id="LessonListLoader" style="top: 40px;margin: 0;left: 40px;">Loading...</div>
                    <label for="LessonList">دروس</label>
                    <select name="LessonList" id="LessonList" class="form-control" onchange="SearchStudent(this)">

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="#" id="FormDataGrade">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                <tr id="TableHeading">
                                    <th scope="col" class="text-center" style="width: 20px;">#</th>
                                    <th scope="col" class="text-right" style="width: 150px;">شماره دانشجویی</th>
                                    <th scope="col" class="text-right">نام و نام خانوادگی</th>
                                    <th scope="col" class="text-center" style="width: 100px;">نمره نهایی از 0</th>
                                </tr>
                                </thead>
                                <tbody id="StudentList">

                                </tbody>
                            </table>
                        </div>
                    </form>
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
            document.getElementById('UniversityId').onchange();
        })
        function SemesterSearch($this) {
            let UniversityId=$($this).val();
            if (UniversityId !== '') {
                document.getElementById('SemesterLoader').removeAttribute('hidden');
                axios.post('{{ route('SemesterLessonGetSemester') }}',{
                    '_token':'{{csrf_token()}}',
                    'UniversityId':UniversityId,
                })
                    .then((response)=>{
                        document.getElementById('SemesterLoader').setAttribute('hidden','hidden');
                        let SemesterList=document.getElementById('SemesterId');
                        let LessonList=document.getElementById('LessonList');
                        SemesterList.options.length=0;
                        LessonList.options.length=0;
                        SemesterList.options[SemesterList.options.length]=new Option('انتخاب ترم تحصیلی','');
                        LessonList.options[LessonList.options.length]=new Option('انتخاب درس','');
                        response.data.forEach(function(Semester) {
                            SemesterList.options[SemesterList.options.length]=new Option(Semester.Name,Semester.id)
                        });
                    })
            }

        }
        function LessonSearch($this) {
            let LessonId=$($this).val();
            if (LessonId !== '') {
                document.getElementById('LessonListLoader').removeAttribute('hidden');
                axios.post('{{ route('SemesterLessonGetSemesterLesson') }}',{
                    '_token':'{{csrf_token()}}',
                    'SemesterId':LessonId,
                })
                    .then((response)=>{
                        document.getElementById('LessonListLoader').setAttribute('hidden','hidden');
                        let LessonList=document.getElementById('LessonList');
                        LessonList.options.length=0;
                        LessonList.options[LessonList.options.length]=new Option('انتخاب درس','');
                        response.data.forEach(function(Lesson) {
                            LessonList.options[LessonList.options.length]=new Option(Lesson.lesson.Name,Lesson.id)
                        });
                    })
            }
        }
        function SearchStudent($this) {
            let SemesterLessonId=$($this).val();
            if (SemesterLessonId !== '') {
                document.getElementById('LessonListLoader').removeAttribute('hidden');
                axios.post('{{ route('StudentGradeSemesterLessonStudent') }}',{
                    '_token':'{{csrf_token()}}',
                    'LessonId':SemesterLessonId,
                })
                    .then((response)=>{
                        document.getElementById('LessonListLoader').setAttribute('hidden','hidden');
                        SetHeading(response.data.grade_types);
                        SetRows(response.data.semester_lesson_student,response.data.grade_types,response.data.id);
                    })
            }
        }
        function SetHeading(Data) {
            let MaxGrade=0;
            console.log(Data)
            let html='<th scope="col" class="text-center" style="width: 20px;">#</th>';
            html +='<th scope="col" class="text-right" style="width: 150px;">شماره دانشجویی</th>';
            html+='<th scope="col" class="text-right">نام و نام خانوادگی</th>';
            Data.forEach(function(Head,index) {
                var temp=`
                        <th scope="col" class="text-center">${Head.grade_type.Name}(${Head.MaxGrade} نمره)</th>
                        `;
                html+=temp;
                MaxGrade += Head.MaxGrade;
            });
            html+=`<th scope="col" class="text-center" style="width: 150px;">نمره نهایی از${MaxGrade}</th>`;
            html+=`<th scope="col" class="text-center" style="width: 50px;">عملیات</th>`;
            document.getElementById('TableHeading').innerHTML=html;
        }
        function SetRows(Data,Head,SemesterId) {
            let html=``;
            Data.forEach(function(SemesterLesson,index) {
                var temp=`<tr><th scope="row" class="text-center">${ index+1 }</th><td class="text-right">${ SemesterLesson.student.PersonalCode}</td><td class="text-right">${ SemesterLesson.student.person.Name+' '+SemesterLesson.student.person.Family }</td>`;
                let FinalGrade=0;
                Head.forEach(function(Head,index) {
                    var val=0;
                    SemesterLesson.student.grades.forEach(function (grade) {
                        if (Head.id == grade.SemesterLessonGradeId)
                        {
                            temp+=`<td class="text-center" id="data">
                                <input type="number" value="${grade.Grade}" name="${Head.id}" dir="ltr" min="0" class="form-control form-control-sm d-inline text-center" style="width: 59px;">
                           </td>`;
                            val=1;
                            FinalGrade+=grade.Grade;
                        }
                    })
                    if (val==0){
                        temp+=`<td class="text-center" id="data">
                                <input type="number" name="${Head.id}" dir="ltr" min="0" class="form-control form-control-sm d-inline text-center" style="width: 59px;">
                           </td>`;
                    }
                });
                temp+=`<td class="text-center" id="FinalGrade">${FinalGrade}</td>
                        <td class="text-center">
                            <span class="fa fa-edit text-primary cursor-pointer" onclick="Store(this,${SemesterLesson.student.id},${SemesterId})"></span>
                        </td>
                        </tr>`;
                html+=temp;
            });
            document.getElementById('StudentList').innerHTML=html;
        }
        function Store($this,StudentId,SemesterId) {
            let td=$($this).parent().siblings('#data').find('input');
            StudentGrade=[];
            FGrade=0;
            for (var i=0;i<td.length;i++)
            {
                StudentGrade.push($(td[i]).attr("name")+'|'+$(td[i]).val());
                FGrade+= Number($(td[i]).val());
            }
            axios.post('{{ route('StudentGradeAdd') }}', {
                '_token':'{{ csrf_token() }}',
                'SemesterLessonId':SemesterId,
                'StudentId':StudentId,
                'StudentGrade':StudentGrade
            })
            .then((response)=>{
                console.log(response.data);
                if (response.data==true){
                    ShowMsg('ذخیره شد.','green');
                    $($this).parent().siblings('#FinalGrade').text(FGrade);
                }
                else{
                    ShowMsg('خطا رخ داده،لطفا دوباره امتحان کنید.','red');
                }
            })
            .catch((error)=>{
                console.log(error);
            })
        }
        function ShowMsg(text,bgcolor) {
            document.getElementById('ShowMsg').children[1].textContent=text;
            document.getElementById('ShowMsg').style.opacity=1;
            document.getElementById('ShowMsg').style.backgroundColor=bgcolor;
            setTimeout(function () {
                document.getElementById('ShowMsg').style.opacity=0;
            },1500)
        }
    </script>
@endsection
