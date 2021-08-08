@extends('layouts.app')
@section('head')
    <style>
        .input-file-container {
            position: relative;
            width: 225px;
        }
        .js .input-file-trigger {
              display   : block;
              padding   : 14px 45px;
              background: #39D2B4;
              color     : #fff;
              font-size : 1em;
              transition: all .4s;
              cursor    : pointer;
        }
        .js .input-file {
            position: absolute;
            top: 0; left: 0;
            width: 225px;
            opacity: 0;
            padding: 14px 0;
            cursor: pointer;
        }
        .js .input-file:hover + .input-file-trigger,
        .js .input-file:focus + .input-file-trigger,
        .js .input-file-trigger:hover,
        .js .input-file-trigger:focus {
            background: #34495E;
            color: #39D2B4;
        }

        .file-return {
            margin: 0;
        }
        .file-return:not(:empty) {
            margin: 1em 0;
        }
        .js .file-return {

            font-size: .9em;
            font-weight: bold;
        }
        .js .file-return:not(:empty):before {
            content: "فایل انتخاب شده: ";
            font-style: normal;
            font-weight: normal;
        }
        .copy a {
            text-decoration: none;
            color: #1ABC9C;
        }
    </style>
@endsection
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
            @if($Per->PermissionId == 126)
                <a href="#" data-toggle="modal" data-target="#ImportExcel" class="text-success align-self-center ml-2">
                    <i class="fa fa-file-excel-o" style="font-size: 1.5em;"></i>
                </a>
                <a href="#" data-toggle="modal" data-target="#AddStudent" class="btn btn-info">
                    افزودن دانشجو
                </a>
            @endif
        @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                        @if($Per->PermissionId == 123)
                            <div class="table-responsive">
                                <table class="table table-striped" style="white-space: nowrap">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">نام</th>
                                        <th scope="col" class="text-right">شماره دانشجویی</th>
                                        <th scope="col" class="text-right">مقطع</th>
                                        <th scope="col" class="text-right">رشته تحصیلی</th>
                                        <th scope="col" class="text-right">تاریخ شروع</th>
                                        <th scope="col" class="text-right">تاریخ پایان</th>
                                        <th scope="col" class="text-right">کدملی</th>
                                        <th scope="col" class="text-right">دانشکده</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Student as $student)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $student->Person->Name.' '.$student->Person->Family }}</td>
                                            <td class="text-right">{{ $student->PersonalCode }}</td>
                                            <td class="text-right">{{ $student->Degree->Name }}</td>
                                            <td class="text-right">{{ $student->Field->Name }}</td>
                                            <td class="text-right">{{ $student->StartDate }}</td>
                                            <td class="text-right">{{ $student->EndDate }}</td>
                                            <td class="text-right">{{ $student->Person->NationalCode }}</td>
                                            <td class="text-right">{{ $student->College->University->Name.'('.$student->College->Name.')' }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 125)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditStudent" onclick="EditStudent({{ $student->id }})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 124)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteStudent" onclick="DeleteStudent({{ $student->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center bg-light font-weight-bold">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center" dir="ltr">
                                {{ $Student->render() }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddStudent" tabindex="-1" aria-labelledby="AddStudent" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddStudentTitle">افزودن دانشجو</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddStudent') }}" method="post" id="AddStudentForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">کد ملی</label>
                                    <input type="text" name="NationalCode" id="NationalCode" class="form-control" placeholder="کد ملی">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="نام">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">نام خانوادگی</label>
                                    <input type="text" name="Family" id="Family" class="form-control" placeholder="نام خانوادگی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="AddUniversityId" class="form-control" onchange="CollegeSearch(this,'Add')">
                                        @foreach($University as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="loader" hidden id="AddCircleLoader">Loading...</div>
                                <div class="form-group">
                                    <label for="">دانشکده</label>
                                    <select name="CollegeId" id="AddCollegeId" class="form-control" onchange="FieldSearch(this,'Add')">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">شماره دانشجویی</label>
                                    <input type="text" name="PersonalId" id="PersonalId" class="form-control" placeholder="شماره دانشجویی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">مقطع تحصیلی</label>
                                    <select name="DegreeId" id="DegreeId" class="form-control">
                                        @foreach($Degree as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="loader" hidden style="margin-right: 6rem!important;" id="AddCircleLoader1">Loading...</div>
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <select name="FieldId" id="AddFieldId" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-0 mt-4 errorCustom">
                                    <label for="">جنسیت</label>
                                    <div class=" form-check-inline">
                                        <label for="male" class="form-check-label">مرد</label>
                                        <input type="radio" id="male" value="0" class="form-check-input" name="Sex">
                                        <label for="female" class="form-check-label mr-2">زن</label>
                                        <input type="radio" id="female" value="1" class="form-check-input"name="Sex">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">شروع تحصیل</label>
                                    <input type="text" name="StartDate" pattern="[0-9]{4}/[0-9]{2}/[0-9]{2}" id="StartDate" class="form-control" placeholder="--/--/----">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">پایان تحصیل</label>
                                    <input type="text" name="EndDate" pattern="[0-9]{4}/[0-9]{2}/[0-9]{2}" id="EndDate" class="form-control" placeholder="--/--/----">
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
    <div class="modal fade" id="EditStudent" tabindex="-1" aria-labelledby="EditStudent" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditStudentTitle">ویرایش دانشجو</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditStudent') }}" method="post" id="EditStudentForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">کد ملی</label>
                                    <input type="text" name="id" id="edit_Id" hidden>
                                    <input type="text" name="NationalCode" id="edit_NationalCode" class="form-control" placeholder="کد ملی">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="نام">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">نام خانوادگی</label>
                                    <input type="text" name="Family"id="edit_Family" class="form-control" placeholder="نام خانوادگی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="EditUniversityId" class="form-control" onchange="CollegeSearch(this,'Edit')">
                                        @foreach($University as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="loader" hidden style="margin-right: 6rem!important;" id="EditCircleLoader">Loading...</div>
                                <div class="form-group">
                                    <label for="">دانشکده</label>
                                    <select name="CollegeId" id="EditCollegeId" class="form-control" onchange="FieldSearch(this,'Edit')">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">شماره دانشجویی</label>
                                    <input type="text" name="PersonalId" id="edit_PersonalCode" class="form-control" placeholder="شماره دانشجویی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">مقطع تحصیلی</label>
                                    <select name="DegreeId" id="edit_DegreeId" class="form-control">
                                        @foreach($Degree as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="loader" hidden style="margin-right: 6rem!important;" id="EditCircleLoader1">Loading...</div>
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <select name="FieldId" id="EditFieldId" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-0 mt-4">
                                    <label for="">جنسیت</label>
                                    <div class=" form-check-inline">
                                        <label for="male" class="form-check-label">مرد</label>
                                        <input type="radio" id="edit_male" value="0" class="form-check-input" name="Sex">
                                        <label for="female" class="form-check-label mr-2">زن</label>
                                        <input type="radio" id="edit_female" value="1" class="form-check-input"name="Sex">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">شروع تحصیل</label>
                                    <input type="text" name="StartDate" id="edit_StartDate" class="form-control" placeholder="شروع تحصیل">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">پایان تحصیل</label>
                                    <input type="text" name="EndDate" id="edit_EndDate" class="form-control" placeholder="پایان تحصیل">
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
    <div class="modal fade" id="DeleteStudent" tabindex="-1" aria-labelledby="DeleteStudent" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteStudentTitle">حذف دانشجو</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این دانشجو را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteStudent') }}" method="post">
                        @csrf
                        <input type="text" name="DeleteId" id="Delete_Id" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ImportExcel" tabindex="-1" aria-labelledby="ImportExcel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditImportExcelTitle">آپلود فایل اکسل</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ImportStudentExcelFile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-center d-flex justify-content-center align-items-center flex-column">
                        <div class="input-file-container">
                            <input class="input-file" name="ExcelFile" id="my-file" type="file" accept=".csv,.xlsx,.xls">
                            <label tabindex="0" for="my-file" class="input-file-trigger">انتخاب فایل</label>
                        </div>
                        <p class="file-return"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-success">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        let CollegeId=0;
        let FieldId=0;
        $(document).ready(function () {
            document.getElementById('AddUniversityId').onchange();
            $("#StartDate").persianDatepicker({
                inline: false,
                format: 'YYYY/MM/DD',
                initialValue: true,
            });
            $("#EndDate").persianDatepicker({
                inline: false,
                format: 'YYYY/MM/DD',
                initialValue: true,
            });
            $("#edit_StartDate").persianDatepicker({
                inline: false,
                format: 'YYYY/MM/DD',
                initialValue: true,
            });
            $("#edit_EndDate").persianDatepicker({
                inline: false,
                format: 'YYYY/MM/DD',
                initialValue: true,
            });
        })
        function CollegeSearch($this,type) {
            let UniversityId=$($this).val();
            if (UniversityId !== '')
            {
                document.getElementById(type + 'CircleLoader').removeAttribute('hidden');
                var URL='{{ route('GetCollegeInformationStudent',':Code') }}';
                URL=URL.replace(':Code',UniversityId);
                axios.get(URL)
                    .then(function (response) {
                        let CollegeList=document.getElementById(type +'CollegeId');
                        let FieldList=document.getElementById(type +'FieldId');
                        CollegeList.options.length=0;
                        CollegeList.value='';
                        FieldList.options.length=0;
                        document.getElementById(type + 'CircleLoader').setAttribute('hidden','hidden');
                        // CollegeList.options[CollegeList.options.length]=new Option('انتخاب دانشکده','')
                        for (let index in response.data)
                        {
                            CollegeList.options[CollegeList.options.length]=new Option(response.data[index].Name,response.data[index].id)
                        }
                        document.getElementById('AddCollegeId').onchange();
                        if (type === 'Edit')
                        {
                            document.getElementById('EditCollegeId').value=CollegeId;
                            if (CollegeList.value!=='')
                            {
                                document.getElementById('EditCollegeId').onchange();
                            }

                        }
                    })
            }
            else {
                document.getElementById(type + 'CollegeId').options.length=0;
            }
        }
        function FieldSearch($this,type) {
            let CollegeId=$($this).val();
            if (CollegeId !== '')
            {
                document.getElementById(type + 'CircleLoader1').removeAttribute('hidden');
                var URL='{{ route('GetFiledInformationStudent',':Code') }}';
                URL=URL.replace(':Code',CollegeId);
                axios.get(URL)
                // axios.get('/Management/Student/GetFiledInformation/' + CollegeId)
                    .then(function (response) {
                        let FieldList=document.getElementById(type +'FieldId');
                        FieldList.options.length=0;
                        document.getElementById(type + 'CircleLoader1').setAttribute('hidden','hidden');
                        // FieldList.options[FieldList.options.length]=new Option('انتخاب رشته تحصیلی','')
                        for (let index in response.data)
                        {
                            FieldList.options[FieldList.options.length]=new Option(response.data[index].Name,response.data[index].id)
                        }
                        (type === 'Edit') ? document.getElementById('EditFieldId').value=FieldId : '';
                    })
            }
            else {
                document.getElementById(type + 'CollegeId').options.length=0;
            }
        }
        function EditStudent(Code) {
            var URL='{{ route('GetStudentInformation',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
            // axios.get('/Management/Student/GetInformation/' + Code)
            .then((response)=>{
                console.log(response.data)
                document.getElementById('edit_Id').value=response.data.id;
                document.getElementById('edit_NationalCode').value=response.data.person.NationalCode;
                document.getElementById('edit_Name').value=response.data.person.Name;
                document.getElementById('edit_Family').value=response.data.person.Family;
                document.getElementById('EditUniversityId').value=response.data.college.UniversityId;
                document.getElementById('edit_PersonalCode').value=response.data.PersonalCode;
                document.getElementById('edit_DegreeId').value=response.data.DegreeId;
                document.getElementById('edit_StartDate').value=response.data.StartDate;
                document.getElementById('edit_EndDate').value=response.data.EndDate;
                CollegeId=response.data.CollegeId;
                FieldId=response.data.FieldId;
                document.getElementById('EditUniversityId').onchange();
                if (response.data.person.Gender==0)
                {
                    document.getElementById('edit_male').checked=true;
                }
                else {
                    document.getElementById('edit_female').checked=true;
                }
            })
            .catch((error)=>{
                console.log(error.data);
            })
        }
        function DeleteStudent(Code) {
            console.log(Code);
            document.getElementById('Delete_Id').value=Code;
        }
    //    Upload Excel File
        document.querySelector("html").classList.add('js');
        var fileInput  = document.querySelector( ".input-file" ),
            button     = document.querySelector( ".input-file-trigger" ),
            the_return = document.querySelector(".file-return");

        button.addEventListener( "keydown", function( event ) {
            if ( event.keyCode == 13 || event.keyCode == 32 ) {
                fileInput.focus();
            }
        });
        button.addEventListener( "click", function( event ) {
            fileInput.focus();
            return false;
        });
        fileInput.addEventListener( "change", function( event ) {
            the_return.innerHTML = this.value.split("C:\\fakepath\\")[1];
        });

        //ValidateForms
        $("#AddStudentForm").validate({
            rules: {
                NationalCode: {
                    required: true,
                },
                Name: {
                    required: true,
                },
                Family: {
                    required: true,
                },
                UniversityId:{
                    required: true,
                },
                CollegeId:{
                    required: true,
                },
                PersonalId:{
                    required: true,
                },
                DegreeId:{
                    required: true,
                },
                FieldId:{
                    required: true,
                },
                Sex:{
                    required: true,
                },
            },
            errorPlacement: function(error, element)
            {
                if ( element.is(":radio") )
                {
                    error.appendTo( element.parents('.errorCustom') );
                }
                else
                { // This is the default behavior
                    error.insertAfter( element );
                }
            }
        });
        $("#EditStudentForm").validate({
            rules: {
                NationalCode: {
                    required: true,
                },
                Name: {
                    required: true,
                },
                Family: {
                    required: true,
                },
                UniversityId:{
                    required: true,
                },
                CollegeId:{
                    required: true,
                },
                PersonalId:{
                    required: true,
                },
                DegreeId:{
                    required: true,
                },
                FieldId:{
                    required: true,
                },
                Sex:{
                    required: true,
                },

            },
            errorPlacement: function(error, element)
            {
                if ( element.is(":radio") )
                {
                    error.appendTo( element.parents('.errorCustom') );
                }
                else
                { // This is the default behavior
                    error.insertAfter( element );
                }
            }
        });
    </script>
@endsection
