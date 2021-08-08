@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>دانشگاه ها</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 61)
                    <a href="#" data-toggle="modal" data-target="#AddUniversity" class="btn btn-info">
                        افزودن دانشگاه
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 64)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">کد</th>
                                        <th scope="col" class="text-right">عنوان</th>
                                        <th scope="col" class="text-right">آدرس</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($University as $university)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $university->Code }}</td>
                                            <td class="text-right">{{ $university->Name }}</td>
                                            <td class="text-right">{{ $university->Address }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 62)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditUniversity" onclick="EditUniversity({{ $university->id }})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 63)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteUniversity" onclick="DeleteUniversity({{ $university->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" dir="ltr">
                                    {{ $University->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddUniversity" tabindex="-1" aria-labelledby="AddUniversity" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddUniversityTitle">افزودن دانشگاه</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddUniversity') }}" method="post" id="AddUniForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد</label>
                                    <input type="text" name="Uni_Code" id="Uni_Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان</label>
                                    <input type="text" name="Uni_Name" id="Uni_Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">آدرس</label>
                                    <input type="text" name="Uni_Address" id="Uni_Address" class="form-control" placeholder="آدرس">
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
    <div class="modal fade" id="EditUniversity" tabindex="-1" aria-labelledby="EditUniversity" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditUniversityTitle">ویرایش دانشگاه</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditUniversity') }}" method="post" id="EditUniForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد</label>
                                    <input type="text" name="Uni_Old_Code" id="edit_Uni_Old_Code" hidden>
                                    <input type="text" name="Uni_Code" id="edit_Uni_Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان</label>
                                    <input type="text" name="Uni_Name" id="edit_Uni_Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">آدرس</label>
                                    <input type="text" name="Uni_Address"id="edit_Uni_Address" class="form-control" placeholder="آدرس">
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
    <div class="modal fade" id="DeleteUniversity" tabindex="-1" aria-labelledby="DeleteUniversity" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteUniversityTitle">حذف دانشگاه</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این دانشگاه را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteUniversity') }}" method="post">
                        @csrf
                        <input type="text" id="Delete_Uni_Code" name="Uni_Code" hidden>
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
        function EditUniversity(Code) {
            var URL='{{ route('GetUniversity',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
                .then(function (response) {
                    // console.log(response.data.Name);
                    document.getElementById('edit_Uni_Old_Code').value=response.data.id;
                    document.getElementById('edit_Uni_Code').value=response.data.Code;
                    document.getElementById('edit_Uni_Name').value=response.data.Name;
                    document.getElementById('edit_Uni_Address').value=response.data.Address;
                })
        }
        function DeleteUniversity(Code) {
            document.getElementById('Delete_Uni_Code').value=Code;
        }
        $("#AddUniForm").validate({
            rules: {
                Uni_Code: {
                    required: true,
                },
                Uni_Name: {
                    required: true,
                },
                Uni_Address:{
                    required: true,
                }
            },
        });
        $("#EditUniForm").validate({
            rules: {
                Uni_Code: {
                    required: true,
                },
                Uni_Name: {
                    required: true,
                },
                Uni_Address:{
                    required: true,
                }
            },
        });
    </script>
@endsection
