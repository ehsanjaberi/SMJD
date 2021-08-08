@extends('layouts.app')
@section('content')
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>مدیریت کاربران </h5>
        </section>
        <section class="content-body">
            <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                        @if($Per->PermissionId == 23)
                            <table class="table table-striped">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 20px;">#</th>
                                    <th scope="col" class="text-right" style="width: 100px;">نام</th>
                                    <th scope="col" class="text-center" style="width: 100px;">کد ملی</th>
                                    <th scope="col" class="text-center" style="width: 100px;">نام کاربری</th>
                                    <th scope="col" class="text-center" style="width: 100px;">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($Users as $user)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                        <td class="text-right">{{ $user->Person->Name.' '.$user->Person->Family }}</td>
                                        <td class="text-center">{{ $user->Person->NationalCode }}</td>
                                        <td class="text-center Username">{{ $user->Username }}</td>
                                        <td class="text-center">
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                @if($Per->PermissionId == 82)
                                                    <a href="#" class="mx-1 text-decoration-none" onclick="EditUser(this,'{{ $user->Person->NationalCode }}')">
                                                        <i class="fa fa-edit text-success"></i>
                                                    </a>
                                                @endif
                                            @endforeach
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                @if($Per->PermissionId == 81)
                                                    <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteUser" onclick="DeleteUser({{ $user->id }})">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                @endif
                                            @endforeach
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                @if($Per->PermissionId == 95)
                                                    <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#UserRole" onclick="UserRole('{{ $user->Person->Name.' '.$user->Person->Family }}',{{ $user->id }})">
                                                        <i class="fa fa-key text-primary"></i>
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
                        @endif
                    @endforeach
                </div>
                <div dir="ltr" class="d-flex justify-content-center">
                    {{ $Users->render() }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div id="card-header" class="card-header text-right">
                        افزودن کاربر
                    </div>
                    <div class="card-body text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('SearchPerson') }}" method="post" id="SearchPersonForm">
                                    @csrf
                                    <div class="form-group">
                                        <div class="loader" hidden id="SearchPersonLoader" style="margin: 4px 100px 0px 0px">Loading...</div>
                                        <label for="">جستجو(کد ملی)</label>
                                        <div class=" input-group flex-row-reverse">
                                            <div class="input-group-prepend">
                                                <button type="submit" class="input-group-text" id="inputGroup-sizing-default1"><i class="fa fa-search"></i></button>
                                            </div>
                                            <input type="text" name="NationalCode" id="Search_NationalCode" class="form-control" placeholder="جستجو" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <ul class="pb-0 pr-0" id="Person_Details">
                                    <li>نام:</li>
                                    <li>کد ملی:</li>
                                    <li>شماره پرسنلی:</li>
                                    <li>جنسیت: </li>
                                </ul>
                            </div>
                        </div>
                        <form action="{{ route('register') }}" method="post" id="AddUserForm" class="AddUserForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group text-right">
                                        <label for="">نام کاربری</label>
                                        <input type="text" name="PersonId" id="Add_PersonId" style="opacity: 0; pointer-events: none;position:absolute;">
                                        <input type="text" id="OldCode" hidden>
                                        <input type="text" name="Username" id="Add_Username" class="form-control" placeholder="نام کاربری" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group text-right">
                                        <label for="">رمز عبور</label>
                                        <input type="text" name="Password" id="Add_Password" class="form-control" placeholder="رمز عبور" autocomplete="off"/>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger ml-2" hidden id="BtnCancelForm" onclick="CancelEditUser()">
                                            انصراف
                                        </button>
                                        <button type="submit" class="btn btn-primary float-left" id="AddUserBtn">
                                            <div class="loader" hidden id="AddUserLoader" style="margin: 3px 13px">Loading...</div>
                                            افزودن
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="UserRole" tabindex="-1" aria-labelledby="UserRole" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header pl-0">
                    <h5 class="modal-title" id="exampleModalLabel">ارتباط نقش با کاربر</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('UserRole') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-group text-right">
                                    <input type="text" name="userid" id="userid" hidden>
                                    <label for=""><span>انتخاب نقش برای <b id="User_FullName"> احسان جابری </b> </span></label>
                                    <select name="SelectRole" id="SelectRole" class="form-control">
                                        <option value="def">انتخاب نقش</option>
                                        @foreach($Role as $role)
                                            <option value="{{ $role->id }}">{{ $role->Name }}</option>
                                        @endforeach
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
    <div class="modal fade" id="DeleteUser" tabindex="-1" role="dialog" aria-labelledby="DeleteUser" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger pl-0">
                    <h5 class="modal-title" id="DeleteRoleTitle">حذف نقش</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا مایل به حذف این کاربر هستید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteUser') }}" method="post">
                        @csrf
                        <input type="text" name="UserId" id="DeleteUserId" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">خیر</button>
                        <button type="submit" class="btn btn-primary">بله</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        let temp=0;
        document.getElementById('SearchPersonForm').addEventListener('submit',function (event) {
            event.preventDefault();
            let Form=new FormData(document.getElementById('SearchPersonForm'));
            if (Form.get('NationalCode') != '')
            {
                document.getElementById('SearchPersonLoader').removeAttribute('hidden');
                axios.post(this.action,Form)
                    .then((response)=>{
                        console.log(response.data);
                        document.getElementById('SearchPersonLoader').setAttribute('hidden','hidden');
                        let Person=document.getElementById('Person_Details');
                        if (response.data){
                            Person.children[0].innerHTML='نام:' + response.data.Name +' '+ response.data.Family;
                            Person.children[1].innerHTML='کد ملی:' + response.data.NationalCode;
                            if (response.data.employee)
                            {
                                Person.children[2].innerHTML='شماره پرسنلی:' + response.data.employee.PersonalCode;
                            }
                            else if(response.data.student)
                            {
                                Person.children[2].innerHTML='شماره پرسنلی:' + response.data.student.PersonalCode;
                            }
                            document.getElementById('Add_PersonId').value=response.data.id;
                            if (response.data.Gender==0)
                            {
                                Person.children[3].innerHTML='جنسیت:' + '<span class="fa fa-male"></span>';
                            }
                            else {
                                Person.children[3].innerHTML='جنسیت:' + '<span class="fa fa-female"></span>';
                            }
                        }
                        else{
                            Person.children[0].innerHTML='نام:';
                            Person.children[1].innerHTML='کد ملی:';
                            Person.children[2].innerHTML='شماره پرسنلی:';
                            Person.children[3].innerHTML='جنسیت:';
                            document.getElementById('Add_PersonId').value='';
                        }
                    })
                    .catch((error)=>{
                        console.log(error);
                    })
            }
        })
        document.getElementById('AddUserForm').addEventListener('submit',function (e) {
            e.preventDefault();
            if ($('#AddUserForm').valid())
            {
                let Form=new FormData(this);
                document.getElementById('AddUserBtn').setAttribute('disabled','disabled');
                // document.getElementById('AddUserLoader').removeAttribute('hidden');
                axios.post(this.action,Form)
                    .then((response)=> {
                        console.log(response.data)
                        window.location.href='{{ route('Users') }}';
                    })
                    .catch((error)=> {
                        const errors =error.response.data.errors;
                        const Errormessage=document.querySelectorAll('.text-danger');
                        Errormessage.forEach((element)=>element.textContent='')
                        document.getElementById('AddUserBtn').removeAttribute('disabled');
                        // document.getElementById('AddUserLoader').setAttribute('hidden','hidden');
                        // Show Error Message
                        // Object.keys(errors).forEach((element)=>{
                        //     const Item=document.getElementById('Add_' + element);
                        //     const ErrorMessage=Object(errors)[element];
                        //     Item.insertAdjacentHTML("afterend", `<small class="text-danger">${ErrorMessage}</small>`)
                        // })
                    })
            }
        })
        $.validator.addMethod("verifyUsername",
            function(value, element) {
                var result = false;
                $.ajax({
                    type:"POST",
                    async: false,
                    url: "{{ route('UniqueUsername') }}",
                    data: {
                        //do Check
                        "_token":$('meta[name="_token"]').attr('content'),
                        "Username": value,
                        "Old":document.getElementById('OldCode').value,
                        "Status":temp,
                    },
                    success: function(data) {
                        console.log(data)
                        result = (data == true) ? true : false;
                    }
                });
                return result;
                alert("RESULT "+result);
            },
            "نام کاربری تکراری است."
        );
        $("#AddUserForm").validate({
            onfocusout: false,
            onkeyup :false,
            rules: {
                Username: {
                    required: true,
                    verifyUsername: true
                },
                Password: {
                    required: function(element) {
                        return temp === 0;
                    }
                },
                PersonId:{
                    required: true,
                }
            },
            messages:{
                PersonId:"ابتدا جستجو کنید",
            }
        });
        function EditUser($this,Code) {
            console.log(Code)
            document.getElementById('Search_NationalCode').value=Code;
            document.getElementById('Add_Username').value=$($this).parent().siblings('.Username').text();
            document.getElementById('card-header').innerText='ویرایش کاربر'
            document.getElementById('AddUserForm').action='{{ route('EditUser') }}';
            document.getElementById('BtnCancelForm').removeAttribute('hidden');
            //Do Check
            let BtnSubmit = document.getElementById('AddUserBtn');
            let IdInput = document.getElementById('OldCode');
            IdInput.setAttribute('name','OldUsername');
            BtnSubmit.textContent='ویرایش';
            BtnSubmit.className='btn btn-success';
            IdInput.value=$($this).parent().siblings('.Username').text();
            temp=1;
            let Form=new FormData(document.getElementById('SearchPersonForm'));
            if (Form.get('NationalCode') != '') {
                document.getElementById('SearchPersonLoader').removeAttribute('hidden');
                axios.post('{{ route('SearchPerson') }}',Form)
                    .then((response)=>{
                        document.getElementById('SearchPersonLoader').setAttribute('hidden','hidden');
                        let Person=document.getElementById('Person_Details');
                        if (response.data){
                            Person.children[0].innerHTML='نام:' + response.data.Name +' '+ response.data.Family;
                            Person.children[1].innerHTML='کد ملی:' + response.data.NationalCode;
                            if (response.data.employee)
                            {
                                Person.children[2].innerHTML='شماره پرسنلی:' + response.data.employee.PersonalCode;
                            }
                            else if(response.data.student)
                            {
                                Person.children[2].innerHTML='شماره پرسنلی:' + response.data.student.PersonalCode;
                            }
                            document.getElementById('Add_PersonId').value=response.data.id;
                            if (response.data.Gender==0)
                            {
                                Person.children[3].innerHTML='جنسیت:' + '<span class="fa fa-male"></span>';
                            }
                            else {
                                Person.children[3].innerHTML='جنسیت:' + '<span class="fa fa-female"></span>';
                            }
                        }
                        else{
                            Person.children[0].innerHTML='نام:';
                            Person.children[1].innerHTML='کد ملی:';
                            Person.children[2].innerHTML='شماره پرسنلی:';
                            Person.children[3].innerHTML='جنسیت:';
                            document.getElementById('Add_PersonId').value='';
                        }
                    })
                    .catch((error)=>{
                        console.log(error);
                    })
            }

        }
        function CancelEditUser() {
            let Person=document.getElementById('Person_Details');
            document.getElementById('card-header').innerText='افزودن کاربر'
            document.getElementById('AddUserForm').action='{{ route('register') }}';
            document.getElementById('BtnCancelForm').setAttribute('hidden','hidden');
            document.getElementById('Search_NationalCode').value=null;
            document.getElementById('Add_Username').value=null
            document.getElementById('OldCode').removeAttribute('name');
            let Btn = document.getElementById('AddUserBtn');
            Btn.textContent='افزودن';
            Btn.className='btn btn-primary';
            temp=0;
            Person.children[0].innerHTML='نام:';
            Person.children[1].innerHTML='کد ملی:';
            Person.children[2].innerHTML='شماره پرسنلی:';
            Person.children[3].innerHTML='جنسیت:';
            document.getElementById('Add_PersonId').value='';
        }
        function DeleteUser(Code) {
            document.getElementById('DeleteUserId').value=Code;
        }
        function UserRole(Name,id) {
            document.getElementById('userid').value=id;
            document.getElementById('SelectRole').value='def';
            document.getElementById('User_FullName').textContent=Name;
            var URL='{{ route('GetUserRole',':Code') }}';
            URL=URL.replace(':Code',id);
            axios.get(URL)
            .then((response)=>{
                console.log(response.data)
                if (response.data.RoleId){
                    document.getElementById('SelectRole').value=response.data.RoleId
                }

            }).catch((error)=>{
                console.log(error.data);
            })
        }
    </script>
@endsection
