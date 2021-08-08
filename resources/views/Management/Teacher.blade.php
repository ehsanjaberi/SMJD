@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>اساتید</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 100)
                    <a href="#" data-toggle="modal" data-target="#AddTeacher" class="btn btn-info">
                        افزودن استاد
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                        @if($Per->PermissionId == 97)
                            <div class="table-responsive">
                                <table class="table table-striped" style="white-space: nowrap">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">نام</th>
                                        <th scope="col" class="text-right">شماره پرسنلی</th>
                                        <th scope="col" class="text-right">مقطع تحصیلی</th>
                                        <th scope="col" class="text-right">رشته تحصیلی</th>
                                        <th scope="col" class="text-right">کد ملی</th>
                                        <th scope="col" class="text-right">دانشگاه</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Teacher as $teacher)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $teacher->Person->Name.' '.$teacher->Person->Family }}</td>
                                            <td class="text-right">{{ $teacher->PersonalCode }}</td>
                                            <td class="text-right">{{ $teacher->Degree->Name }}</td>
                                            <td class="text-right">{{ $teacher->Field }}</td>
                                            <td class="text-right">{{ $teacher->Person->NationalCode }}</td>
                                            <td class="text-right">{{ $teacher->University->Name }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 99)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditTeacher" onclick="EditTeacher({{ $teacher->id }})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach

                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 98)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteTeacher" onclick="DeleteTeacher({{ $teacher->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center bg-light font-weight-bold">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center" dir="ltr">
                                {{ $Teacher->render() }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddTeacher" tabindex="-1" aria-labelledby="AddTeacher" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddTeacherTitle">افزودن استاد</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddTeacher') }}" method="post" id="AddTeacherForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="UniversityId" class="form-control">
                                        @foreach($University as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد ملی</label>
                                    <input type="text" name="NationalCode" id="NationalCode" class="form-control" placeholder="کد ملی">
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
                                    <label for="">شماره پرسنلی</label>
                                    <input type="text" name="PersonalCode" id="PersonalCode" class="form-control" placeholder="شماره پرسنلی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">مقطع تحصیلی</label>
                                    <select name="DegreeId" id="DegreeId" class="form-control">
                                        @foreach($Degree as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <input type="text" name="Field" id="Field" class="form-control" placeholder="رشته تحصیلی">
                                </div>
                            </div>
                            <div class="col-md-6">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditTeacher" tabindex="-1" aria-labelledby="EditTeacher" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditTeacherTitle">ویرایش استاد</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditTeacher') }}" method="post" id="EditTeacherForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="EditUniversityId" class="form-control">
                                        @foreach($University as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد ملی</label>
                                    <input type="text" name="id" id="edit_id" hidden>
                                    <input type="text" name="NationalCode" id="edit_NationalCode" class="form-control" placeholder="کد ملی">
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
                                    <label for="">شماره پرسنلی</label>
                                    <input type="text" name="PersonalCode" id="edit_PersonalCode" class="form-control" placeholder="شماره پرسنلی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">مقطع تحصیلی</label>
                                    <select name="DegreeId" id="edit_DegreeId" class="form-control">
                                        @foreach($Degree as $degree)
                                            <option value="{{ $degree->id }}">{{ $degree->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">رشته تحصیلی</label>
                                    <input type="text" name="Field" id="edit_Field" class="form-control" placeholder="رشته تحصیلی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0 mt-4 errorCustom">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-success">ویرایش</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="DeleteTeacher" tabindex="-1" aria-labelledby="DeleteTeacher" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteTeachertTitle">حذف استاد</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این استاد را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteTeacher') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="DeleteId">
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
        function EditTeacher(Code) {
            var URL='{{ route('GetTeacherInformation',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
            .then((response)=>{
                document.getElementById('edit_id').value=response.data.id;
                document.getElementById('EditUniversityId').value=response.data.UniversityId;
                document.getElementById('edit_NationalCode').value=response.data.person.NationalCode;
                document.getElementById('edit_Name').value=response.data.person.Name;
                document.getElementById('edit_Family').value=response.data.person.Family;
                document.getElementById('edit_PersonalCode').value=response.data.PersonalCode;
                document.getElementById('edit_DegreeId').value=response.data.DegreeId;
                document.getElementById('edit_Field').value=response.data.Field;
                if (response.data.person.Gender==0)
                {
                    document.getElementById('edit_male').checked=true;
                }
                else{
                    document.getElementById('edit_female').checked=true;
                }
            })
            .catch((error)=>{
                console.log(error.data);
            })
        }
        function DeleteTeacher(Code) {
            document.getElementById('DeleteId').value=Code;
        }
        $("#AddTeacherForm").validate({
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
                PersonalCode:{
                    required: true,
                },
                DegreeId:{
                    required: true,
                },
                Field:{
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
        $("#EditTeacherForm").validate({
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
                PersonalCode:{
                    required: true,
                },
                DegreeId:{
                    required: true,
                },
                Field:{
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
