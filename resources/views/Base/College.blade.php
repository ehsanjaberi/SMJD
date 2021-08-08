@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>دانشکده ها</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 36)
                    <a href="#" data-toggle="modal" data-target="#AddCollege" class="btn btn-info">
                        افزودن دانشکده
                    </a>
                    @break
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                        @if($Per->PermissionId == 33)
                            <div class="table-responsive">
                                <table class="table table-striped" style="white-space: nowrap;">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">کد</th>
                                        <th scope="col" class="text-center">دانشگاه</th>
                                        <th scope="col" class="text-center">عنوان دانشکده</th>
                                        <th scope="col" class="text-center">ایمیل</th>
                                        <th scope="col" class="text-center">وبسایت</th>
                                        <th scope="col" class="text-center">کد پستی</th>
                                        <th scope="col" class="text-center">آدرس</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Colleges as $college)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $college->Code }}</td>
                                            <td class="text-right">{{ $college->University->Name }}</td>
                                            <td class="text-center">{{ $college->Name }}</td>
                                            <td class="text-center">{{ $college->Email }}</td>
                                            <td class="text-center">{{ $college->Website }}</td>
                                            <td class="text-center">{{ $college->PostalCode }}</td>
                                            <td class="text-center">{{ $college->Address }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 35)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditCollege" onclick="EditCollege('{{ $college->id }}')">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        @break
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 34)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteCollege" onclick="DeleteCollege('{{ $college->id }}')">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                        @break
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
                                {{ $Colleges->render() }}
                            </div>
                            @break
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddCollege" tabindex="-1" aria-labelledby="AddCollege" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddCollegeTitle">افزودن دانشکده</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddCollege') }}" method="post" id="AddCollegeForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-right">
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
                                    <label for="">کد</label>
                                    <input type="text" name="Code" id="Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">وبسایت</label>
                                    <input type="text" name="Website" id="Website" class="form-control" placeholder="وبسایت">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد پستی</label>
                                    <input type="text" name="PostalCode" id="PostalCode" class="form-control" placeholder="کد پستی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">ایمیل</label>
                                    <input type="text" name="Email" id="Email" class="form-control" placeholder="ایمیل">
                                </div>
                            </div>
{{--                            <div class="col-md-6 d-flex justify-content-around">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="">لوگو</label>--}}
{{--                                    <input type="file" name="logo" id="logo" class="form-control-file" placeholder="لوگو" onchange="readURL(this,'add')">--}}
{{--                                </div>--}}
{{--                                <img src="{{ asset('images/CollegePlaceholder.png') }}" id="logo_img" class="img-thumbnail rounded-circle" width="100px" height="100px" alt="">--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">آدرس</label>
                                    <input type="text" name="Address" id="Address" class="form-control" placeholder="آدرس">
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
    <div class="modal fade" id="EditCollege" tabindex="-1" aria-labelledby="EditCollege" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditCollegeTitle">ویرایش دانشکده</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditCollege') }}" method="post" id="EditCollegeForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="edit_UniversityId" class="form-control">
                                        @foreach($University as $university)
                                            <option value="{{ $university->id }}">{{ $university->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد</label>
                                    <input type="text" name="Old_Code" id="edit_Old_Code" hidden>
                                    <input type="text" name="Code" id="edit_Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">وبسایت</label>
                                    <input type="text" name="Website" id="edit_Website" class="form-control" placeholder="وبسایت">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد پستی</label>
                                    <input type="text" name="PostalCode" id="edit_PostalCode" class="form-control" placeholder="کد پستی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">ایمیل</label>
                                    <input type="text" name="Email" id="edit_Email" class="form-control" placeholder="ایمیل">
                                </div>
                            </div>
{{--                            <div class="col-md-6 d-flex justify-content-around">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="">لوگو</label>--}}
{{--                                    <input type="file" name="logo" id="edit_logo" class="form-control-file" placeholder="لوگو" onchange="readURL(this,'edit')">--}}
{{--                                </div>--}}
{{--                                <img src="" id="edit_logo_img" class="img-thumbnail rounded-circle" width="100px" height="100px" alt="">--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">آدرس</label>
                                    <input type="text" name="Address" id="edit_Address" class="form-control" placeholder="آدرس">
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
    <div class="modal fade" id="DeleteCollege" tabindex="-1" aria-labelledby="DeleteCollege" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteCollegeTitle">حذف دانشکده</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این دانشکده را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteCollege') }}" method="post">
                        @csrf
                        <input type="text" name="Code" id="Delete_College_Code" hidden>
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
        function EditCollege(Code) {
            var URL='{{ route('GetCollege',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
                .then(function (response) {
                    let College=response.data[0];
                    document.getElementById('edit_Old_Code').value=College.id;
                    document.getElementById('edit_Code').value=College.Code;
                    document.getElementById('edit_Name').value=College.Name;
                    document.getElementById('edit_Website').value=College.Website;
                    document.getElementById('edit_PostalCode').value=College.PostalCode;
                    document.getElementById('edit_UniversityId').value=College.UniversityId;
                    // document.getElementById('edit_logo_img').setAttribute('src','/storage'+College.Logo);
                    document.getElementById('edit_Email').value=College.Email;
                    document.getElementById('edit_Address').value=College.Address;
                });
        }
        function DeleteCollege(Code) {
            document.getElementById('Delete_College_Code').value=Code;
        }
        {{--function readURL(input,type) {--}}
        {{--    var url = input.value;--}}
        {{--    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();--}}
        {{--    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {--}}
        {{--        var reader = new FileReader();--}}

        {{--        reader.onload = function (e) {--}}
        {{--            if (type === 'edit')--}}
        {{--            {$('#edit_logo_img').attr('src', e.target.result);}--}}
        {{--            else--}}
        {{--            {$('#logo_img').attr('src', e.target.result);}--}}

        {{--        }--}}
        {{--        reader.readAsDataURL(input.files[0]);--}}
        {{--    }--}}
        {{--    else{--}}
        {{--        if (type === 'edit')--}}
        {{--        {$('#edit_logo_img').attr('src','{{ asset('images/CollegePlaceholder.png') }}');}--}}
        {{--        else--}}
        {{--        {$('#logo_img').attr('src','{{ asset('images/CollegePlaceholder.png') }}');}--}}
        {{--    }--}}
        {{--}--}}
        $("#AddCollegeForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                },
                Code: {
                    required: true,
                },
                Name:{
                    required: true,
                }
            },
        });
        $("#EditCollegeForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                },
                Code: {
                    required: true,
                },
                Name:{
                    required: true,
                }
            },
        });
    </script>
@endsection
