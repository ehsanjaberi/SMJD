@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>نیمسال</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 131)
                    <a href="#" data-toggle="modal" data-target="#AddSemester" class="btn btn-info">
                        افزودن نیمسال
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 128)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">کد</th>
                                        <th scope="col" class="text-center">عنوان</th>
                                        <th scope="col" class="text-center">دانشگاه</th>
                                        <th scope="col" class="text-center">تاریخ شروع</th>
                                        <th scope="col" class="text-center">روز شروع</th>
                                        <th scope="col" class="text-center">تاریخ پایان</th>
                                        <th scope="col" class="text-center">مدت زمان هر جلسه</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Semester as $semester)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $semester->Code }}</td>
                                            <td class="text-right">{{ $semester->Name }}</td>
                                            <td class="text-center">{{ $semester->University->Name }}</td>
                                            <td class="text-center">{{ $semester->StartDate }}</td>
                                            <td class="text-center">
                                                {{(new \Morilog\Jalali\Jalalian(substr($semester->StartDate,0,4),substr($semester->StartDate,5,2),substr($semester->StartDate,8,2)))->format('%A') }}
                                            </td>
                                            <td class="text-center">{{ $semester->EndDate }}</td>
                                            <td class="text-center">{{ $semester->SessionDuration }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 130)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditSemester" onclick="EditSemester({{ $semester->id }})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 129)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteSemester" onclick="DeleteSemester({{ $semester->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="bg-light font-weight-bold text-center">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" dir="ltr">
                                    {{ $Semester->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddSemester" tabindex="-1" aria-labelledby="AddSemester" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="َAddSemesterTitle">افزودن نیمسال</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddSemester') }}" method="post" id="AddSemesterForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد</label>
                                    <input type="text" name="Code" id="Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="UniversityId" class="form-control">
                                        @foreach($University as $university)
                                            <option value="{{ $university->id }}">{{ $university->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">مدت زمان هر جلسه</label>
                                    <input type="text" name="SessionDur" id="SessionDur" class="form-control" placeholder="مدت زمان هر جلسه">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ شروع</label>
                                    <input type="text" name="StartDate" pattern="[0-9]{4}/[0-9]{2}/[0-9]{2}" id="StartDate" class="form-control" placeholder="تاریخ شروع">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ پایان</label>
                                    <input type="text" name="EndDate" pattern="[0-9]{4}/[0-9]{2}/[0-9]{2}" id="EndDate" class="form-control" placeholder="تاریخ پایان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IsDefault">ترم پیشفرض</label>
                                    <input type="checkbox" name="IsDefault" value="1" id="IsDefault">
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
    <div class="modal fade" id="EditSemester" tabindex="-1" aria-labelledby="EditSemester" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditSemesterTitle">ویرایش نیمسال</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditSemester') }}" method="post" id="EditSemesterForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد</label>
                                    <input type="text" name="id" id="edit_Id" hidden>
                                    <input type="text" name="Code" id="edit_Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="edit_UniversityId" class="form-control">
                                        <option value="0">انتخاب دانشگاه</option>
                                        @foreach($University as $university)
                                            <option value="{{ $university->id }}">{{ $university->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">مدت زمان هر جلسه</label>
                                    <input type="text" name="SessionDur" id="edit_SessionDur" class="form-control" placeholder="رشته تحصیلی">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ شروع</label>
                                    <input type="text" name="StartDate" id="edit_StartDate" class="form-control" placeholder="تاریخ شروع">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ پایان</label>
                                    <input type="text" name="EndDate" id="edit_EndDate" class="form-control" placeholder="تاریخ پایان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IsDefault">ترم پیشفرض</label>
                                    <input type="checkbox" name="IsDefault" id="edit_IsDefault">
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
    <div class="modal fade" id="DeleteSemester" tabindex="-1" aria-labelledby="DeleteSemester" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteSemesterTitle">حذف نیم سال</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این نیمسال را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteSemester') }}" method="post">
                        @csrf
                        <input type="text" name="Code" id="DeleteCode" hidden>
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
        $(document).ready(function () {
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
        function EditSemester(Code) {
            var URL='{{ route('GetSemester',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
                .then(function (response) {
                    console.log(response.data);
                    document.getElementById('edit_UniversityId').value = response.data.UniversityId;
                    document.getElementById('edit_Code').value=response.data.Code;
                    document.getElementById('edit_Name').value=response.data.Name;
                    document.getElementById('edit_SessionDur').value=response.data.SessionDuration;
                    document.getElementById('edit_StartDate').value=response.data.StartDate;
                    document.getElementById('edit_EndDate').value=response.data.EndDate;
                    document.getElementById('edit_Id').value=response.data.id;
                    if (response.data.IsDefault == 0)
                    {
                        document.getElementById('edit_IsDefault').checked=false;
                    }else {
                        document.getElementById('edit_IsDefault').checked=true;
                    }
                })
        }
        function DeleteSemester(Code) {
            document.getElementById('DeleteCode').value=Code;
        }
        $("#AddSemesterForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                },
                Code: {
                    required: true,
                },
                Name:{
                    required: true,
                },
                SessionDur:{
                    required: true,
                },
                StartDate:{
                    required: true,
                },
                EndDate:{
                    required: true,
                }
            },
        });
        $("#EditSemesterForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                },
                Code: {
                    required: true,
                },
                Name:{
                    required: true,
                },
                SessionDur:{
                    required: true,
                },
                StartDate:{
                    required: true,
                },
                EndDate:{
                    required: true,
                }
            },
        });
    </script>
@endsection
