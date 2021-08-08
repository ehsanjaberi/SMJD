@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>سمت ها</h5>
            <a href="#" data-toggle="modal" data-target="#AddLesson" class="btn btn-info">
                افزودن سمت
            </a>
        </section>
        <section class="content-body">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 20px;">#</th>
                                <th scope="col" class="text-right">کد</th>
                                <th scope="col" class="text-right">نام</th>
                                <th scope="col" class="text-right">دانشگاه</th>
                                <th scope="col" class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($Post as $post)
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                    <td class="UniId text-right" hidden>{{ $post->UniversityId }}</td>
                                    <td class="Code text-right">{{ $post->Code }}</td>
                                    <td class="Name text-right">{{ $post->Name }}</td>
                                    <td class="text-right">{{ $post->University->Name }}</td>
                                    <td class="text-center">
                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#EditLesson" onclick="EditPost({{ $post->id }},this)">
                                            <i class="fa fa-edit text-success"></i>
                                        </a>
                                        <a href="#" class="mx-1 text-decoration-none" data-toggle="modal" data-target="#DeleteLesson" onclick="DeletePost({{ $post->id }})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="bg-light text-center font-weight-bold">سطری یافت نشد.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center" dir="ltr">
                            {{ $Post->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddLesson" tabindex="-1" aria-labelledby="AddLesson" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="َAddSemesterTitle">افزودن سمت</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('AddPost') }}" method="post" id="AddPostForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">دانشگاه</label>
                                        <select name="UniversityId" id="UniversityId" class="form-control">
                                            <option value="def">انتخاب دانشگاه</option>
                                            @foreach($University as $uni)
                                                <option value="{{ $uni->id }}">{{ $uni->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد سمت</label>
                                    <input type="text" name="Code" id="Code" class="form-control" placeholder="کد سمت">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام سمت</label>
                                    <input type="text" name="Name" id="Name" class="form-control" placeholder="نام سمت">
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
    <div class="modal fade" id="EditLesson" tabindex="-1" aria-labelledby="EditLesson" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditSemesterTitle">ویرایش سمت</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('EditPost') }}" method="post" id="EditPostForm">
                    @csrf
                    <div class="modal-body text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">دانشگاه</label>
                                        <input type="text" name="Id" id="OldId" hidden>
                                        <select name="UniversityId" id="edit_UniversityId" class="form-control">
                                            <option value="def">انتخاب دانشگاه</option>
                                            @foreach($University as $uni)
                                                <option value="{{ $uni->id }}">{{ $uni->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">کد سمت</label>
                                    <input type="text" name="Code" id="edit_Code" class="form-control" placeholder="کد سمت">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام سمت</label>
                                    <input type="text" name="Name" id="edit_Name" class="form-control" placeholder="نام سمت">
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
    <div class="modal fade" id="DeleteLesson" tabindex="-1" aria-labelledby="DeleteLesson" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-danger text-white">
                    <h5 class="modal-title" id="DeleteLessonTitle">حذف سمت</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <span>آیا می خواهید این سمت را حذف کنید؟</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('DeletePost') }}" method="post">
                        @csrf
                        <input type="text" id="DeleteCode" name="Code" hidden>
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
        function EditPost(Id,$this) {
            document.getElementById('OldId').value=Id;
            document.getElementById('edit_UniversityId').value=$($this).parent().siblings('.UniId').text();
            document.getElementById('edit_Code').value=$($this).parent().siblings('.Code').text();
            document.getElementById('edit_Name').value=$($this).parent().siblings('.Name').text();
        }
        function DeletePost(Id) {
            document.getElementById('DeleteCode').value=Id;
        }
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "تکمیل این فیلد اجباری است.");
        $("#AddPostForm").validate({
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
                }
            },
        });
        $("#EditPostForm").validate({
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
                }
            },
        });
    </script>
@endsection
