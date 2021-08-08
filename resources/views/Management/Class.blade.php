@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>کلاس ها</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 121)
                    <a href="#" data-toggle="modal" data-target="#AddClass" class="btn btn-info">
                        افزودن کلاس
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 118)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">کد</th>
                                        <th scope="col" class="text-right">عنوان</th>
                                        <th scope="col" class="text-right">وضعیت</th>
                                        <th scope="col" class="text-right">دانشگاه</th>
                                        <th scope="col" class="text-right">نوع</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Class as $class)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                                            <td class="text-right">{{ $class->Code }}</td>
                                            <td class="text-right">{{ $class->Name }}</td>
                                            <td class="text-right">{{ $class->ClassStatus==0 ? 'فعال' : 'غیرفعال' }}</td>
                                            <td class="text-right">{{ $class->College->University->Name.'('. $class->College->Name.')' }}</td>
                                            <td class="text-right">{{ $class->ClassType==0 ? 'کارگاه' : 'کلاس' }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 120)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditClass" onclick="EditClass({{ $class->id }})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 119)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteClass" onclick="DeleteCLass({{ $class->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" dir="ltr">
                                    {{ $Class->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddClass" tabindex="-1" aria-labelledby="AddClass" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddClassTitle">افزودن کلاس</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddClass') }}" method="post" id="AddClassForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="UniversityId" class="form-control" onchange="CollegeSearch(this,'Add')">
                                        @foreach($University as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader"  id="AddCollegeIdLoader" hidden>Loading...</div>
                                <div class="form-group">
                                    <label for="">دانشکده</label>
                                    <select name="CollegeId" id="AddCollegeId" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
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
                                    <label for="">نوع</label>
                                    <select name="ClassType" id="ClassType" class="form-control">
                                        <option value="0">کارگاه</option>
                                        <option value="1">کلاس</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="ClassStatus" id="ClassStatus" class="form-control">
                                        <option value="0">فعال</option>
                                        <option value="1">غیرفعال</option>
                                    </select>
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
    <div class="modal fade" id="EditClass" tabindex="-1" aria-labelledby="EditClass" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditClassTitle">ویرایش کلاس</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditClass') }}" method="post" id="EditClassForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="edit_UniversityId" class="form-control" onchange="CollegeSearch(this,'Edit')">
                                        @foreach($University as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader"  id="EditCollegeIdLoader" hidden>Loading...</div>
                                <div class="form-group">
                                    <label for="">دانشکده</label>
                                    <select name="CollegeId" id="EditCollegeId" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد</label>
                                    <input type="text" name="id" id="edit_id" hidden>
                                    <input type="text" name="Code" id="edit_Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان</label>
                                    <input type="text" name="name" id="edit_Name" class="form-control" placeholder="عنوان">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نوع</label>
                                    <select name="ClassType" id="edit_ClassType" class="form-control">
                                        <option value="0">کارگاه</option>
                                        <option value="1">کلاس</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="ClassStatus" id="edit_ClassStatus" class="form-control">
                                        <option value="0">فعال</option>
                                        <option value="1">غیرفعال</option>
                                    </select>
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
    <div class="modal fade" id="DeleteClass" tabindex="-1" aria-labelledby="DeleteClass" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteClassTitle">حذف کلاس</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این کلاس را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteClass') }}" method="post">
                        @csrf
                        <input type="text" name="id" id="DeleteId" hidden>
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
        let CollegeId;
        $(document).ready(function () {
            document.getElementById('UniversityId').onchange();
        })
        function CollegeSearch($this,type) {
            let UniversityId=$($this).val();
            if (UniversityId !== '')
            {
                document.getElementById(type + 'CollegeIdLoader').removeAttribute('hidden');
                var URL='{{ route('GetCollegeInformation',':Code') }}';
                URL=URL.replace(':Code',UniversityId);
                axios.get(URL)
                    .then(function (response) {
                        let CollegeList=document.getElementById(type +'CollegeId');
                        CollegeList.options.length=0;
                        document.getElementById(type + 'CollegeIdLoader').setAttribute('hidden','hidden');
                        for (let index in response.data)
                        {
                            CollegeList.options[CollegeList.options.length]=new Option(response.data[index].Name,response.data[index].id)
                        }
                        (type === 'Edit') ? document.getElementById('EditCollegeId').value=CollegeId : '';
                    })
            }
            else {
                document.getElementById(type + 'CollegeId').options.length=0;
            }
        }
        function EditClass(Code) {
            var URL='{{ route('GetClassInformation',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
            .then((response)=>{
                document.getElementById('edit_id').value=response.data.id;
                document.getElementById('edit_UniversityId').value=response.data.college.university.id;
                CollegeId=response.data.college.id;
                document.getElementById('edit_UniversityId').onchange();
                document.getElementById('edit_Code').value=response.data.Code;
                document.getElementById('edit_Name').value=response.data.Name;
                document.getElementById('edit_ClassType').value=response.data.ClassType;
                document.getElementById('edit_ClassStatus').value=response.data.ClassStatus;
            })
            .catch((error)=>{
                console.log(error.data);
            })
        }
        function DeleteCLass(Code) {
            document.getElementById('DeleteId').value=Code;
        }
        $("#AddClassForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                },
                CollegeId: {
                    required: true,
                },
                Code: {
                    required: true,
                },
                Name:{
                    required: true,
                },
                ClassType:{
                    required: true,
                },
                ClassStatus:{
                    required: true,
                }
            },
        });
        $("#EditClassForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                },
                CollegeId: {
                    required: true,
                },
                Code: {
                    required: true,
                },
                name:{
                    required: true,
                },
                ClassType:{
                    required: true,
                },
                ClassStatus:{
                    required: true,
                }
            },
        });
    </script>
@endsection
