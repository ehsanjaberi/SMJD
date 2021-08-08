@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>مقاطع تحصیلی</h5>
        </section>
        <section class="content-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                            @if($Per->PermissionId == 48)
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 30px;">#</th>
                                        <th scope="col" class="text-right">کد</th>
                                        <th scope="col" class="text-right">عنوان</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Degree as $degree)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                            <td class="text-right">{{ $degree->Code }}</td>
                                            <td class="text-right">{{ $degree->Name }}</td>
                                            <td class="text-center">
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 50)
                                                        <a href="#" class="mx-1 text-decoration-none" onclick="EditDegree({{ $degree->id }},{{ $degree->Code }},'{{ $degree->Name }}')">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach(\Illuminate\Support\Facades\Auth::user()->UserRole->Role->RolePermission as $Per)
                                                    @if($Per->PermissionId == 49)
                                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteDegree" onclick="DeleteDegree({{ $degree->id }})">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center" dir="ltr">
                                    {{ $Degree->render() }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-right" id="card-header">
                            افزودن مقطع
                        </div>
                        <form action="{{ route('AddDegree') }}" method="post" id="DegreeForm">
                            @csrf
                            <div class="card-body text-right">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">کد مقطع</label>
                                            <input type="text" id="OldCode" hidden>
                                            <input type="text" name="Code" id="Code" class="form-control" placeholder="کد مقطع">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">نام مقطع</label>
                                            <input type="text" name="Name" id="Name" class="form-control" placeholder="نام مقطع">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger" id="BtnCancelDegreeForm" hidden onclick="CancelEditDegree()">انصراف</button>
                                <button type="submit" class="btn btn-primary" id="BtnDegreeForm">افزودن</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="DeleteDegree" tabindex="-1" aria-labelledby="DeleteDegree" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteDegreeTitle">حذف مقطع تحصیلی</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این مقطع تحصیلی را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeleteDegree') }}" method="post">
                        @csrf
                        <input type="text" name="Code" id="DeleteCode" hidden>
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
        function EditDegree(Id,Code,Name) {
            document.getElementById('card-header').textContent='ویرایش مقطع تحصیلی';
            document.getElementById('DegreeForm').action='{{ route('EditDegree') }}';
            document.getElementById('BtnCancelDegreeForm').removeAttribute('hidden');
            //Do Check
            let BtnSubmit = document.getElementById('BtnDegreeForm');
            let IdInput = document.getElementById('OldCode');
            IdInput.setAttribute('name','OldCode');
            BtnSubmit.textContent='ویرایش';
            BtnSubmit.className='btn btn-success';
            document.getElementById('Name').value=Name;
            document.getElementById('Code').value=Code;
            IdInput.value=Id;
        }
        function CancelEditDegree() {
            document.getElementById('card-header').textContent='افزودن مقطع تحصیلی';
            document.getElementById('DegreeForm').action='{{ route('AddDegree') }}';
            document.getElementById('BtnCancelDegreeForm').setAttribute('hidden','hidden');
            document.getElementById('Name').value=null;
            document.getElementById('Code').value=null;
            document.getElementById('OldCode').removeAttribute('name');
            let Btn = document.getElementById('BtnDegreeForm');
            Btn.textContent='افزودن';
            Btn.className='btn btn-primary';
        }
        function DeleteDegree(Code) {
            document.getElementById('DeleteCode').value=Code;
        }

        $("#DegreeForm").validate({
            rules: {
                Code: {
                    required: true,
                },
                Name: {
                    required: true,
                },
            },
        });
    </script>
@endsection
