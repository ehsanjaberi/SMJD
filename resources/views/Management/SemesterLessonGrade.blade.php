@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>انواع نمرات</h5>
        </section>
        <section class="content-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 20px;">#</th>
                                    <th scope="col" class="text-right" style="width: 100px;">نوع نمره</th>
                                    <th scope="col" class="text-center" style="width: 100px;">سقف نمره</th>
                                    <th scope="col" class="text-center" style="width: 100px;">عملیات</th>
                                </tr>
                                </thead>
                                <tbody id="GradeList">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header text-right" id="FormTitle">
                            افزودن نمره
                        </div>
                        <form action="{{ route('AddSemesterLessonGrade') }}"method="post" id="AddSemesterLessonGradeForm">
                            @csrf
                            <div class="card-body text-right">
                                <div class="row text-right">
                                    <div class="col-md-12">
                                        <label for="UniversityId">دانشکده</label>
                                        <select name="UniversityId" id="UniversityId" class="form-control" onchange="SemesterSearch(this)">
                                            @foreach($University as $uni)
                                                <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-md-12">
                                        <div class="loader" hidden id="SemesterLoader" style="top: 40px;margin: 0;left: 40px;">Loading...</div>
                                        <label for="SemesterId">نیمسال</label>
                                        <select name="SemesterId" id="SemesterId" class="form-control" onchange="LessonSearch(this)">

                                        </select>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-md-12">
                                        <div class="loader" hidden id="LessonListLoader" style="top: 40px;margin: 0;left: 40px;">Loading...</div>
                                        <label for="LessonList">لیست دروس</label>
                                        <select name="LessonList" id="LessonList" class="form-control" onchange="SearchGradeType(this)">

                                        </select>
                                    </div>
                                </div>
                                <div class="row text-right mb-4">
                                    <div class="col-md-6">
                                        <label for="GradeType">نوع نمره</label>
                                        <select name="GradeType" id="GradeType" class="form-control">
                                            @foreach($GradeType as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="MaxGrade">سقف نمره</label>
                                        <input type="text" name="MaxGrade" id="MaxGrade" class="form-control" placeholder="سقف نمره">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer position-relative">
                                <button type="submit" class="btn btn-primary">ذخیره</button>
                                <div class="loader" hidden id="FormSubmitLoader" style="top: 23px;margin: 0;left: 91px;">Loading...</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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
        function SearchGradeType($this) {
            let SemesterLessonId=$($this).val();
            if (SemesterLessonId !== '') {
                document.getElementById('LessonListLoader').removeAttribute('hidden');
                axios.post('{{ route('SemesterLessonGradeType') }}',{
                    '_token':'{{csrf_token()}}',
                    'LessonId':SemesterLessonId,
                })
                    .then((response)=>{
                        document.getElementById('LessonListLoader').setAttribute('hidden','hidden');
                        SetRows(response.data);
                    })
            }
        }
        document.getElementById('AddSemesterLessonGradeForm').addEventListener('submit',function (event) {
            event.preventDefault();
            document.getElementById('FormSubmitLoader').removeAttribute('hidden');
            let Form = new FormData(this);
            axios.post('{{ route('AddSemesterLessonGrade') }}',Form)
            .then((response)=>{
                document.getElementById('FormSubmitLoader').setAttribute('hidden','hidden');
                SetRows(response.data);
            })
            .catch((error)=>{
                console.log(error);
            })
        })
        function DeleteLessonGrade(id) {
            axios.post('{{ route('DeleteSemesterLessonGrade') }}', {
                'id':id,
                'SemesterLessonId':document.getElementById('LessonList').value
            })
                .then((response)=>{
                    SetRows(response.data);
                })
                .catch((error)=>{
                    console.log(error);
                })
        }
        function SetRows(Data) {
            let html='';
            Data.forEach(function(GradeType,index) {
                var temp=`
                        <tr>
                            <th scope="row" class="text-center">${index+1}</th>
                            <td class="text-right">${GradeType.grade_type.Name}</td>
                            <td class="text-center">${GradeType.MaxGrade}</td>
                            <td class="text-center">
                                <span class="fa fa-trash text-danger cursor-pointer" onclick="DeleteLessonGrade(${GradeType.id})"></span>
                            </td>
                        </tr>`;
                html+=temp;
            });
            document.getElementById('GradeList').innerHTML=html;
        }
    </script>
@endsection
