@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>تجهیزات</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 68)
                    <a href="#" data-toggle="modal" data-target="#AddEquipment" class="btn btn-info">
                        افزودن تجهیزات
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 25)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">کد</th>
                                        <th scope="col" class="text-right">عنوان</th>
                                        <th scope="col" class="text-right">توضیحات</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Equipment as $equ)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                        <td class="text-right">{{ $equ->Code }}</td>
                                        <td class="text-right">{{ $equ->Name }}</td>
                                        <td class="text-right">{{ $equ->Description }}</td>
                                        <td class="text-center">
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                @if($Per->PermissionId == 67)
                                                    <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditEquipment" onclick="EditEquipment({{ $equ->id }})">
                                                        <i class="fa fa-edit text-success"></i>
                                                    </a>
                                                @endif
                                            @endforeach
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                @if($Per->PermissionId == 66)
                                                    <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteEquipment" onclick="DeleteEquipment({{ $equ->id }})">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center font-weight-bold bg-light">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div dir="ltr" class="d-flex justify-content-center">
                                    {{ $Equipment->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddEquipment" tabindex="-1" aria-labelledby="AddEquipment" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddEquipmentTitle">افزودن تجهیزات</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddEquipment') }}" method="post" id="AddEquipmentForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Code">کد</label>
                                    <input type="text" name="Code" id="Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Name">عنوان</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Desc">توضیحات</label>
                                    <input type="text" name="Desc" id="Desc" class="form-control" placeholder="توضیحات">
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
    <div class="modal fade" id="EditEquipment" tabindex="-1" aria-labelledby="EditEquipment" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditEquipmentTitle">ویرایش تجهیزات</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditEquipment') }}" method="post" id="EditEquipmentForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_Code">کد</label>
                                    <input type="text" name="id" id="edit_Id" hidden>
                                    <input type="text" name="Code" id="edit_Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_Name">عنوان</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="edit_Desc">توضیحات</label>
                                    <input type="text" name="Desc" id="edit_Desc" class="form-control" placeholder="توضیحات">
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
    <div class="modal fade" id="DeleteEquipment" tabindex="-1" aria-labelledby="DeleteEquipment" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteEquipmentTitle">حذف تجهیزات</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این وسیله را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteEquipment') }}" method="post">
                        @csrf
                        <input type="text" name="id" id="delete_Id" hidden>
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
        function EditEquipment(Code) {
            var URL='{{ route('GetEquipment',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
                .then(function (response) {
                    console.log(response.data);

                    document.getElementById('edit_Id').value=response.data.id;
                    document.getElementById('edit_Name').value=response.data.Name;
                    document.getElementById('edit_Code').value=response.data.Code;
                    document.getElementById('edit_Desc').value=response.data.Description;
                })
        }
        function DeleteEquipment(Code) {
            document.getElementById('delete_Id').value=Code;
        }
        $("#AddEquipmentForm").validate({
            rules: {
                Code: {
                    required: true,
                },
                Name: {
                    required: true,
                },
                Desc:{
                    required: true,
                }
            },
        });
        $("#EditEquipmentForm").validate({
            rules: {
                Code: {
                    required: true,
                },
                Name: {
                    required: true,
                },
                Desc:{
                    required: true,
                }
            },
        });
    </script>
@endsection
