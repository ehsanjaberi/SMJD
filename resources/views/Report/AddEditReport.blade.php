@extends('layouts.app')
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>افزودن گزارش</h5>
        </section>
        <section class="content-body text-right">
            {{--Query--}}
            <div class="card w-100 m-auto">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">عنوان گزراش</label>
                                @if($Report)
                                    <input type="text" id="ReportId" value="{{ $Report->id }}" hidden>
                                    <input type="text" name="Title" value="{{ $Report->Title }}" id="ReportTitle" class="form-control" placeholder="عنوان گزراش">
                                @else
                                    <input type="text" id="ReportId" hidden>
                                    <input type="text" name="Title" id="ReportTitle" class="form-control" placeholder="عنوان گزراش">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">گروه گزارش</label>
                                <select name="ReportGroupId" id="ReportGroupId" class="form-control">
                                    @if($Report)
                                        @foreach($ReportGroups as $reportgroup)
                                            @if($Report->Group->id==$reportgroup->id)
                                                <option value="{{ $reportgroup->id }}" selected>{{ $reportgroup->Name }}</option>
                                            @else
                                                <option value="{{ $reportgroup->id }}">{{ $reportgroup->Name }}</option>
                                            @endif

                                        @endforeach
                                    @else
                                        @foreach($ReportGroups as $reportgroup)
                                            <option value="{{ $reportgroup->id }}">{{ $reportgroup->Name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0 mt-4 pt-2 d-flex">
                                <div class=" form-check-inline">
                                    <label for="hasPager" class="form-check-label">صفحه بندی دارد؟</label>
                                    @if($Report)
                                        <input type="checkbox" {{ ($Report->HasPager)?'checked':'' }} id="hasPager" value="1" class="form-check-input" name="hasPager">
                                    @else
                                        <input type="checkbox"  id="hasPager" value="1" class="form-check-input" name="hasPager">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row border p-2 bg-white rounded-sm align-items-center shadow-sm">
                        <label for="" class="mb-0">نام جدول</label>
                        <div class="col-md-4">
                            <select name="" id="TableListSearch" class="form-control form-control-sm" onchange="SearchColumn(this,'ColumnListSearch')">
                                @foreach($tables as $tbl)
                                    <option value="{{ $tbl->Tables_in_smjd }}">{{ $tbl->Tables_in_smjd }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="" class="mb-0">نام ستون</label>
                        <div class="col-md-4">
                            <select name="" id="ColumnListSearch" class="form-control form-control-sm">
                            </select>
                        </div>
                    </div>
                    <label for="">کوئری(Query)</label>
                    <div class="row">
                        <textarea name="Where" id="Where" cols="30" rows="5" class="form-control" dir="ltr">@if($Report){{ $Report->Query }}@endif</textarea>
                    </div>
                </div>
                <div class="card-body listHolderInnerJoin">
                    <div class="row">
                        <di class="col-md-12">
                            <a href="#" class="btn btn-primary btn-sm" onclick="addNewColumn()" style="margin-bottom: 2px;padding-bottom: 0"><i class="fa fa-plus"></i> </a>
                            <div class="table-responsive" style="white-space: nowrap">
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-right">عنوان ستون</th>
                                        <th scope="col" class="text-center">جدا کننده</th>
                                        <th scope="col" class="text-center">حاصل جمع</th>
                                        <th scope="col" class="text-center">میانگین</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="columnTbody">
                                    @if($Report)
                                        @foreach($Report->Columns as $column)
                                            <tr>
                                                <td class="Title">
                                                    <input type="text" value="{{ $column->Title }}" class="form-control form-control-sm">
                                                </td>
                                                <td class="Separator text-center">
                                                    <input type="checkbox" {{ ($column->IsSeparator)? 'checked':'' }}>
                                                </td>
                                                <td class="Sum text-center">
                                                    <input type="checkbox" {{ ($column->IsSum)? 'checked':'' }}>
                                                </td>
                                                <td class="Avg text-center">
                                                    <input type="checkbox" {{ ($column->IsAverage)? 'checked':'' }}>
                                                </td>
                                                <td class="text-center">
                                                    <span class="fa fa-trash text-danger delete cursor-pointer" onclick="removeColumn(this)"></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </di>
                    </div>
                    <div class="row">
                        <di class="col-md-12">
                            <a href="#" class="btn btn-primary btn-sm" onclick="addNewParam()" style="margin-bottom: 2px;padding-bottom: 0"><i class="fa fa-plus"></i> </a>
                            <div class="table-responsive" style="white-space: nowrap">
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="text-right">پارامتر جهت نمایش</th>
                                        <th scope="col" class="text-right">پارامتر در کوئری</th>
                                        <th scope="col" class="text-right">نوع کنترل نمایشی</th>
                                        <th scope="col" class="text-right">اولویت</th>
                                        <th scope="col" class="text-right">وضعیت انتخابی/اجباری</th>
                                        <th scope="col" class="text-right">عرض کنترل</th>
                                        <th scope="col" class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="paramTbody">
                                    @if($Report)
                                        @foreach($Report->Parameters as $param)
                                            <tr>
                                                <td class="text-right Title">
                                                    <input type="text" class="form-control form-control-sm" value="{{ $param->Title }}">
                                                </td>
                                                <td class="text-right Name">
                                                    <input type="text" class="form-control text-left form-control-sm" dir="ltr" value="{{ $param->Name }}">
                                                </td>
                                                <td class="text-right type d-flex align-items-center Type">
                                                    <select name="TypeParam" class="form-control form-control-sm" onchange="ParamList(this)">
                                                        <option value="1" {{ ($param->Type==1)?'selected':'' }}>جعبه متنی</option>
                                                        <option value="2" {{ ($param->Type==2)?'selected':'' }}>جعبه متن عددی</option>
                                                        <option value="3" {{ ($param->Type==3)?'selected':'' }}>جعبه تاریخ</option>
                                                        <option value="4" {{ ($param->Type==4)?'selected':'' }}>ساعت</option>
                                                        <option value="5" {{ ($param->Type==5)?'selected':'' }}>چک باکس</option>
                                                        <option value="6" {{ ($param->Type==6)?'selected':'' }}>لیست کشویی ایستا</option>
                                                        <option value="7" {{ ($param->Type==7)?'selected':'' }}>لیست کشویی پویا</option>
                                                    </select>
                                                    <span class="fa fa-plus cursor-pointer mr-1 plusStatic" onclick="setStaticItem(this)" id="ShowModalStatic" data-toggle="modal" data-target="#AddParam"{{ ($param->Type==6||$param->Type==7)?'':'hidden' }}></span>
                                                    <div class="query" hidden>@if($param->Type==6){{ $param->StaticItems }}@else{{ $param->Query }}@endif</div>
                                                </td>
                                                <td class="text-right Priority">
                                                    <input type="number" class="form-control form-control-sm" value="{{ $param->Priority }}">
                                                </td>
                                                <td class="text-right Optional text-center">
                                                    <input type="checkbox" {{ ($param->IsOptional)?'checked':'' }}>
                                                </td>
                                                <td class="text-right Width">
                                                    <input type="number" min="1" max="12" value="{{ $param->Width }}" class="form-control form-control-sm">
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="mx-1 text-decoration-none" onclick="removeParam(this)">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </di>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <div class="loader" hidden id="StoreReport" style="margin: 10px 0px 0px 24px">Loading...</div>
                @if($Report)
                    <button class="btn btn-outline-secondary mr-2">انصراف</button>
                    <button class="btn btn-outline-success mr-2" onclick="GenerateSql('Edit')">ویرایش</button>
                @else
                    <button class="btn btn-outline-secondary mr-2">انصراف</button>
                    <button class="btn btn-outline-primary mr-2" onclick="GenerateSql('Add')">ذخیره</button>
                @endif
            </div>
        </section>
        <small class="custom-message" id="ShowMsg" style="opacity: 0;pointer-events: none">
            <i class="fa fa-exclamation-circle"></i>
            <span>پیغام اینجا نمایش داده می شود.</span>
        </small>
    </div>
    <!--Modal-->
    <div class="modal fade" id="AddCell" tabindex="-1" aria-labelledby="AddCell" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddCellModalLabel">ثبت</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">عنوان ستون</label>
                                <input type="text" class="form-control" placeholder="عنوان ستون">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-0 mt-4 pt-2 d-flex">
                                <div class=" form-check-inline">
                                    <label for="haspages" class="form-check-label">جدا کننده دارد؟</label>
                                    <input type="checkbox" id="hassplit" class="form-check-input" name="aa">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0 mt-4 pt-2 d-flex">
                                <div class=" form-check-inline">
                                    <label for="haspages" class="form-check-label">حاصل جمع دارد؟</label>
                                    <input type="checkbox" id="hassum" class="form-check-input" name="aa">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0 mt-4 pt-2 d-flex">
                                <div class=" form-check-inline">
                                    <label for="haspages" class="form-check-label"> میانگین دارد؟</label>
                                    <input type="checkbox" id="hasavg" class="form-check-input" name="aa">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary">ذخیره</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="AddParam" tabindex="-1" aria-labelledby="AddParam" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="AddParamModalLabel">ثبت</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <a href="#" id="addNewItemStatic" class="float-left fa fa-plus fa-2x text-primary text-decoration-none" onclick="addStaticItem()"></a>
                    <div id="Static">
                        <table>
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>مقدار</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                        <textarea class="form-control" dir="ltr"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary" onclick="storeStaticItem()">ذخیره</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            document.getElementById('TableListSearch').onchange();
        })
        let Query='';
        let AddParamStatus=0;
        let Columns=[];
        let Params=[];
        function SearchColumn($this,Target) {
            let TableName=$($this).val();
            var URL='{{ route('GetColumn',':Code') }}';
            URL=URL.replace(':Code',TableName);
            axios.get(URL)
            .then((response)=>{
                let ColumnList=document.getElementById(Target);
                ColumnList.options.length=0;
                for (let index in response.data)
                {
                    ColumnList.options[ColumnList.options.length]=new Option(response.data[index].Field,response.data[index].Field)
                }
            })
        }
        //SQL
        function GenerateSql(Type) {
            Columns=[];
            Params=[];
            // document.getElementById('StoreReport').removeAttribute('hidden');
            $('#columnTbody').children().each(function (index,tr) {
                var temp={
                    'ColumnName':$(tr).find('.Title').find('input').val(),
                    'Separator':$(tr).find('.Separator').find('input').prop('checked'),
                    'Sum':$(tr).find('.Sum').find('input').prop('checked'),
                    'Avg':$(tr).find('.Avg').find('input').prop('checked'),
                }
                Columns.push(temp);
            })
            $('#paramTbody').children().each(function (index,tr) {
                console.log($(tr).find('.Type').find('.query').text())
                var temp={
                    'Title':$(tr).find('.Title').find('input').val(),
                    'Name':$(tr).find('.Name').find('input').val(),
                    'Priority':$(tr).find('.Priority').find('input').val(),
                    'Type':$(tr).find('.Type').find('select').val(),
                    'IsOptional':$(tr).find('.Optional').find('input').prop('checked'),
                    'Width':$(tr).find('.Width').find('input').val(),
                    'Query':$(tr).find('.Type').find('.query').text(),
                }
                Params.push(temp);
            })
            Query=$("#Where").val();
            if (document.getElementById('ReportTitle').value=='' || Query=='') {
                ShowMsg('لطفا عنوان گزارش و کوئری را وارد کنید.','red');
            }
            else{
                document.getElementById('StoreReport').removeAttribute('hidden');
                axios.post('{{ route('RunQuery') }}',{
                    '_token':'{{ csrf_token() }}',
                    'ReportId':document.getElementById('ReportId').value,
                    'AddOrEdit':Type,
                    'GroupId':document.getElementById('ReportGroupId').value,
                    'Title':document.getElementById('ReportTitle').value,
                    'Query':Query,
                    'HasPager':document.getElementById('hasPager').checked,
                    'Columns':Columns,
                    'Params':Params
                })
                .then((response)=>{
                    console.log(response.data);
                    if (response.data=='True')
                    {
                        document.getElementById('StoreReport').setAttribute('hidden','hidden');
                        window.location.href='{{ route('ReportManagement') }}';
                    }
                    else {
                        ShowMsg(response.data,'red');
                    }
                    // response.data.forEach(function (AA) {
                    //     console.log(AA);
                    // })
                })
                .catch((error)=>{
                    console.log(error);
                })
            }
        }
        let divQuery;
        //AddNewParam
        function addNewParam() {
            var temp=`<tr>
                                    <td class="text-right Title">
                                        <input type="text" class="form-control form-control-sm">
                                    </td>
                                    <td class="text-right Name">
                                        <input type="text" class="form-control text-left form-control-sm" dir="ltr">
                                    </td>
                                    <td class="text-right type d-flex align-items-center Type">
                                        <select name="TypeParam" class="form-control form-control-sm" onchange="ParamList(this)">
                                            <option value="1">جعبه متنی</option>
                                            <option value="2">جعبه متن عددی</option>
                                            <option value="3">جعبه تاریخ</option>
                                            <option value="4">ساعت</option>
                                            <option value="5">چک باکس</option>
                                            <option value="6">لیست کشویی ایستا</option>
                                            <option value="7">لیست کشویی پویا</option>
                                        </select>
                                        <span class="fa fa-plus cursor-pointer mr-1 plusStatic" onclick="setStaticItem(this)" id="ShowModalStatic" data-toggle="modal" data-target="#AddParam" hidden></span>
                                        <div class="query" hidden></div>
                                    </td>
                                    <td class="text-right Priority">
                                        <input type="number" class="form-control form-control-sm">
                                    </td>
                                    <td class="text-right Optional text-center">
                                        <input type="checkbox">
                                    </td>
                                    <td class="text-right Width">
                                        <input type="number" min="1" max="12" class="form-control form-control-sm">
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-1 text-decoration-none" onclick="removeParam(this)">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                            </tr>`;
            $("#paramTbody").append(temp);
        }
        function ParamList($this) {
            let Val=$($this).val();
            if (Val==6 || Val==7) {
                $($this).siblings('.plusStatic').removeAttr('hidden')
            }else{
                $($this).siblings('.plusStatic').attr('hidden','hidden')
            }
        }
        function addStaticItem() {
            let Temp=`<tr>
                            <td class="Value">
                                <input type="text" class="form-control form-control-sm">
                            </td>
                            <td class="Key">
                                <input type="text" class="form-control form-control-sm">
                            </td>
                            <td>
                                <span class="fa fa-trash text-danger delete cursor-pointer"></span>
                            </td>
                        </tr>`
            $('#tbody').append(Temp)
        }
        $('#Static').on('click','.delete',function () {
            $(this).closest('tr').remove();
        })
        function storeStaticItem() {
            //
            let StaticItems=[];
            if(AddParamStatus==0){
                $('#tbody').children().each(function (index,tr) {
                    var temp={
                        'key':$(tr).find('.Key').find('input').val(),
                        'value':$(tr).find('.Value').find('input').val(),
                    }
                    StaticItems.push(temp);
                })
                divQuery[0].innerHTML=JSON.stringify(StaticItems);
            }
            else if(AddParamStatus==1)
            {
                divQuery[0].innerHTML=$("#Static").find('textarea').val();
            }
        }
        function setStaticItem($this) {
            divQuery=$($this).siblings('.query');
            var select=$($this).siblings('select').val();
            (select==6)?AddParamStatus=0:AddParamStatus=1;
            $("#tbody").empty();
            let arr=$($this).siblings('.query').text()
            if (select==6)
            {
                $("#tbody").parent().removeAttr('hidden');
                $("#addNewItemStatic").removeAttr('hidden');
                $("#Static").find('textarea').attr('hidden','hidden');
                if (arr){
                    arr=JSON.parse($($this).siblings('.query').text());
                    arr.forEach(function (tr) {
                        $("#tbody").append(
                            `<tr>
                            <td class="Value">
                                <input type="text" class="form-control form-control-sm" value="${tr.value}">
                            </td>
                            <td class="Key">
                                <input type="text" class="form-control form-control-sm" value="${tr.key}">
                            </td>
                            <td>
                                <span class="fa fa-trash text-danger delete cursor-pointer"></span>
                            </td>
                        </tr>`
                        );
                    })
                }
            }else if (select==7){
                $("#addNewItemStatic").attr('hidden','hidden');
                $("#tbody").parent().attr('hidden','hidden');
                $("#Static").find('textarea').removeAttr('hidden','hidden');
                $("#Static").find('textarea').val(arr);
                console.log(arr);
            }
        }
        function removeParam($this) {
            $($this).closest('tr').remove();
        }
        //AddNewColumn
        function addNewColumn() {
            var temp=`<tr>
                            <td class="Title"><input type="text" class="form-control form-control-sm"></td>
                            <td class="Separator text-center"><input type="checkbox"></td>
                            <td class="Sum text-center"><input type="checkbox"></td>
                            <td class="Avg text-center"><input type="checkbox"></td>
                            <td class="text-center">
                                <span class="fa fa-trash text-danger delete cursor-pointer" onclick="removeColumn(this)"></span>
                            </td>
                       </tr>`;
            $("#columnTbody").append(temp);
        }
        function removeColumn($this) {
            $($this).closest('tr').remove();
        }
        function ShowMsg(text,bgcolor) {
            document.getElementById('ShowMsg').children[1].textContent=text;
            document.getElementById('ShowMsg').style.opacity=1;
            setTimeout(function () {
                document.getElementById('ShowMsg').style.opacity=0;
            },2000)
        }
    </script>
@endsection
