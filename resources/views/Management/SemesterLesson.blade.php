@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('Plugin/TreeSelect/style.css') }}">
@endsection
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>دروس در ترم</h5>
            <a href="#" data-toggle="modal" data-target="#AddLessonToTerm" class="btn btn-info">
                افزودن
            </a>
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 20px;">#</th>
                                <th scope="col" class="text-right">کد</th>
                                <th scope="col" class="text-right" style="width: 120px">ترم</th>
                                <th scope="col" class="text-right">درس</th>
                                <th scope="col" class="text-right">استاد</th>
                                <th scope="col" class="text-right">مقطع-رشته</th>
                                <th scope="col" class="text-right">دانشگاه</th>
                                <th scope="col" class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($SemesterLesson as $lesson)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                                <td class="text-right">{{ $lesson->Code }}</td>
                                <td class="text-right">{{ $lesson->Semester->Name }}</td>
                                <td class="text-right">{{ $lesson->Lesson->Name }}</td>
                                <td class="text-right">
                                    @foreach($lesson->Teachers as $teacher)
                                        {{ $teacher->Teacher->Person->Name.' '.$teacher->Teacher->Person->Family }}
                                        <br>
                                    @endforeach
                                </td>
                                <td class="text-right">
                                    {{ $lesson->Lesson->Degree->Name.'---'.$lesson->Lesson->Field->Name }}
                                </td>
                                <td class="text-right">{{ $lesson->Lesson->Field->College->University->Name.'('.$lesson->Lesson->Field->College->Name.')' }}</td>
                                <td class="text-center">
                                    <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditLessonToTerm" onclick="EditSemesterLesson({{ $lesson->id }})">
                                        <i class="fa fa-edit text-success"></i>
                                    </a>
                                    <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteLessonToTerm" onclick="DeleteSemesterLesson({{ $lesson->id }})">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center" dir="ltr">
                        {{ $SemesterLesson->render()  }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddLessonToTerm" tabindex="-1" aria-labelledby="AddLessonToTerm" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddStudentTitle">افزودن</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddSemesterLesson') }}" method="post" id="AddSemesterLessonForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="AddUniversityId" class="form-control" onchange="CollegeSearch(this,'Add')">
                                        <option value="">انتخاب دانشگاه</option>
                                        @foreach($University as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden id="AddCircleLoader">Loading...</div>
                                <div class="form-group">
                                    <label for="">دانشکده</label>
                                    <select name="CollegeId" id="AddCollegeId" class="form-control" onchange="FieldSearch(this,'Add')">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="loader" hidden style="margin-right: 6rem!important;" id="AddCircleLoader1">Loading...</div>
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <select name="FieldId" id="AddFieldId" class="form-control" onchange="LessonSearch(this,'Add')">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden style="margin-right: 6rem!important;" id="AddCircleLoader2">Loading...</div>
                                <div class="form-group">
                                    <label for="">درس</label>
                                    <select name="LessonId" id="AddLessonId" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نیمسال</label>
                                    <select name="SemesterId" id="AddSemesterId" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد ارائه</label>
                                    <input type="text" name="Code" id="Code" class="form-control" placeholder="کد ارائه">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <label for="" class="">انتخاب استاد</label>
                                    <input type="text" name="teacher" id="justAnInputBox1" placeholder="انتخاب استاد" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditLessonToTerm" tabindex="-1" aria-labelledby="EditLessonToTerm" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditLessonToTermTitle">ویرایش</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditSemesterLesson') }}" method="post" id="EditSemesterLessonForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="EditUniversityId" class="form-control" onchange="CollegeSearch(this,'Edit')">
                                        <option value="">انتخاب دانشگاه</option>
                                        @foreach($University as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden id="EditCircleLoader">Loading...</div>
                                <div class="form-group">
                                    <label for="">دانشکده</label>
                                    <select name="CollegeId" id="EditCollegeId" class="form-control" onchange="FieldSearch(this,'Edit')">
                                        <option value="0">دانشکده فنی شهید منتظری مشهد</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="loader" hidden id="EditCircleLoader1">Loading...</div>
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <select name="FieldId" id="EditFieldId" class="form-control" onchange="LessonSearch(this,'Edit')">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden id="EditCircleLoader2">Loading...</div>
                                <div class="form-group">
                                    <label for="">درس</label>
                                    <select name="LessonId" id="EditLessonId" class="form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نیمسال</label>
                                    <select name="SemesterId" id="EditSemesterId" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد ارائه</label>
                                    <input type="text" name="id" id="edit_id" hidden>
                                    <input type="text" name="Code" id="edit_Code" class="form-control" placeholder="کد ارائه">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="">انتخاب استاد</label>
                                    <input type="text" id="justAnInputBox2" name="teacher" placeholder="انتخاب استاد" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-success">ویرایش</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DeleteLessonToTerm" tabindex="-1" aria-labelledby="DeleteLessonToTerm" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteLessonToTermTitle">حذف</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این کلاس را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteSemesterLesson') }}" method="post">
                        @csrf
                        <input type="text" name="id" id="DeleteId" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('Plugin/TreeSelect/comboTreePlugin.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        let CollegeId=0;
        let FieldId=0;
        let LessonId=0;
        let SemesterId=0;
        let SelectedTeacher=0;
        var SampleJSONData = [];
        comboTree3 = $('#justAnInputBox1').comboTree({
            source : SampleJSONData,
            isMultiple: true,
            cascadeSelect: true,
            collapse: false,
            // selected:['10','50']
        });
        comboTree4 = $('#justAnInputBox2').comboTree({
            source : SampleJSONData,
            isMultiple: true,
            cascadeSelect: true,
            collapse: false,
            // selected:['10','50']
        });
        function CollegeSearch($this,type) {
            let UniversityId=$($this).val();
            if (UniversityId !== '')
            {
                document.getElementById(type + 'CircleLoader').removeAttribute('hidden');
                var URL='{{ route('GetCollegeInformationSemesterLesson',':Code') }}';
                URL=URL.replace(':Code',UniversityId);
                axios.get(URL)
                    .then(function (response) {
                        let CollegeList=document.getElementById(type + 'CollegeId');
                        let SemesterList=document.getElementById(type + 'SemesterId');
                        let FieldList=document.getElementById(type +'FieldId');
                        let LessonList=document.getElementById(type +'LessonId');
                        CollegeList.options.length=0;
                        FieldList.options.length=1;
                        LessonList.options.length=1;
                        SemesterList.options.length=0;
                        document.getElementById(type + 'CircleLoader').setAttribute('hidden','hidden');
                        CollegeList.options[CollegeList.options.length]=new Option('انتخاب دانشکده','');
                        SemesterList.options[SemesterList.options.length]=new Option('انتخاب نیمسال','');
                        for (let index in response.data.College)
                        {
                            CollegeList.options[CollegeList.options.length]=new Option(response.data.College[index].Name,response.data.College[index].id)
                        }
                        for (let index in response.data.Semester)
                        {
                            SemesterList.options[SemesterList.options.length]=new Option(response.data.Semester[index].Name,response.data.Semester[index].id)
                        }
                        //Set Teacher MultiSelect
                        if (type === 'Edit')
                        {
                            document.getElementById('EditCollegeId').value=CollegeId;
                            if (CollegeList.value!=='')
                            {
                                document.getElementById('EditCollegeId').onchange();
                            }
                            comboTree4.setSource(response.data.Teacher);
                            comboTree4.setSelection(SelectedTeacher)
                            SemesterList.value=SemesterId;
                        }
                        else {
                            comboTree3.setSource(response.data.Teacher);
                        }
                    })
            }
            else {
                document.getElementById(type + 'CollegeId').options.length=0;
                document.getElementById(type + 'FieldId').options.length=0;
                document.getElementById(type + 'LessonId').options.length=0;
            }
        }
        function FieldSearch($this,type) {
            let CollegeId=$($this).val();
            if (CollegeId !== '')
            {
                document.getElementById(type + 'CircleLoader1').removeAttribute('hidden');
                var URL='{{ route('GetFiledInformationLesson',':Code') }}';
                URL=URL.replace(':Code',CollegeId);
                axios.get(URL)
                    .then(function (response) {
                        let FieldList=document.getElementById(type +'FieldId');
                        let LessonList=document.getElementById(type +'LessonId');
                        FieldList.options.length=0;
                        LessonList.options.length=1;
                        document.getElementById(type + 'CircleLoader1').setAttribute('hidden','hidden');
                        FieldList.options[FieldList.options.length]=new Option('انتخاب رشته تحصیلی','')
                        for (let index in response.data)
                        {
                            FieldList.options[FieldList.options.length]=new Option(response.data[index].Name,response.data[index].id)
                        }
                        if(type === 'Edit') {
                            document.getElementById('EditFieldId').value=FieldId;
                            if (FieldList.value!=='')
                            {
                                document.getElementById('EditFieldId').onchange();
                            }

                        }
                    })
            }
            else {
                document.getElementById(type + 'FieldId').options.length=0;
                document.getElementById(type + 'LessonId').options.length=0;
            }
        }
        function LessonSearch($this,type) {
            let FieldId=$($this).val();
            if (FieldId !== '')
            {
                document.getElementById(type + 'CircleLoader2').removeAttribute('hidden');
                var URL='{{ route('GetFieldSemesterLesson',':Code') }}';
                URL=URL.replace(':Code',FieldId);
                axios.get(URL)
                    .then(function (response) {
                        let LessonList=document.getElementById(type +'LessonId');
                        LessonList.options.length=0;
                        document.getElementById(type + 'CircleLoader2').setAttribute('hidden','hidden');
                        LessonList.options[LessonList.options.length]=new Option('انتخاب درس','')
                        for (let index in response.data)
                        {
                            LessonList.options[LessonList.options.length]=new Option(response.data[index].Name,response.data[index].id)
                        }
                        if(type === 'Edit') {
                            document.getElementById('EditLessonId').value = LessonId;
                            if (FieldId.value!=='')
                            {
                                // document.getElementById('EditLessonId').onchange();
                            }
                        };
                    })
            }
            else {
                document.getElementById(type + 'LessonId').options.length=0;
            }
        }
        function EditSemesterLesson(Code) {
            var URL='{{ route('GetInformationSemesterLesson',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
            .then((response)=>{
                document.getElementById('EditUniversityId').value=response.data.SemesterLesson.lesson.field.college.university.id;
                document.getElementById('edit_id').value=response.data.SemesterLesson.id;
                CollegeId=response.data.SemesterLesson.lesson.field.college.id;
                FieldId=response.data.SemesterLesson.lesson.field.id;
                LessonId=response.data.SemesterLesson.lesson.id;
                document.getElementById('EditUniversityId').onchange();
                document.getElementById('edit_Code').value=response.data.SemesterLesson.Code;
                SemesterId=response.data.SemesterLesson.SemesterId;
                SelectedTeacher=response.data.Selected;
            })
            .catch((error)=>{
                console.log(error.data);
            })
        }
        function DeleteSemesterLesson(Code) {
            document.getElementById('DeleteId').value=Code;
        }
        $("#AddSemesterLessonForm").validate({
            rules: {
                teacher: {
                    required: true,
                },
                UniversityId:{
                    required: true,
                },
                CollegeId:{
                    required: true,
                },
                LessonId:{
                    required: true,
                },
                SemesterId:{
                    required: true,
                },
                FieldId:{
                    required: true,
                },
                Code:{
                    required: true,
                },
            },
        });
        $("#EditSemesterLessonForm").validate({
            rules: {
                teacher: {
                    required: true,
                },
                UniversityId:{
                    required: true,
                },
                CollegeId:{
                    required: true,
                },
                LessonId:{
                    required: true,
                },
                SemesterId:{
                    required: true,
                },
                FieldId:{
                    required: true,
                },
                Code:{
                    required: true,
                },
            },
        });
    </script>
@endsection
