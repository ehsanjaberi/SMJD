@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>رشته های تحصیلی</h5>
            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                @if($Per->PermissionId == 41)
                    <a href="#" data-toggle="modal" data-target="#AddField" class="btn btn-info">
                        افزودن رشته
                    </a>
                @endif
            @endforeach
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 38)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 20px;">#</th>
                                        <th scope="col" class="text-right">کد</th>
                                        <th scope="col" class="text-center">عنوان</th>
                                        <th scope="col" class="text-center">دانشگاه</th>
                                        <th scope="col" class="text-center">روزانه/شبانه</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Fields as $field)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $field->Code }}</td>
                                            <td class="text-center">{{ $field->Name }}</td>
                                            <td class="text-center">{{ $field->College->University->Name .'('. $field->College->Name.')' }}</td>
                                            <td class="text-center">{{ $field->IsDaily==0?'روزانه':'شبانه' }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 40)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditField" onclick="EditField({{ $field->id }})">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                    @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                        @if($Per->PermissionId == 39)
                                                            <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteField" onclick="DeleteField({{ $field->id }})">
                                                                <i class="fa fa-trash text-danger"></i>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" dir="ltr">
                                    {{ $Fields->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddField" tabindex="-1" aria-labelledby="AddField" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddFieldTitle">افزودن رشته</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddField') }}" method="post" id="AddFieldForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="UniversityId" class="form-control" onchange="CollegeSearch(this,'Add')">
                                        <option value="def">انتخاب دانشگاه</option>
                                        @foreach($University as $university)
                                            <option value="{{ $university->id }}">{{ $university->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden id="AddCircleLoader">Loading...</div>
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
                                    <label for="">نام</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="نام">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-0 mt-3">
                                    <label for="">روزانه | شبانه</label>
                                    <div class=" form-check-inline errorCustom">
                                        <label for="day" class="form-check-label">روزانه</label>
                                        <input type="radio" id="day" class="form-check-input" value="0" name="IsDaily">
                                        <label for="night" class="form-check-label mr-2">شبانه</label>
                                        <input type="radio" id="night" class="form-check-input" value="1" name="IsDaily">
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
    <div class="modal fade" id="EditField" tabindex="-1" aria-labelledby="EditField" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditFieldTitle">ویرایش رشته</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditFiled') }}" method="post" id="EditFieldForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">دانشگاه</label>
                                    <select name="UniversityId" id="edit_UniversityId" class="form-control" onchange="CollegeSearch(this,'Edit')">
                                        <option value="">انتخاب دانشگاه</option>
                                        @foreach($University as $university)
                                            <option value="{{ $university->id }}">{{ $university->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="loader" hidden id="EditCircleLoader">Loading...</div>
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
                                    <label for="edit_Name">نام</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="نام">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_Code">کد</label>
                                    <input type="text" name="OldId" id="OldId" hidden>
                                    <input type="text" name="Code" id="edit_Code" class="form-control" placeholder="کد">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-0 mt-3">
                                    <label for="">روزانه | شبانه</label>
                                    <div class=" form-check-inline">
                                        <label for="edit_day" class="form-check-label">روزانه</label>
                                        <input type="radio" id="edit_day" value="0" class="form-check-input" name="IsDaily">
                                        <label for="edit_night" class="form-check-label mr-2">شبانه</label>
                                        <input type="radio" id="edit_night" value="1" class="form-check-input"name="IsDaily">
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
    <div class="modal fade" id="DeleteField" tabindex="-1" aria-labelledby="DeleteField" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteFieldTitle">حذف رشته</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این رشته تحصیلی را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteFiled') }}" method="post">
                        @csrf
                        <input type="text" name="Code" id="Delete_Code" hidden>
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
        let CollegeId=0;
        function CollegeSearch($this,type) {
            let UniversityId=$($this).val();
            if (UniversityId !== '')
            {
                document.getElementById(type + 'CircleLoader').removeAttribute('hidden');
                var URL='{{ route('GetCollegeInformation',':Code') }}';
                URL=URL.replace(':Code',UniversityId);
                axios.get(URL)
                    .then(function (response) {
                        let CollegeList=document.getElementById(type +'CollegeId');
                        CollegeList.options.length=0;
                        document.getElementById(type + 'CircleLoader').setAttribute('hidden','hidden');
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
        function ChooseCollege() {
            document.getElementById('EditCollegeId').value = 222;
        }
        function EditField(Code) {
            var URL='{{ route('GetField',':Code') }}';
            URL=URL.replace(':Code',Code);
            axios.get(URL)
                .then(function (response) {
                    document.getElementById('edit_UniversityId').value = response.data.college.university.id;
                    CollegeId = document.getElementById('EditCollegeId').value = response.data.college.id;
                    document.getElementById('edit_UniversityId').onchange();
                    document.getElementById('edit_Name').value=response.data.Name;
                    document.getElementById('edit_Code').value=response.data.Code;
                    document.getElementById('OldId').value=response.data.id;
                    if (response.data.IsDaily == 0)
                    {
                        document.getElementById('edit_day').checked = true;
                    }
                    else {
                        document.getElementById('edit_night').checked = true;
                    }
                })
        }
        function DeleteField(Code) {
            document.getElementById('Delete_Code').value=Code;
        }
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "تکمیل این فیلد اجباری است.");
        $("#AddFieldForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                    valueNotEquals:"def"
                },
                Code: {
                    required: true,
                },
                Name:{
                    required: true,
                },
                IsDaily:{
                    required: true,
                }
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
        $("#EditFieldForm").validate({
            rules: {
                UniversityId: {
                    required: true,
                    valueNotEquals:"def"
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
                IsDaily:{
                    required: true,
                }
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

