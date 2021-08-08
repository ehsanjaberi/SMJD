@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>انواع نمرات</h5>
        </section>
        <section class="content-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 43)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 30px;">#</th>
                                        <th scope="col" class="text-right">عنوان</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($GradeType as $grade)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $grade->Name }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 45)
                                                        <a href="#" class="mx-1 text-decoration-none" onclick="EditGradeType({{ $grade->id }},'{{ $grade->Name }}')">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 44)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteGradeType" onclick="DeleteGradeType({{ $grade->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center font-weight-bold bg-light">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" dir="ltr">
                                    {{ $GradeType->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-right" id="card-header">
                            افزودن نوع نمره
                        </div>
                        <form action="{{ route('AddGradeType') }}" id="GradeTypeForm" method="post">
                            @csrf
                            <div class="card-body text-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">نام</label>
                                            <input type="text" id="GradeTypeCode" hidden>
                                            <input type="text" name="Name" id="GradeTypeName" class="form-control" placeholder="نام">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            <button type="reset" class="btn btn-danger" id="BtnCancelGradeTypeForm" hidden onclick="CancelEditRole()">انصراف</button>
                            <button type="submit" class="btn btn-primary" id="BtnGradeTypeForm">افزودن</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="DeleteGradeType" tabindex="-1" aria-labelledby="DeleteGradeType" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteDegreeTitle">حذف نوع نمره</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این نوع نمره را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteGradeType') }}" method="post">
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
        function EditGradeType(Code,Name) {
            document.getElementById('card-header').textContent='ویرایش نوع نمره';
            document.getElementById('GradeTypeForm').action='{{ route('EditGradeType') }}';
            document.getElementById('BtnCancelGradeTypeForm').removeAttribute('hidden');
            let BtnSubmit = document.getElementById('BtnGradeTypeForm');
            let IdInput = document.getElementById('GradeTypeCode');
            IdInput.setAttribute('name','Code');
            BtnSubmit.textContent='ویرایش';
            BtnSubmit.className='btn btn-success';
            document.getElementById('GradeTypeName').value=Name;
            IdInput.value=Code;
        }
        function CancelEditRole() {
            document.getElementById('card-header').textContent='افزودن نقش';
            document.getElementById('GradeTypeForm').action='{{ route('AddGradeType') }}';
            document.getElementById('BtnCancelGradeTypeForm').setAttribute('hidden','hidden');
            document.getElementById('GradeTypeName').value=null;
            document.getElementById('GradeTypeCode').removeAttribute('name');
            let Btn = document.getElementById('BtnGradeTypeForm');
            Btn.textContent='افزودن';
            Btn.className='btn btn-primary';
        }
        function DeleteRole(Id) {
            document.getElementById('DeleteRoleId').value=Id;
        }
        function DeleteGradeType(Code) {
            document.getElementById('DeleteCode').value=Code;
        }
        $("#GradeTypeForm").validate({
            rules: {
                Name: {
                    required: true,
                },
            },
        });
    </script>
@endsection
