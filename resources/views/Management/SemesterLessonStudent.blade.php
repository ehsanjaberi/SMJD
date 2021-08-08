@extends('layouts.app')
@section('head')
@endsection
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>ثبت نام دانشجو</h5>
        </section>
        <section class="content-body">
            <form action="{{ route('GetSemesterLessonStudent') }}" method="post" id="SearchStudent">
                @csrf
                <div class="row text-right mb-4">
                    <div class="col-md-3">
                        <input type="text" name="PersonalCode" id="Search_PersonalCode" class="form-control" placeholder="شماره دانشجویی" autocomplete="off">
                    </div>
                    <div class="col-md-3 mt-auto">
                        <button type="submit" class="btn btn-primary">جستجو</button>
                        <div class="loader" id="SearchCircleLoader" hidden style="top: 10px;margin: 0 8px;right: 90px;">Loading...</div>
                    </div>
                </div>
            </form>
            <div class="UserList" style="position: absolute;margin-top: -1.6rem;">

            </div>
            <div class="row">
                <ul class="list-unstyled d-flex flex-column text-right pr-3 justify-content-between" id="StudentDetails">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <div class="row flex-column mx-1">
                <ul class="nav nav-tabs" id="StudentTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="LessonAssigned-tab" data-toggle="tab" href="#LessonAssigned" role="tab" aria-controls="home" aria-selected="true">لیست دروس انتسابی</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="LessonAssign-tab" data-toggle="tab" href="#LessonAssign" role="tab" aria-controls="profile" aria-selected="false">انتساب درس</a>
                    </li>
                    <li class="d-flex align-items-center" style="text-shadow: 0 0 5px black">
                        <span id="SemesterName"></span>
                    </li>
                </ul>
                <div class="tab-content" id="StudentContent">
{{--                    LessonAssigned--}}
                    <div class="tab-pane fade show active p-2 border border-top-0 rounded-bottom" id="LessonAssigned" role="tabpanel" aria-labelledby="LessonAssigned-tab">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 20px;">#</th>
                                    <th scope="col" class="text-right">درس</th>
                                    <th scope="col" class="text-right">استاد</th>
                                    <th scope="col" class="text-right">نمره</th>
                                </tr>
                                </thead>
                                <tbody id="LessonAssignedList">

                                </tbody>
                            </table>

                        </div>
                    </div>
{{--                    LessonAssign--}}
                    <div class="tab-pane fade  p-2 border border-top-0 rounded-bottom" id="LessonAssign" role="tabpanel" aria-labelledby="LessonAssign-tab">
                        <form action="{{ route('AddSemesterLessonStudent') }}" method="post" id="StoreForm">
                            @csrf
                            <input type="text" name="StudentId" id="StudentId" hidden>
                            <div class="row text-right mb-2">
                                <div class="col-md-4">
                                    <label for="">دانشگاه</label>
                                    <input type="text" class="form-control" readonly id="University" placeholder="دانشگاه">
    {{--                                <select name="" class="form-control">--}}
    {{--                                    <option value="0">دانشکده فنی شهید منتظری مشهد</option>--}}
    {{--                                </select>--}}
                                </div>
                                <div class="col-md-3">
                                    <label for="">دانشکده</label>
                                    <input type="text" class="form-control" readonly id="College" placeholder="دانشکده">
    {{--                                <select name="" class="form-control">--}}
    {{--                                    <option value="0">دانشگاه فنی منتظری مشهد</option>--}}
    {{--                                </select>--}}
                                </div>
                                <div class="col-md-3">
                                    <label for="">رشته تحصیلی</label>
                                    <input type="text" class="form-control" readonly id="Field" placeholder="رشته تحصیلی">
    {{--                                <select name="" class="form-control">--}}
    {{--                                    <option value="0">مهندسی تکنولوژی نرم افزار</option>--}}
    {{--                                    <option value="0">کامپیوتر کاردانی</option>--}}
    {{--                                </select>--}}
                                </div>

                                <div class="col-md-1 d-flex justify-content-start align-items-end">
                                    <button type="submit" class="btn btn-primary text-white float-left">ذخیره</button>
                                    <div class="loader" id="StoreCircleLoader" hidden style="bottom: 10px;margin: 0 8px;left: -20px;">Loading...</div>
                                </div>
                            </div>
                            <div id="SemesterLessonList">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="text-center" style="width: 20px;">#</th>
                                            <th scope="col" class="text-right" style="width: 300px;">نام درس</th>
                                            <th scope="col" class="text-right">استاد</th>
                                            <th scope="col" class="text-center">
                                                انتخاب
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="AssignLessonList">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <small class="custom-message" id="ShowMsg" style="opacity: 0;pointer-events: none">
            <i class="fa fa-exclamation-circle"></i>
            <span>پیغام اینجا نمایش داده می شود.</span>
        </small>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        let StudentId;
        document.getElementById('SearchStudent').addEventListener('submit',function (event) {
            event.preventDefault();
            document.getElementById('SearchCircleLoader').removeAttribute('hidden');
            // let Student=document.getElementById('StudentDetails');
            let Form=new FormData(this);
            axios.post(this.action,Form)
            .then((response)=>{
                console.log(response.data)
                document.getElementById('SearchCircleLoader').setAttribute('hidden','hidden');
                SetInf(response);
            })
            .catch((error)=>{
                console.log(error.data);
            })
        })
        document.getElementById('StoreForm').addEventListener('submit',function (event) {
            event.preventDefault();
            document.getElementById('StoreCircleLoader').removeAttribute('hidden');
            let Form=new FormData(this);
            axios.post(this.action,Form)
                .then((response)=>{
                    document.getElementById('StoreCircleLoader').setAttribute('hidden','hidden');
                    SetInf(response);
                })
                .catch((error)=>{
                    console.log(error.data);
                })

        })
        function SetInf(response) {
            let Student=document.getElementById('StudentDetails');
            if (response.data.Student){
                document.getElementById('SemesterName').textContent=response.data.Semester.Name;
                Student.children[0].innerHTML='نام و نام خانوادگی: <span class="text-primary">'+ response.data.Student.person.Name +' '+ response.data.Student.person.Family +'</span>';
                Student.children[1].innerHTML='شماره ملی: <span class="text-primary">'+ response.data.Student.person.NationalCode +'</span>';
                Student.children[2].innerHTML='رشته تحصیلی: <span class="text-primary">'+ response.data.Student.field.college.university.Name+' &raquo; '+response.data.Student.field.college.Name+' &raquo; '+response.data.Student.field.Name +'</span>';
                document.getElementById('University').value=response.data.Student.field.college.university.Name;
                document.getElementById('College').value=response.data.Student.field.college.Name;
                document.getElementById('Field').value=response.data.Student.field.Name;
                // document.getElementById('SemesterLessonList').innerHTML=response.data.LessonList
                document.getElementById('StudentId').value=response.data.Student.id;
                // AssignedLesson
                if(response.data.AssignedLesson) {
                    let html='';
                    for (var i=0;i<response.data.AssignedLesson.length; i++)
                    {
                        var temp=`<tr>
                                    <th scope="row" class="text-center">${i+1}</th>
                                    <td class="text-right">${response.data.AssignedLesson[i].LessonName}</td>
                                    <td class="text-right">${response.data.AssignedLesson[i].TeacherName}</td>
                                    <td class="text-right">${response.data.AssignedLesson[i].Grade}</td>
                                </tr>`
                        html += temp;
                    }
                    document.getElementById('LessonAssignedList').innerHTML=html;
                }
                if(response.data.AssignLesson) {
                    let html1='';
                    for (var j=0;j<response.data.AssignLesson.length; j++)
                    {
                        var temp1=`<tr>
                                        <th scope="row" class="text-center">${j+1}</th>
                                        <td class="text-right">${response.data.AssignLesson[j].LessonName}</td>
                                        <td class="text-right">${response.data.AssignLesson[j].Teacher}</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"${(response.data.AssignLesson[j].Checked)? 'checked':''} class="custom-control-input" value="${response.data.AssignLesson[j].SemesterLessonId +'|'+response.data.AssignLesson[j].SemesterLessonTeacherId}" name="LessonList[]" id="${'Lesson' + j+1}">
                                                <label class="custom-control-label S-Student" for="${'Lesson'+ j+1}"></label>
                                            </div>
                                        </td>
                                </tr>`
                        html1 += temp1;
                    }
                    document.getElementById('AssignLessonList').innerHTML=html1;
                }
            }
            else{
                Student.children[0].innerHTML='<sapn class="text-danger">شماره دانشجویی مورد نظر پیدا نشد.</sapn>';
                Student.children[1].innerHTML='';
                Student.children[2].innerHTML='';
                document.getElementById('University').value='';
                document.getElementById('College').value='';
                document.getElementById('Field').value='';
                document.getElementById('SemesterLessonList').innerHTML='';
                StudentId=null;
            }

        }
        function ShowMsg(text,bgcolor) {
            document.getElementById('ShowMsg').children[1].textContent=text;
            document.getElementById('ShowMsg').style.opacity=1;
            setTimeout(function () {
                document.getElementById('ShowMsg').style.opacity=0;
            },2000)
        }
        $('#Search_PersonalCode').keyup(function () {
            var URL='{{ route('SearchStudent',':Code') }}';
            URL=URL.replace(':Code',$(this).val())
                axios.get(URL)
            // axios.get('/classlist/searchclass/'+$(this).val())
                .then((response)=>{
                    $(".UserList").fadeIn();
                    $(".UserList").html(response.data.Output);
                })
                .catch((error)=>{
                    console.log(error.data)
                })
        });
        $(document).on('click','li.click',function () {
            console.log($(this).text())
            $('#Search_PersonalCode').val($(this).text())
            $(".UserList").fadeOut();
        })
    </script>
@endsection
