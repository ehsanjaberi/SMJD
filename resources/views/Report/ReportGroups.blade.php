@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>گروه گزارشات</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 116)
                    <a href="#" data-toggle="modal" data-target="#AddGroup" class="btn btn-info">
                        افزودن
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 113)
                                <table class="table table-striped" style="white-space: nowrap">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">نام</th>
                                        <th scope="col" class="text-right">عنوان</th>
                                        <th scope="col" class="text-right">آیکون</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($ReportGroups as $reportGroup)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                                            <td class="text-right">{{ $reportGroup->Title }}</td>
                                            <td class="text-right">{{ $reportGroup->Name }}</td>
                                            <td class="text-right">
                                                <span class="{{ $reportGroup->Icon }}"></span>
                                                {{ $reportGroup->Icon }}
                                            </td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 115)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditGroup" onclick="EditGroup({{ $reportGroup->id }})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 114)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteGroup" onclick="DeleteGroup({{ $reportGroup->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="AddGroup" tabindex="-1" aria-labelledby="AddGroup" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="َAddSemesterTitle">افزودن گروه</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddReportGroup') }}" method="post">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">عنوان</label>
                                        <input type="text" name="Title" id="Title" class="form-control" placeholder="عنوان">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="نام">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">آیکون</label>
                                    <input type="text" name="Icon" id="Icon" class="form-control" placeholder="آیکون">
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
    <div class="modal fade" id="EditGroup" tabindex="-1" aria-labelledby="EditGroup" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditSemesterTitle">ویرایش گروه</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditReportGroup') }}" method="post">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">عنوان</label>
                                        <input type="text" name="id" id="edit_id" hidden>
                                        <input type="text" name="Title" id="edit_Title" class="form-control" placeholder="عنوان">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="نام">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">آیکون</label>
                                    <input type="text" name="Icon" id="edit_Icon" class="form-control" placeholder="آیکون">
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
    <div class="modal fade" id="DeleteGroup" tabindex="-1" aria-labelledby="DeleteGroup" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteFieldTitle">حذف گروه</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این گروه را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteReportGroup') }}" method="post">
                        @csrf
                        <input type="text" name="id" id="Delete_id" hidden>
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
        function EditGroup(Code) {
            var URL='{{ route('GetReportGroup',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
            // axios.get('/Report/ReportGroup/GetInformation/' + Code)
                .then(function (response) {
                    document.getElementById('edit_id').value = response.data.id;
                    document.getElementById('edit_Title').value = response.data.Title;
                    document.getElementById('edit_Name').value = response.data.Name;
                    document.getElementById('edit_Icon').value=response.data.Icon;
                })
        }
        function DeleteGroup(Code) {
            document.getElementById('Delete_id').value=Code;
        }
    </script>
@endsection
