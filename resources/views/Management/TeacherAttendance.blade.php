@extends('layouts.app')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('Plugin/Schedule/dist/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('Plugin/TreeSelect/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Plugin/DataTimePicker/css/jquery.md.bootstrap.datetimepicker.style.css') }}" />
@endsection
@section('content')
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>حضور غیاب اساتید</h5>
        </section>
        <section class="content-body">
            <div class="row text-right mb-3">
                <div class="col-md-6">
                    <select name="UniversityId" id="UniversityId" class="form-control" onchange="CollegeSearch(this)">
                        @foreach($University as $uni)
                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="loader" hidden id="CircleLoader" style="bottom: 10px;margin: 0;left: 21px;">Loading...</div>
                    <select name="CollegeId" id="CollegeId" class="form-control">
                    </select>
                </div>
            </div>
            <div class="row text-right mb-4">
                <div class="col-md-5">
                    <select name="SemesterId" id="SemesterId" class="form-control" onchange="SemesterLessonSearch(this)">

                    </select>
                </div>
                <div class="col-md-5">
                    <div class="loader" hidden id="SemesterLessonLoader" style="bottom: 10px;margin: 0;left: 21px;">Loading...</div>
                    <div class="input-group" dir="ltr">
                        <div class="input-group-prepend">
                        <span class="input-group-text cursor-pointer" id="date1">
                            <i class="fa fa-calendar"></i>
                        </span>
                        </div>
                        <input type="text" name="date" id="date" class="form-control text-right" placeholder="تاریخ"
                               aria-label="date1" aria-describedby="date1">
                    </div>
                </div>
                <div class="col-md-2 mt-auto d-flex justify-content-between">
                    <button class="btn btn-primary" onclick="GetTeacher()">نمایش</button>
                    <div class="loader" hidden id="ShowLessonLoader" style="bottom: 10px;margin: 0;right: -8px;font-size: 16px;">Loading...</div>
                </div>
            </div>
            <hr>
            <div id="schedule" dir="ltr"></div>
        </section>
        <small class="custom-message" id="ShowMsg" style="opacity: 0;pointer-events: none">
            <i class="fa fa-exclamation-circle"></i>
            <span>پیغام اینجا نمایش داده می شود.</span>
        </small>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js" type="text/javascript" language="javascript"></script>
    <script type="text/javascript" src="{{ asset('Plugin/Schedule/dist/js/jq.schedule.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Plugin/DataTimePicker/js/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#date1').MdPersianDateTimePicker({
                targetTextSelector: '#date',
                enableTimePicker: false
            });
            document.getElementById('UniversityId').onchange();
            var $sc = $("#schedule").timeSchedule({
                startTime: "07:30", // schedule start time(HH:ii)
                endTime: "20:00",   // schedule end time(HH:ii)
                widthTime: 60 * 10,  // cell timestamp example 10 minutes
                timeLineY: 50,       // height(px)
                verticalScrollbar: 20,   // scrollbar (px)
                timeLineBorder: 2,   // border(top and bottom)
                bundleMoveWidth: 6,  // width to move all schedules to the right of the clicked time line cell
                draggable: false,
                resizable: false,
                resizableLeft: false,
                onChange: function(node, data){
                    // addLog('onChange', data);
                    // console.log(data)
                },
                onInitRow: function(node, data){
                    // addLog('onInitRow', data);
                    // console.log(data)
                },
                onClick: function(node, data){
                    axios.post('{{ route('TeacherAttendanceStore') }}',{
                        '_token':'{{csrf_token()}}',
                        'data':data,
                        'HoldingDate':document.getElementById('date').value
                    })
                    .then((response)=>{
                        console.log(response.data);
                        if (node.hasClass('bg-success')) {
                            node.removeClass('bg-success')
                            node.addClass('bg-secondary')
                        }else{
                            node.addClass('bg-success')
                        }
                    })
                },
                onAppendRow: function(node, data){
                    // addLog('onAppendRow', data);
                },
                onAppendSchedule: function(node, data){
                    if(data.data.Status==1)
                    {
                        node.addClass('bg-success');
                    }
                    else{
                        node.addClass('bg-secondary');
                    }
                    // console.log('onAppendSchedule', data.data.Week);
                    // if(data.data.class){
                    //     node.addClass(data.data.class);
                    // }
                    // if(data.data.image){
                    //     var $img = $('<div class="photo"><img></div>');
                    //     $img.find('img').attr('src', data.data.image);
                    //     node.prepend($img);
                    //     node.addClass('sc_bar_photo');
                    // }
                },
                onScheduleClick: function(node, time, timeline){

                    // addLog('onScheduleClick', time + ' ' + timeline);
                },
            });

        })
        function CollegeSearch($this) {
            let UniversityId=$($this).val();
            if (UniversityId !== '')
            {
                document.getElementById('CircleLoader').removeAttribute('hidden');
                var URL='{{ route('GetCollegeInformationSemesterLesson',':Code') }}';
                URL=URL.replace(':Code',UniversityId);
                axios.get(URL)
                    .then(function (response) {
                        let CollegeList=document.getElementById('CollegeId');
                        let SemesterList=document.getElementById('SemesterId');
                        CollegeList.options.length=0;
                        SemesterList.options.length=0;
                        document.getElementById('CircleLoader').setAttribute('hidden','hidden');
                        CollegeList.options[CollegeList.options.length]=new Option('انتخاب دانشکده','');
                        SemesterList.options[SemesterList.options.length]=new Option('انتخاب نیمسال','');
                        for (let index in response.data.College)
                        {
                            CollegeList.options[CollegeList.options.length]=new Option(response.data.College[index].Name,response.data.College[index].id)
                        }
                        for (let index in response.data.Semester)
                        {
                            SemesterList.options[SemesterList.options.length]=new Option(response.data.Semester[index].Name,response.data.Semester[index].id)
                        }
                    })
            }
            else {
                document.getElementById('CollegeId').options.length=0;
                document.getElementById('SemesterId').options.length=0;
            }
        }
        function SemesterLessonSearch($this) {
            let SemesterId=$($this).val();
            if (SemesterId !== '') {
                // document.getElementById('SemesterLessonLoader').removeAttribute('hidden');
                {{--axios.post('{{ route('TeacherAttendanceGetLesson') }}',{--}}
                {{--    '_token':'{{ csrf_token() }}',--}}
                {{--    'SemesterId':SemesterId,--}}
                {{--    'CollegeId':document.getElementById('CollegeId').value,--}}
                {{--})--}}
                {{--    .then(function (response) {--}}
                {{--        console.log(response.data);--}}
                {{--        document.getElementById('SemesterLessonLoader').setAttribute('hidden','hidden');--}}
                {{--        let SemesterLessonList=document.getElementById('SemesterLessonList');--}}
                {{--        SemesterLessonList.options.length=0;--}}
                {{--        SemesterLessonList.options[SemesterLessonList.options.length]=new Option('انتخاب درس','');--}}
                {{--        // response.data.forEach(function(Lesson) {--}}
                {{--            // SemesterLessonList.options[SemesterLessonList.options.length]=new Option(Lesson.LessonName+'('+Lesson.TeacherName+')',Lesson.ScheduleId)--}}
                {{--        // });--}}
                {{--    })--}}
            }
        }
        function GetTeacher() {
            var CollegeId=document.getElementById('CollegeId').value;
            var SemesterId=document.getElementById('SemesterId').value;
            if(CollegeId!='' && SemesterId!='') {
                document.getElementById('ShowLessonLoader').removeAttribute('hidden');
                axios.post('{{ route('TeacherAttendanceGetLesson') }}', {
                    '_token': '{{ csrf_token() }}',
                    'CollegeId': CollegeId,
                    'SemesterId': SemesterId,
                    'date': document.getElementById('date').value,
                })
                    .then(function (response) {
                        let HoldingDate = response.data;
                        console.log(response.data);
                        document.getElementById('ShowLessonLoader').setAttribute('hidden', 'hidden');
                        $("#schedule").timeSchedule('setRows', response.data.class);
                    })
            }else{
                ShowMsg('لطفا دانشکده و نیمسال را انتخاب کنید.','red')
            }
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
