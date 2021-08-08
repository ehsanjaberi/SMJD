@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>کارمندان</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 68)
                    <a href="#" data-toggle="modal" data-target="#AddEmp" class="btn btn-info">
                        افزودن کارمند
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 28)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">نام</th>
                                        <th scope="col" class="text-right">شماره پرسنلی</th>
                                        <th scope="col" class="text-right">سمت</th>
                                        <th scope="col" class="text-center">کد ملی</th>
                                        <th scope="col" class="text-right">دانشگاه</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Employee as $employee)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $employee->Person->Name.' '.$employee->Person->Family }}</td>
                                            <td class="text-right">{{ $employee->PersonalCode }}</td>
                                            <td class="text-right">{{ $employee->Post->UniversityPost->Name }}</td>
                                            <td class="text-center">{{ $employee->Person->NationalCode }}</td>
                                            <td class="text-right">{{ $employee->University->Name }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 31)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditEmp" onclick="EditEmployee({{$employee->id}})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 30)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteEmp" onclick="DeleteEmployee({{ $employee->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="bg-light font-weight-bold text-center">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" dir="ltr">
                                    {{ $Employee->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddEmp" tabindex="-1" aria-labelledby="AddEmp" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن کارمند</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddEmployee') }}" method="post" id="AddEmpForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="UniversityId" class="form-control" onchange="PostSearch(this,'Add')">
                                        @foreach($University as $university)
                                            <option value="{{$university->id}}">{{ $university->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="نام">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام خانوادگی</label>
                                    <input type="text" name="Family" id="Family" class="form-control" placeholder="نام خانوادگی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد ملی</label>
                                    <input type="text" name="NationalCode" id="NationalCode" class="form-control" placeholder="کد ملی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">شماره پرسنلی</label>
                                    <input type="text" name="PersonalCode" id="PersonalCode" class="form-control" placeholder="شماره پرسنلی">
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
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <input type="text" name="Field" id="Field" class="form-control" placeholder="رشته تحصیلی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="loader" hidden id="AddUniversityPostLoader" style="margin: 0 46px">Loading...</div>
                                <label for="">سمت</label>
                                <select name="UniversityPost" id="AddUniversityPostList" class="form-control">
                                    @foreach($UniversityPost as $post)
                                        <option value="{{ $post->id }}">{{ $post->Name }}</option>
                                    @endforeach
                                </select>
                                {{--                                <span class="fa fa-plus" onclick="ShowPost()"></span>--}}
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-group mb-0 mt-4">
                                    <label for="">جنسیت</label>
                                    <div class=" form-check-inline errorCustom">
                                        <label for="male" class="form-check-label">مرد</label>
                                        <input type="radio" id="male" value="0" class="form-check-input" name="Gender">
                                        <label for="female" class="form-check-label mr-2">زن</label>
                                        <input type="radio" id="female" value="1" class="form-check-input"name="Gender">
                                    </div>
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
    <div class="modal fade" id="EditEmp" tabindex="-1" aria-labelledby="EditEmp" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditEmpTitle">ویرایش کارمند</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditEmployee') }}" method="post" id="EditEmpForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="EmployeeId" id="edit_EmployeeId" hidden>
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="edit_UniversityId" class="form-control" onchange="PostSearch(this,'Edit')">
                                        @foreach($University as $university)
                                            <option value="{{$university->id}}">{{ $university->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="نام">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام خانوادگی</label>
                                    <input type="text" name="Family" id="edit_Family" class="form-control" placeholder="نام خانوادگی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد ملی</label>
                                    <input type="text" name="NationalCode" id="edit_NationalCode" class="form-control" placeholder="کد ملی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">شماره پرسنلی</label>
                                    <input type="text" name="PersonalCode" id="edit_PersonalCode" class="form-control" placeholder="شماره پرسنلی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">مقطع تحصیلی</label>
                                    <select name="DegreeId" id="edit_DegreeId" class="form-control">
                                        <option value="def">انتخاب مقطع تحصیلی</option>
                                        @foreach($Degree as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <input type="text" name="Field" id="edit_Field" class="form-control" placeholder="رشته تحصیلی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="loader" hidden id="EditUniversityPostLoader" style="margin: 0 46px">Loading...</div>
                                <label for="">سمت</label>
                                <select name="UniversityPost" id="EditUniversityPostList" class="form-control">

                                </select>
                                {{--                                <span class="fa fa-plus" onclick="ShowPost()"></span>--}}
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-group mb-0 mt-4">
                                    <label for="">جنسیت</label>
                                    <div class=" form-check-inline">
                                        <label for="male" class="form-check-label">مرد</label>
                                        <input type="radio" id="edit_male" value="0" class="form-check-input" name="Gender">
                                        <label for="female" class="form-check-label mr-2">زن</label>
                                        <input type="radio" id="edit_female" value="1" class="form-check-input"name="Gender">
                                    </div>
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
    <div class="modal fade" id="DeleteEmp" tabindex="-1" aria-labelledby="DeleteEmp" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteEmpTitle">حذف کارمند</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این کارمند را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{route('DeleteEmployee')}}" method="post">
                        @csrf
                        <input type="text" id="Delete_Code" name="Code" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="AddUniversityPost" tabindex="-1" aria-labelledby="AddUniversityPost" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-light text-white">
                    <h5 class="modal-title text-dark" id="DeleteEmpTitle">افزودن سمت</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let PostCode;
        $(document).ready(function () {
            document.getElementById('UniversityId').onchange();
        })
        function PostSearch($this,type) {
            let UniversityId=$($this).val();
            if (UniversityId !== '')
            {
                document.getElementById(type + 'UniversityPostLoader').removeAttribute('hidden');
                var URL='{{ route('GetPostInformation',':Code') }}';
                URL=URL.replace(':Code',UniversityId);
                axios.get(URL)
                    // axios.get('/Base/Employee/GetPostInformation/' + UniversityId)
                    .then(function (response) {
                        let PostList=document.getElementById(type +'UniversityPostList');
                        PostList.options.length=0;
                        document.getElementById(type + 'UniversityPostLoader').setAttribute('hidden','hidden');
                        for (let index in response.data)
                        {
                            PostList.options[PostList.options.length]=new Option(response.data[index].Name,response.data[index].id)
                        }
                        (type == 'Edit') ? document.getElementById('EditUniversityPostList').value=PostCode : '';
                    })
            }
            else {
                document.getElementById(type + 'UniversityPostList').options.length=0;
            }
        }
        function EditEmployee(Code) {
            var URL='{{ route('GetEmployeeInformation',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
                // axios.get('/Base/Employee/GetInformation/' + Code)
                .then(function (response) {
                    document.getElementById('edit_EmployeeId').value=response.data.id;
                    document.getElementById('edit_UniversityId').value=response.data.UniversityId;
                    document.getElementById('edit_Name').value=response.data.person.Name;
                    document.getElementById('edit_Family').value=response.data.person.Family;
                    document.getElementById('edit_NationalCode').value=response.data.person.NationalCode;
                    document.getElementById('edit_PersonalCode').value=response.data.PersonalCode;
                    document.getElementById('edit_DegreeId').value=response.data.DegreeId;
                    document.getElementById('edit_Field').value=response.data.Field;
                    document.getElementById('edit_UniversityId').onchange();
                    PostCode=response.data.post.UniversityPostId;
                    (response.data.person.Gender==0)? document.getElementById('edit_male').checked=true : document.getElementById('edit_female').checked=true;
                })
        }
        function DeleteEmployee(Code) {
            document.getElementById('Delete_Code').value=Code;
        }
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "تکمیل این فیلد اجباری است.");
        $("#AddEmpForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                    valueNotEquals:"def"
                },
                Family: {
                    required: true,
                },
                Name:{
                    required: true,
                },
                NationalCode:{
                    required: true,
                },
                PersonalCode:{
                    required: true,
                },
                DegreeId:{
                    required: true,
                    valueNotEquals:"def"
                },
                Field:{
                    required: true,
                },
                UniversityPost:{
                    required: true,
                },
                Gender:{
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
        $("#EditEmpForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                    valueNotEquals:"def"
                },
                Family: {
                    required: true,
                },
                Name:{
                    required: true,
                },
                NationalCode:{
                    required: true,
                },
                PersonalCode:{
                    required: true,
                },
                DegreeId:{
                    required: true,
                    valueNotEquals:"def"
                },
                Field:{
                    required: true,
                },
                UniversityPost:{
                    required: true,
                },
                Gender:{
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
