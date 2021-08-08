<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Messenger.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- Content wrapper start -->
    <div class="content-wrapper" style="box-shadow: 0 0 20px 0 darkgrey">
        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card m-0">
                    <!-- Row start -->
                    <div class="row no-gutters flex-row-reverse">
                        @if(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->Name==='سوپر ادمین')
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                                <div class="users-container">
                                    <div class="chat-search-box">
                                        پیام های دریافتی
                                    </div>
                                    <ul class="users" id="users-list">
                                    </ul>
                                    <ul class="users-tab d-flex justify-content-center">
                                        <li class="mx-3" style="cursor:pointer;" onclick="SendAllUser()"><span class="fa fa-envelope"></span></li>
                                        <li class="mx-3" style="cursor:pointer;" onclick="GetAllContants()"><span class="fa fa-users"></span></li>
                                        <li class="mx-3" style="cursor:pointer;" onclick="GetAllContant()"><span class="fa fa-user"></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class=" col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">
                        @else
                            <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        @endif
                            <div class="selected-user text-right">
                                @if(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->Name!=='سوپر ادمین')
                                    <span>ارسال پیام به: <span class="name">مدیر</span></span>
                                @else
                                    <span class="name" id="to_name"></span>
                                @endif
                            </div>
                            <div class="chat-container">
                                <ul class="chat-box chatContainerScroll" id="chat-box">
                                    @if(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->Name!=='سوپر ادمین')
                                        @foreach($Message as $message)
                                            @if($message->from_id==\Illuminate\Support\Facades\Auth::user()->id)
                                                <li class="chat-left">
                                                    <div class="chat-avatar">
                                                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                        <div class="chat-name">شما</div>
                                                    </div>
                                                    <div class="chat-text" dir="rtl">
                                                        {{ $message->body }}
                                                    </div>
                                                    <div class="chat-hour">{{ substr($message->created,11,5) }}
                                                        <span class="fa fa-trash text-danger" onclick="DeleteMessage('{{ $message->id }}',this,'One')" style="cursor:pointer;"></span>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="chat-right">
                                                    <div class="chat-hour">{{ substr($message->created,11,5) }}
                                                        {{--                                                    <span class="fa fa-check-circle"></span>--}}
                                                    </div>
                                                    <div class="chat-text" dir="rtl">
                                                        {{ $message->body }}
                                                    </div>
                                                    <div class="chat-avatar">
                                                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                        <div class="chat-name">مدیر</div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li class="chat-center">
                                            <div class="chat-status">
                                                یک کفتگو را انتخاب کنید
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div  class="form-group mt-3 mb-0">
                                <form action="{{ route('sendMessage') }}" method="post" id="SendForm">
                                    @csrf
                                    <div class="input-group mb-3">
                                        @if(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->Name!=='سوپر ادمین')
                                            <input type="text" value="0" name="to_id" id="to_id" hidden>
                                        @else
                                            <input type="text" name="to_id" id="to_id" hidden>
                                        @endif
                                        <div class="input-group-prepend  cursor-pointer">
                                            <button type="submit" style="padding: 7px;font-size: 24px" class="text-primary fa fa-send border-0"></button>
                                        </div>
                                        <input type="text" name="Message" id="MessageSend" class="form-control text-right" placeholder="پیام"  aria-describedby="basic-addon1">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Content wrapper end -->
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        let UserStatus=0;
        $(".chat-container").animate({ scrollTop: $("#chat-box").height() }, 0);
        @if(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->Name=='سوپر ادمین')
            UserStatus=1;
        @endif
        if (UserStatus=1)
        {
            GetAllContant();
        }
    })
    document.getElementById('SendForm').addEventListener('submit',(event)=>{
        event.preventDefault();
        let Form=new FormData(document.getElementById('SendForm'));
        if (document.getElementById('MessageSend').value!='')
        {
            axios.post(document.getElementById('SendForm').action,Form)
                .then((response)=>{
                    document.getElementById('MessageSend').value='';
                    if (response.data[0]=='true'){
                        var temp=`
                    <li class="chat-left">
                        <div class="chat-avatar">
                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                            <div class="chat-name">شما</div>
                        </div>
                        <div class="chat-text">
                            ${response.data[1].body}
                        </div>
                        <div class="chat-hour">${ (response.data[1].created).substr(11,5) }
                        <span class="fa fa-trash text-danger" onclick="DeleteMessage(${ (response.data[1].id)},this)" style="cursor:pointer;"></span>                        </div>
                    </li>
                `;
                        $('#chat-box').append(temp);
                        $(".chat-container").animate({ scrollTop: $("#chat-box").height() }, 500);
                    }
                })
        }
    })
    function Show_Messages(From_Id,$this) {
        $($this).siblings().removeClass('active-user');
        $($this).addClass('active-user');
        $('#to_name').text($($this)[0].innerText);
        document.getElementById('to_id').value=$($this).attr('data-chat').substr(6);
        $('#chat-box').html('');
        axios.post('{{ route('GetContactMessage') }}',{
            '_token':'{{csrf_token()}}',
            'from_id':From_Id
        }).then((response)=>{
            response.data.forEach(function (message) {
                if (message.from_id==From_Id)
                {
                    var temp=`
                    <li class="chat-right">
                        <div class="chat-hour">${ (message.created).substr(11,5) }

                        </div>
                        <div class="chat-text" dir="rtl">
                            ${message.body}
                        </div>
                        <div class="chat-avatar">
                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                            <div class="chat-name">کاربر</div>
                        </div>
                    </li>
                `;
                }else {
                    var temp=`
                    <li class="chat-left">
                        <div class="chat-avatar">
                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                            <div class="chat-name">شما</div>
                        </div>
                        <div class="chat-text" dir="rtl">
                            ${message.body}
                        </div>
                        <div class="chat-hour">${ (message.created).substr(11,5) }
<span class="fa fa-trash text-danger" onclick="DeleteMessage(${ (message.id)},this)" style="cursor:pointer;"></span>                        </div>
                    </li>
                `;
                }
                $('#chat-box').append(temp);
                $(".chat-container").animate({ scrollTop: $("#chat-box").height() }, 0);
                // console.log(ee.from_id)
            })
        })
    }
    function GetAllContant() {
        $('#users-list').html('');
        axios.get('{{ route('GetContacts') }}')
            .then((response)=>{
                console.log(response.data)
                response.data.forEach(function (ee) {
                    console.log(ee);
                        var temp=` <li class="person" data-chat="person${ee.from_id}" onclick="Show_Messages(${ee.from_id},this)">
                                        <div class="user">
                                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                        </div>
                                        <p class="name-time">
                                            <span class="name">${ee.user.person.Name + ' ' + ee.user.person.Family}</span>
                                        </p>
                                    </li>`;
                        $('#users-list').append(temp);
                })
            })
    }
    function GetAllContants() {
        axios.get('{{ route('GetAllContacts') }}')
            .then((response)=>{
                $('#users-list').html('');
                response.data.forEach(function (ee) {
                    console.log(ee)
                    var temp=` <li class="person" data-chat="person${ee.id}" onclick="Show_Messages(${ee.id},this)">
                                        <div class="user">
                                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                        </div>
                                        <p class="name-time">
                                            <span class="name">${ee.person.Name+' '+ee.person.Family}</span>
                                        </p>
                                    </li>`;
                    $('#users-list').append(temp);
                })
            })
    }
    function SendAllUser() {
        document.getElementById('to_id').value='Admin';
        // $($this).siblings().removeClass('active-user');
        $('#to_name').text('همه کاربران');
        $('#chat-box').html('');
        axios.get('{{ route('GetAllMessageToUser') }}').then((response)=>{
            response.data.forEach(function (message) {

                    var temp=`
                    <li class="chat-left">
                        <div class="chat-avatar">
                            <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                            <div class="chat-name">شما</div>
                        </div>
                        <div class="chat-text" dir="rtl">
                            ${message.body}
                        </div>
                     <div class="chat-hour">${ (message.created).substr(11,5) }
                            <span class="fa fa-trash text-danger" onclick="DeleteAllMessage(${ (message.id)},this)" style="cursor:pointer;"></span>                        </div>
                    </li>`
                $('#chat-box').append(temp);
                $(".chat-container").animate({ scrollTop: $("#chat-box").height() }, 0);
                // console.log(ee.from_id)
            })
        })
    }
    function DeleteMessage(MesId,$this) {
        axios.post('{{ route('DeleteMessage') }}', {
            '_token':'{{ csrf_token() }}',
            'messageId':MesId,
            }).then((response)=>{
                if (response.data=='true')
                {
                    $($this).parent().parent().remove();
                }
        })
    }
    function DeleteAllMessage(MesId,$this) {
        axios.post('{{ route('DeleteAllMessage') }}', {
            '_token':'{{ csrf_token() }}',
            'messageId':MesId,
        }).then((response)=>{
            if (response.data=='true')
            {
                $($this).parent().parent().remove();
            }
        })
    }
</script>
</body>
</html>
