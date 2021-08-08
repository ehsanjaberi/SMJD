@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>منو ها</h5>
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 20px;">#</th>
                                <th scope="col" class="text-center">نام</th>
                                <th scope="col" class="text-center">عنوان</th>
                                <th scope="col" class="text-center">آیکون</th>
                                <th scope="col" class="text-center">زیر سیستم</th>
                                <th scope="col" class="text-center">ترتیب</th>
                                <th scope="col" class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($Menu as $menu)
                                <tr>
                                    <th id="id" scope="row" class="edit text-center">{{ $menu->id }}</th>
                                    <td id="Name" class="edit text-right">{{ $menu->Name }}</td>
                                    <td id="Title" class="edit text-right">{{ $menu->Title }}</td>
                                    <td id="Icon" class="edit text-left">{{ $menu->icon }}</td>
                                    <td id="SubId" class="edit text-center">{{ $menu->SubSystemId }}</td>
                                    <td id="Order" class="edit text-center">{{ $menu->Order }}</td>
                                    <td class="text-center">
                                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                            @if($Per->PermissionId == 92)
                                                <span class="fa fa-edit text-success cursor-pointer" onclick="Edit(this)"></span>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div dir="ltr" class="d-flex justify-content-center">
                            {{ $Menu->render() }}
                        </div>
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
        function Edit($this) {
            let Sib=$($this).parent().siblings('.edit');
            let input='<input type="text" name="" class="form-control form-control-sm">';
            let select=`<select class="form-control form-control-sm">
                            <option value="1">سطوح دسترسی</option>
                            <option value="2">اطلاعات پایه</option>
                            <option value="3">گزارشات</option>
                            <option value="4">مدیریت</option>
                        </select>`;
            let Btns=`
                <span class="fa fa-save text-primary ml-2 cursor-pointer" onclick="Store(this)"></span>
                <span class="fa fa-ban text-danger cursor-pointer" onclick="CancelEdit(this)"></span>
            `
            for (var i=0; i<= Sib.length;i++)
            {
                var temp=$(Sib[i]).text();
                if ($(Sib[i]).attr('id')=='SubId')
                {
                    $(Sib[i]).html(select);
                    $(Sib[i]).html(select).find('select').val(temp);
                }else{
                    $(Sib[i]).html(input);
                    $(Sib[i]).html(input).find('input').attr('name',$(Sib[i]).attr('id'))
                    $(Sib[i]).html(input).find('input').val(temp);
                }
            }
            $($this).parent().html(Btns)

        }
        function CancelEdit($this) {
            let Sib=$($this).parent().siblings('.edit');
            let Btns=`
                <span class="fa fa-edit text-success cursor-pointer" onclick="Edit(this)"></span>
            `
            for (var i=0; i<= Sib.length;i++)
            {
                if ($(Sib[i]).attr('id')=='SubId')
                {
                    var temp=$(Sib[i]).find('select').val();
                }else {
                    var temp=$(Sib[i]).find('input').val();
                }
                $(Sib[i]).text(temp);
            }
            $($this).parent().html(Btns)
        }
        function Store($this) {
            let Sib=$($this).parent().siblings('.edit');
            let Btns=`
                <span class="fa fa-edit text-success cursor-pointer" onclick="Edit(this)"></span>
            `
            let Arr=[];
            for (var i=0; i< Sib.length;i++)
            {
                // var temp=$(Sib[i]).find('input').val();
                if ($(Sib[i]).attr('id')=='SubId')
                {
                    var temp=$(Sib[i]).find('select').val();
                }else {
                    var temp=$(Sib[i]).find('input').val();
                }
                if (temp==''){
                    var a=1;
                }
                Arr.push(temp)

            }
            if (a!=1)
            {
                axios.post('{{ route('EditMenu') }}',{
                    '_token':'{{ csrf_token() }}',
                    Arr
                })
                    .then((response)=>{
                        if (response.data=true)
                        {
                            for (var i=0; i< Sib.length;i++)
                            {
                                if ($(Sib[i]).attr('id')=='SubId')
                                {
                                    var temp=$(Sib[i]).find('select').val();
                                }else {
                                    var temp=$(Sib[i]).find('input').val();
                                }
                                $(Sib[i]).text(temp);
                            }
                            $($this).parent().html(Btns);
                            ShowMsg('ذخیره شد.','green');
                        }else{
                            ShowMsg('خطا رخ داد.','red');
                        }
                    })
            }else {
                ShowMsg('لطفا همه مقادیر را وارد کنید.','red');
            }
        }
        function ShowMsg(text,bgcolor) {
            document.getElementById('ShowMsg').children[1].textContent=text;
            document.getElementById('ShowMsg').style.opacity=1;
            document.getElementById('ShowMsg').style.backgroundColor=bgcolor;
            setTimeout(function () {
                document.getElementById('ShowMsg').style.opacity=0;
            },1500)
        }
    </script>
@endsection
