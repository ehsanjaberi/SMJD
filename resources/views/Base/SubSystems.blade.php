@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>زیر سیستم ها</h5>
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
                                <th scope="col" class="text-center" style="width: 60px;">ترتیب</th>
                                <th scope="col" class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($Sub as $menu)
                                <tr>
                                    <th scope="row" class="text-center ID">{{ $menu->id }}</th>
                                    <td class="text-right">
                                        <input type="text" value="{{ $menu->Name }}" class="Name form-control form-control-sm text-left">
                                    </td>
                                    <td class="text-right">
                                        <input type="text" value="{{ $menu->Title }}" class="Title form-control form-control-sm">
                                    </td>
                                    <td class="text-left position-relative">
                                        <input type="text" value="{{ $menu->Icon }}" class="Icon form-control form-control-sm text-left" >
                                        <span class="{{ $menu->Icon }} icon-input"></span>
                                    </td>
                                    <td class="text-center">
                                            <input type="text" value="{{ $menu->Order }}" class="Order form-control form-control-sm text-center">
                                    </td>
                                    <td class="text-center">
                                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                            @if($Per->PermissionId == 87)
                                                <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditLesson" onclick="Store(this)">
                                                    <i class="fa fa-edit text-success"></i>
                                                </a>
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
        $('.Icon').keyup(function () {
            $(this).siblings('span').removeClass();
            $(this).siblings('span').addClass($(this).val());
            $(this).siblings('span').addClass('icon-input');
        });
        function Store($this) {
            let Id=$($this).parent().siblings('.ID').text();
            let Name=$($this).parent().siblings().find('input.Name').val();
            let Title=$($this).parent().siblings().find('input.Title').val();
            let Icon=$($this).parent().siblings().find('input.Icon').val();
            let Order=$($this).parent().siblings().find('input.Order').val();
            console.log(Id);
            axios.post('{{ route('EditSubSystem') }}',{
                '_token':'{{ csrf_token() }}',
                'Id':Id,
                'Name':Name,
                'Title':Title,
                'Icon':Icon,
                'Order':Order,
            }).then((response)=>{
                if (response.data==true){ShowMsg('ذخیره شد.','green')}
                else if(response.data==false){ShowMsg('خطا رخ داد.','red')}
            }).catch((error)=>{
                console.log(error.data)
            })
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
