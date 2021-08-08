@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/ReportPrint.css') }}">
@endsection
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5> {{ $Report->Title }}</h5>
        </section>
        <section class="content-body">
           <div id="card" class="card">
               <div class="card-header" id="card-inf">
                   <form action="{{ route('ReportResult') }}" method="post" id="ReportResultForm">
                       @csrf
                       <input type="text" name="ReportId" value="{{ $Report->id }}" hidden>
                       <p class="text-right">لیست ستونهایی که مایل هستید در گزارش نمایش داده شوند</p>
                       <ul class="list-unstyled d-flex justify-content-start">
                           @foreach($Report->Columns as $column)
                            <li class="mx-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Columns[]" value="{{ $column->id }}" class="custom-control-input" id="{{ $column->id }}" checked>
                                    <label class="custom-control-label" for="{{ $column->id }}">{{ $column->Title }}</label>
                                </div>
                            </li>
                           @endforeach
                       </ul>
                       <hr>
                       <div class="row">
                           @foreach($Report->Parameters as $param)
                               <div class="col-sm-{{ $param->Width }}">
                                   <div class="form-group text-right">
                                       <label for="">{{ $param->Title }}</label>
                                       @switch($param->Type)
                                           @case(1)
                                                <input type="text" name="Params[]" id="{{$param->Name}}" class="form-control">
                                                @break
                                           @case(2)
                                                <input type="number" name="Params[]" id="{{$param->Name}}" class="form-control">
                                                @break
                                           @case(3)
                                                <input type="date" name="Params[]" id="{{$param->Name}}" class="form-control">
                                                @break
                                           @case(4)
                                               <input type="time" name="Params[]" id="{{$param->Name}}" class="form-control">
                                               @break
                                           @case(5)
                                               <input type="checkbox" name="Params[]" id="{{$param->Name}}" class="form-control">
                                               @break
                                           @case(6)
                                           <select name="Params[]" id="{{$param->Name}}" class="form-control">
                                               @foreach($param->StaticItems as $item)
                                                    <option value="{{ $item->key }}">{{ $item->value }}</option>
                                               @endforeach
                                           </select>
                                               @break
                                           @case(7)
                                               <select name="Params[]" id="{{$param->Name}}" class="form-control">
                                                   @foreach($param->Query as $item)
                                                       <option value="{{ $item->key }}">{{ $item->value }}</option>
                                                   @endforeach
                                               </select>
                                           @break
                                       @endswitch
                                   </div>
                               </div>
                           @endforeach
                       </div>
                       <div class="row justify-content-end">
                       <button type="button" class="btn btn-outline-secondary mx-2" onclick="window.print()">پرینت</button>
                       <button type="submit" class="btn btn-outline-primary">اجرا</button>
                       <div class="loader" id="ShowReport" hidden style="margin: 10px 0 0 16px">Loading...</div>
                   </div>
                   </form>
               </div>
               <div class="card-body">
                   <table class="table text-right table-bordered">
                       <thead class="thead-light" id="THead">

                       </thead>
                       <tbody id="TBody">

                       </tbody>
                   </table>

               </div>
           </div>
        </section>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        document.getElementById('ReportResultForm').addEventListener('submit',(event)=>{
            event.preventDefault();
            document.getElementById('ShowReport').removeAttribute('hidden')
            let arr=[];
            document.getElementsByName('Params[]').forEach(function (param) {
                var temp={
                    'Name': $(param).attr('id'),
                    'Value': $(param).val(),
                }
                arr.push(temp)
            })
            let Form=new FormData(document.getElementById('ReportResultForm'));
            Form.append('Param',JSON.stringify(arr));
            axios.post(document.getElementById('ReportResultForm').action,Form)
                .then((response)=> {
                    if (response.data.Status=='True')
                    {
                        console.log(response.data)
                        document.getElementById('ShowReport').setAttribute('hidden','hidden')
                        var temp='<tr><th scope="col">#</th>';
                        (response.data.Head).forEach(function (head) {
                            temp+='<th scope="col">'+head.Title+'</th>';
                        })
                        temp+='</tr>';
                        $("#THead").html(temp);
                        let html='';
                        let tempbody='';
                        (response.data.Rows).forEach(function (dt,index) {
                            tempbody='<tr><th scope="row">'+(index+1)+'</th>';
                            (response.data.Head).forEach(function (head) {
                                if (dt[head.Title]!=null)
                                {
                                    tempbody+='<td>'+dt[head.Title]+'</td>';
                                }else {
                                    tempbody+='<td></td>';
                                }

                            })
                            tempbody+='</tr>';
                            html+=tempbody;
                        })
                        $("#TBody").html(html);
                    }else{
                        document.getElementById('ShowReport').setAttribute('hidden','hidden')
                        alert(response.data);
                    }
                })
                .catch((error)=> {
                console.log(error.message);
            })
        })
    </script>
@endsection
