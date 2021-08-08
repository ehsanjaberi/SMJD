@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('Plugin/TreeSelect/style.css') }}">
@endsection
@section('content')
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>مدیریت نقش ها</h5>
        </section>
        <section class="content-body">
        <div class="row">
            <div class="col-md-6">
                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                    @if($Per->PermissionId == 75)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 20px;">#</th>
                                    <th scope="col" class="text-right" style="width: 100px;">نام نقش</th>
                                    <th scope="col" class="text-center" style="width: 100px;">تعداد کاربران</th>
                                    <th scope="col" class="text-center" style="width: 100px;">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Role as $role)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                                        <td class="text-right">{{ $role->Name }}</td>
                                        <td class="text-center">{{ $role->UserRole->count() }}</td>
                                        <td class="text-center">
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                @if($Per->PermissionId == 77)
                                                    <a href="#" class="mx-1 text-decoration-none" onclick="EditRole({{ $role->id }})">
                                                        <i class="fa fa-edit text-success"></i>
                                                    </a>
                                                @endif
                                            @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 76)
                                                        <a href="#" class="mx-1 text-decoration-none" onclick="DeleteRole({{ $role->id }})" data-toggle="modal" data-target="#DeleteRole">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            <a href="#" class="mx-1 text-decoration-none" onclick="CancelEditRole()" hidden>
                                                <i class="fa fa-ban text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center" dir="ltr">
                                {{ $Role->render() }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div id="card-header" class="card-header text-right">
                        افزودن نقش
                    </div>
                    <form action="{{ route('AddRole') }}" method="post" id="RoleForm">
                        @csrf
                        <div class="card-body">
                            <div class="form-group text-right">
                                <input type="text" id="RoleId" hidden>
                                <label for="RoleName">نام نقش</label>
                                <input type="text" id="RoleName" class="form-control" name="RoleName" placeholder="نام نقش">
                            </div>
                            <div class="form-group text-right">
                                <label for="" class="">انتخاب دسترسی</label>
                                <input type="text" id="justAnInputBox1" placeholder="انتخاب نقش" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="BtnCancelRoleForm" type="button" class="btn btn-danger" hidden onclick="CancelEditRole()">انصراف</button>
                            <button id="BtnRoleForm" type="submit" class="btn btn-primary">افزودن</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="DeleteRole" tabindex="-1" role="dialog" aria-labelledby="DeleteRole" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger pl-0">
                    <h5 class="modal-title" id="DeleteRoleTitle">حذف نقش</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا مایل به حذف این نقش هستید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteRole') }}" method="post">
                        @csrf
                        <input type="text" name="RoleId" id="DeleteRoleId" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>
                        <button type="submit" class="btn btn-primary">بله</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('Plugin/TreeSelect/comboTreePlugin.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var SampleJSONData = [
            {
                id: 0,
                title: 'Horse'
            },
        ];
        comboTree3 = $('#justAnInputBox1').comboTree({
            source : SampleJSONData,
            isMultiple: true,
            cascadeSelect: true,
            collapse: false,
            // selected:['10','50']
        });
        $(document).ready(function($) {
            axios.get('{{ route('GetPermission') }}')
            .then(function (response) {
                comboTree3.setSource(response.data);
            })
        });
        function EditRole(Id) {
            document.getElementById('card-header').textContent='ویرایش نقش';
            document.getElementById('RoleForm').action='{{ route('EditRole') }}';
            document.getElementById('BtnCancelRoleForm').removeAttribute('hidden');
            let BtnRole = document.getElementById('BtnRoleForm');
            let RoleIdInput = document.getElementById('RoleId');
            RoleIdInput.setAttribute('name','RoleId');
            BtnRole.textContent='ویرایش';
            BtnRole.className='btn btn-success';
            // console.log(form);
            var URL='{{ route('GetRolePermission',':Code') }}';
            URL=URL.replace(':Code',Id);
            axios.get(URL)
                .then(function (response) {
                    document.getElementById('RoleName').value=response.data.Role.Name;
                    RoleIdInput.value=response.data.Role.id;
                    comboTree3.clearSelection()
                    comboTree3.setSelection(response.data.Selected)
                })
        }
        function CancelEditRole() {
            comboTree3.clearSelection()
            document.getElementById('card-header').textContent='افزودن نقش';
            document.getElementById('RoleForm').action='{{ route('AddRole') }}';
            document.getElementById('BtnCancelRoleForm').setAttribute('hidden','hidden');
            document.getElementById('RoleName').value=null;
            document.getElementById('RoleId').removeAttribute('name');
            let BtnRole = document.getElementById('BtnRoleForm');
            BtnRole.textContent='افزودن';
            BtnRole.className='btn btn-primary';
        }
        function DeleteRole(Id) {
            document.getElementById('DeleteRoleId').value=Id;
        }
        $("#RoleForm").validate({
            rules: {
                RoleName: {
                    required: true,
                },
            },
        });
    </script>
@endsection
