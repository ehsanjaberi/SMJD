@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>درس ها</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 156)
                    <a href="#" data-toggle="modal" data-target="#AddLesson" class="btn btn-info">
                        افزودن درس
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 153)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">کد</th>
                                        <th scope="col" class="text-right">عنوان</th>
                                        <th scope="col" class="text-right">مقطع</th>
                                        <th scope="col" class="text-right">رشته تحصیلی</th>
                                        <th scope="col" class="text-center">ت.و.ع</th>
                                        <th scope="col" class="text-center">ت.و.ت</th>
                                        <th scope="col" class="text-right">دانشگاه</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Lesson as $lesson)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $lesson->Code }}</td>
                                            <td class="text-right">{{ $lesson->Name }}</td>
                                            <td class="text-right">{{ $lesson->Degree->Name }}</td>
                                            <td class="text-right">{{ $lesson->Field->Name }}</td>
                                            <td class="text-center">{{ $lesson->PracticalUnits }}</td>
                                            <td class="text-center">{{ $lesson->TheoricalUnits }}</td>
                                            <td class="text-right">{{ $lesson->Field->College->University->Name .'('. $lesson->Field->College->Name.')'}}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 155)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditLesson" onclick="EditLesson({{$lesson->id}})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach

                                                    @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                        @if($Per->PermissionId == 154)
                                                            <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteLesson" onclick="DeleteLesson({{ $lesson->id }})">
                                                                <i class="fa fa-trash text-danger"></i>
                                                            </a>
                                                        @endif
                                                    @endforeach

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" dir="ltr">
                                    {{ $Lesson->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddLesson" tabindex="-1" aria-labelledby="AddLesson" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="َAddSemesterTitle">افزودن درس</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddLesson') }}" method="post" id="AddLessonForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">دانشگاه</label>
                                        <select name="UniversityId" id="UniversityId" class="form-control" onchange="CollegeSearch(this,'Add')">
                                            <option value="0">انتخاب دانشگاه</option>
                                            @foreach($University as $uni)
                                                <option value="{{ $uni->id }}">{{ $uni->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                <div class="form-group">
                                    <label for="">کد درس</label>
                                    <input type="text" name="Code" id="Code" class="form-control" placeholder="کد درس">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام درس</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="نام درس">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">مقطع تحصیلی</label>
                                    <select name="DegreeId" id="DegreeId" class="form-control">
                                        <option value="def">انتخاب مقطع تحصیلی</option>
                                        @foreach($Degree as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden style="margin-right: 6rem!important;" id="AddCircleLoader1">Loading...</div>
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <select name="FieldId" id="AddFieldId" class="form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تعداد واحد عملی</label>
                                    <input type="text" name="PUnit" id="PUnit" class="form-control" placeholder="تعداد واحد عملی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تعداد واحد تئوری</label>
                                    <input type="text" name="TUnit" id="TUnit" class="form-control" placeholder="تعداد واحد تئوری">
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
    <div class="modal fade" id="EditLesson" tabindex="-1" aria-labelledby="EditLesson" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditSemesterTitle">ویرایش درس</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditLesson') }}" method="post" id="EditLessonForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">دانشگاه</label>
                                        <select id="edit_UniversityId" class="form-control" onchange="CollegeSearch(this,'Edit')">
                                            <option value="0">انتخاب دانشگاه</option>
                                            @foreach($University as $uni)
                                                <option value="{{ $uni->id }}">{{ $uni->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden id="EditCircleLoader">Loading...</div>
                                <div class="form-group">
                                    <label for="">دانشکده</label>
                                    <select id="EditCollegeId" class="form-control" onchange="FieldSearch(this,'Edit')">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد درس</label>
                                    <input type="text" name="OldCode" id="OldCode" hidden>
                                    <input type="text" name="Code" id="edit_Code" class="form-control" placeholder="کد درس">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام درس</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="نام درس">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">مقطع تحصیلی</label>
                                    <select name="DegreeId" id="edit_DegreeId" class="form-control">
                                        <option value="0">انتخاب مقطع تحصیلی</option>
                                        @foreach($Degree as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden style="margin-right: 6rem!important;" id="EditCircleLoader1">Loading...</div>
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <select name="FieldId" id="EditFieldId" class="form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تعداد واحد عملی</label>
                                    <input type="text" name="PUnit" id="edit_PUnit" class="form-control" placeholder="تعداد واحد عملی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تعداد واحد تئوری</label>
                                    <input type="text" name="TUnit" id="edit_TUnit" class="form-control" placeholder="تعداد واحد تئوری">
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
    <div class="modal fade" id="DeleteLesson" tabindex="-1" aria-labelledby="DeleteLesson" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteLessonTitle">حذف درس</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این درس را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteLesson') }}" method="post">
                        @csrf
                        <input type="text" id="DeleteCode" name="Code" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        let CollegeId=0;
        let FieldId=0;
        function CollegeSearch($this,type) {
            let UniversityId=$($this).val();
            if (UniversityId !== '')
            {
                document.getElementById(type + 'CircleLoader').removeAttribute('hidden');
                var URL='{{ route('GetCollegeInformationLesson',':Code') }}';
                URL=URL.replace(':Code',UniversityId);
                axios.get(URL)
                    .then(function (response) {
                        let CollegeList=document.getElementById(type +'CollegeId');
                        let FieldList=document.getElementById(type +'FieldId');
                        CollegeList.options.length=0;

                        FieldList.options.length=1;
                        document.getElementById(type + 'CircleLoader').setAttribute('hidden','hidden');
                        CollegeList.options[CollegeList.options.length]=new Option('انتخاب دانشکده','')
                        for (let index in response.data)
                        {
                            CollegeList.options[CollegeList.options.length]=new Option(response.data[index].Name,response.data[index].id)
                        }
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
                var URL='{{ route('GetFiledInformationLesson',':Code') }}';
                URL=URL.replace(':Code',CollegeId);
                axios.get(URL)
                    .then(function (response) {
                        let FieldList=document.getElementById(type +'FieldId');
                        FieldList.options.length=0;
                        document.getElementById(type + 'CircleLoader1').setAttribute('hidden','hidden');
                        FieldList.options[FieldList.options.length]=new Option('انتخاب رشته تحصیلی','')
                        for (let index in response.data)
                        {
                            FieldList.options[FieldList.options.length]=new Option(response.data[index].Name,response.data[index].id)
                        }
                        (type === 'Edit') ? document.getElementById('EditFieldId').value=FieldId : '';
                    })
            }
            else {
                // document.getElementById(type + 'CollegeId').options.length=0;
            }
        }
        function EditLesson(Code) {
            var URL='{{ route('GetLesson',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
                .then(function (response) {
                    console.log(response.data);
                    document.getElementById('edit_UniversityId').value = response.data.field.college.university.id;
                    CollegeId = response.data.field.college.id;
                    FieldId = response.data.field.id;
                    document.getElementById('edit_UniversityId').onchange();
                    document.getElementById('OldCode').value=response.data.id;
                    document.getElementById('edit_Code').value=response.data.Code;
                    document.getElementById('edit_Name').value=response.data.Name;
                    document.getElementById('edit_DegreeId').value=response.data.DegreeId;
                    document.getElementById('edit_PUnit').value=response.data.PracticalUnits;
                    document.getElementById('edit_TUnit').value=response.data.TheoricalUnits;
                })
        }
        function DeleteLesson(Code) {
            document.getElementById('DeleteCode').value=Code;
        }
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "تکمیل این فیلد اجباری است.");
        $("#AddLessonForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                    valueNotEquals:"def"
                },
                CollegeId: {
                    required: true,
                    valueNotEquals:""
                },
                Code:{
                    required: true,
                },
                Name:{
                    required: true,
                },
                DegreeId:{
                    required: true,
                    valueNotEquals:"def"
                },
                FieldId:{
                    required: true,
                },
                PUnit:{
                    required: true,
                },
                TUnit:{
                    required: true,
                }
            },
        });
        $("#EditLessonForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                    valueNotEquals:"def"
                },
                CollegeId: {
                    required: true,
                    valueNotEquals:""
                },
                Code:{
                    required: true,
                },
                Name:{
                    required: true,
                },
                DegreeId:{
                    required: true,
                    valueNotEquals:"def"
                },
                FieldId:{
                    required: true,
                },
                PUnit:{
                    required: true,
                },
                TUnit:{
                    required: true,
                }
            },
        });
    </script>
@endsection
