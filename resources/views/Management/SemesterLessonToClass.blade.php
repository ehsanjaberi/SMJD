@extends('layouts.app')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('Plugin/Schedule/dist/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('Plugin/TreeSelect/style.css') }}">
@endsection
@section('content')
    <!--Main-Content-->
    <div class="main-content p-3">
        <section class="content-header p-2 text-right d-flex justify-content-between">
            <h5>زمانبندی روزانه کلاس</h5>
        </section>
        <section class="content-body">
            <form action="{{ route('GetSemesterLessonToClassInformation') }}" method="post" id="GetClassInf">
                @csrf
                <div class="form-inline">
                    <label for="UniversityId" class="sr-only">دانشگاه</label>
                    <select name="UniversityId" id="UniversityId" class="custom-select mb-2 mr-sm-2" onchange="CollegeSearch(this)" style="width: 48%;">
                        @foreach($University as $uni)
                            <option value="{{ $uni->id }}">{{ $uni->Name }}</option>
                        @endforeach
                    </select>
                    <div class="position-relative" style="width: 48%;">
                        <div class="loader" hidden id="CircleLoader" style="top: 11px;margin: 0 8px;left: 0px;">Loading...</div>
                        <label for="CollegeId" class="sr-only">دانشکده</label>
                        <select name="CollegeId" id="CollegeId" class="custom-select mb-2 mr-sm-2 w-100">
                        </select>
                    </div>
                    <label for="SemesterId" class="sr-only">نیمسال</label>
                    <select name="SemesterId" id="SemesterId" style="width: 24%;" class="custom-select mb-2 mr-sm-2">
                    </select>
                    <label for="WeekId" class="sr-only">هفته</label>
                    <select name="WeekId" id="WeekId" class="custom-select mb-2 mr-sm-2" style="width: 20%;">
                        <option value="0">هرهفته</option>
                        <option value="1">هفته زوج</option>
                        <option value="2">هفته فرد</option>
                    </select>
                    <label for="DayId" class="sr-only">روز</label>
                    <select name="DayId" id="DayId" class="custom-select mb-2 mr-sm-2" style="width: 20%;">
                        <option value="0">شنبه</option>
                        <option value="1">یک شنبه</option>
                        <option value="2">دوشنبه</option>
                        <option value="3">سه شنبه</option>
                        <option value="4">چهارشنبه</option>
                        <option value="5">پنج شنبه</option>
                        <option value="6">جمعه</option>
                    </select>
                    <div class="" style="width: 31.2%;">
                        <button type="submit" class="btn btn-primary mb-2 mr-sm-2 position-relative"  style="width: 45%;">
                            <div class="loader" hidden id="ShowCircleLoader" style="color:white;top: 10px;margin: 0 8px;left: 0">Loading...</div>
                            نمایش</button>
{{--                        <button type="button" class="btn btn-warning text-white mb-2 mr-sm-2 position-relative" style="width: 45%;" onclick="StorePlan()">--}}
{{--                            <div class="loader" hidden id="StoreCircleLoader" style="color:white;top: 10px;margin: 0 8px;left: 0">Loading...</div>--}}
{{--                            ذخیره--}}
{{--                        </button>--}}
                    </div>
                </div>
            </form>
            <hr>
        </section>
        <small class="custom-message" id="ShowMsg" style="opacity: 0;pointer-events: none">
            <i class="fa fa-exclamation-circle"></i>
            <span>پیغام اینجا نمایش داده می شود.</span>
        </small>
    </div>
    <div class="modal fade" id="ShowSchedule" tabindex="-1" aria-labelledby="ShowSchedule" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-success text-white">
                    <h5 class="modal-title" id="EditStudentTitle">نمایش زمانبندی</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <div id="schedule" dir="ltr"></div>
                </div>
                <div class="modal-footer">
                    <b class="ml-auto">توجه داشته باشید که برنامه تعیین شده توسط دیگران را نمی توانید ویرایش کنید.</b>
                    <a class="btn zoom"><i class="fa fa-search-plus"></i></a>
                    <a class="btn zoom-out"><i class="fa fa-search-minus"></i></a>
                    <a class="btn zoom-init"><i class="fa fa-recycle"></i></a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-warning text-white position-relative" onclick="StorePlan()">
                        <div class="loader" hidden id="StoreCircleLoader" style="color:white;top: 10px;margin: 0 8px;left: 0">Loading...</div>
                        ذخیره
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="AddClass" tabindex="-1" aria-labelledby="AddClass" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">انتخاب درس</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <div class="row">
                        <div class="col-md-12">
                            <label>انتخاب درس</label>
                            <input type="text" id="SelectSemesterLesson" class="form-control" placeholder="جستجو" autocomplete="off"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" id="SubmitClass" class="btn btn-primary">ذخیره</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Edit_DeleteClass" tabindex="-1" aria-labelledby="Edit_DeleteClass" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pl-0 bg-primary text-white">
                    <h5 class="modal-title">ویرایش و حذف درس</h5>
                    <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <div class="row">
                        <div class="col-md-12">
                            <label>انتخاب درس</label>
                            <input type="text" id="EditSelectSemesterLesson" class="form-control" placeholder="جستجو" autocomplete="off"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">انصراف</button>
                    <button type="button" id="SubmitDeleteClass" class="btn btn-danger">حذف</button>
                    <button type="button" id="SubmitEditClass" class="btn btn-success">ویرایش</button>
                </div>
            </div>
        </div>
    </div>
{{--    ui-draggable-disabled ui-state-disabled--}}
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js" type="text/javascript" language="javascript"></script>
    <script type="text/javascript" src="{{ asset('Plugin/Schedule/dist/js/jq.schedule.min.js') }}"></script>
    <script src="{{ asset('Plugin/TreeSelect/comboTreePlugin.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        let Status=[];
        $(function(){
            var zoom = 1;

            $('.zoom').on('click', function(){
                zoom += 0.1;
                $('.jq-schedule').css('zoom', zoom);
            });
            $('.zoom-init').on('click', function(){
                zoom = 1;
                $('.jq-schedule').css('zoom', zoom);
            });
            $('.zoom-out').on('click', function(){
                zoom -= 0.1;
                $('.jq-schedule').css('zoom', zoom);
            });
            document.getElementById('UniversityId').onchange();
            let NewNode={};
            let TimeLineId,LCode;
            var SampleJSONData = [];
            let comboTree2 = $('#SelectSemesterLesson').comboTree({
                source : SampleJSONData,
                isMultiple: false
            });
            let comboTree3 = $('#EditSelectSemesterLesson').comboTree({
                source : SampleJSONData,
                isMultiple: false
            });

            var $sc = $("#schedule").timeSchedule({
                startTime: "07:30", // schedule start time(HH:ii)
                endTime: "20:00",   // schedule end time(HH:ii)
                widthTime: 60 * 10,  // cell timestamp example 10 minutes
                timeLineY: 50,       // height(px)
                verticalScrollbar: 20,   // scrollbar (px)
                timeLineBorder: 2,   // border(top and bottom)
                bundleMoveWidth: 6,  // width to move all schedules to the right of the clicked time line cell
                draggable: true,
                resizable: true,
                resizableLeft: true,
                onChange: function(node, data){
                    // addLog('onChange', data);
                    // console.log(data)
                },
                onInitRow: function(node, data){
                    // addLog('onInitRow', data);
                    // console.log(data)
                },
                onClick: function(node, data){
                    console.log('2')
                    $('#Edit_DeleteClass').modal('show')
                    NewNode['TimeLineId']=data.timeline;
                    TimeLineId=data.timeline;
                    NewNode['SemesterLessonId']=data.data.SemesterLessonId;
                    NewNode['TeacherId']=data.data.TeacherId;
                    LCode=data.data.LessonCode;
                    var Lesson = comboTree3.options.source;
                    NewNode['StartTime']=data.start;
                    NewNode['EndTime']=data.end;
                    comboTree3.clearSelection();
                    for (var i=0;i<Lesson.length;i++)
                    {
                        if (NewNode.SemesterLessonId == Lesson[i].SemesterLessonId && NewNode.TeacherId == Lesson[i].TeacherId)
                        {
                            comboTree3.setSelection([Lesson[i].id])
                        }
                    }

                },
                onAppendRow: function(node, data){
                    // addLog('onAppendRow', data);
                },
                onAppendSchedule: function(node, data){
                    let WeekId=document.getElementById('WeekId').value;
                    if (WeekId != 0)
                    {
                        if (data.data.Week == 0)
                        {
                            node.addClass('ui-draggable-disabled ui-state-disabled');
                            console.log($(node).children());
                        }
                        // document.getElementById()
                        // console.log(data.data.ScheduleId)
                        // $(node).attr('id','sc-bar' + data.data.ScheduleId);
                        // console.log($(node).draggable('disable'))
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
                    $('#AddClass').modal('show')
                    NewNode['this'] = this;
                    NewNode['time'] = time;
                    NewNode['timeline'] = timeline;
                    // addLog('onScheduleClick', time + ' ' + timeline);
                },
            });
            //Add-TimeLine-Schedule
            document.getElementById('SubmitClass').addEventListener('click',function (event) {
                event.preventDefault();
                var start = NewNode.time;
                var end = $(this).timeSchedule('formatTime', $(this).timeSchedule('calcStringTime', NewNode.time) + 3600);
                $(NewNode.this).timeSchedule('addSchedule', NewNode.timeline, {
                    start: start,
                    end: end,
                    text:document.getElementById('SelectSemesterLesson').value,
                    data:{
                        SemesterLessonId:comboTree2.getSelectedNames().data.SemesterLessonId,
                        ClassId:NewNode.timeline,
                        TeacherId:comboTree2.getSelectedNames().data.TeacherId,
                        ScheduleId:0,
                    }
                });
                $('#AddClass').modal('hide')
            })
            //Delete-TimeLine-Schedule
            var Delete=[];
            document.getElementById('SubmitDeleteClass').addEventListener('click',function (event) {
                event.preventDefault();
                let TimeLineData=$sc.timeSchedule('timelineData');
                var a;
                for (let j=0 ; j < TimeLineData[NewNode.TimeLineId].schedule.length ; j++)
                {
                    if (NewNode.StartTime == TimeLineData[NewNode.TimeLineId].schedule[j].start && NewNode.EndTime == TimeLineData[NewNode.TimeLineId].schedule[j].end)
                    {
                        a=TimeLineData[NewNode.TimeLineId].schedule.splice(j,1);
                    }

                }
                 Delete ={
                     ScheduleId:a[0].data.ScheduleId
                }
                Status.push(Delete)
                console.log(Status);
                $sc.timeSchedule('setRows', TimeLineData);
                $('#Edit_DeleteClass').modal('hide')
            })
            //Edit-TimeLine-Schedule
            document.getElementById('SubmitEditClass').addEventListener('click',function (event) {
                event.preventDefault()
                let TimeLineData=$sc.timeSchedule('timelineData');
                for (let j=0 ; j < TimeLineData[NewNode.TimeLineId].schedule.length ; j++)
                {
                    if (NewNode.StartTime == TimeLineData[NewNode.TimeLineId].schedule[j].start && NewNode.EndTime == TimeLineData[NewNode.TimeLineId].schedule[j].end)
                    {
                        if (TimeLineData[NewNode.TimeLineId].schedule[j].text != comboTree3.getSelectedNames().title)
                        {
                            TimeLineData[NewNode.TimeLineId].schedule[j].data.SemesterLessonId=comboTree3.getSelectedNames().data.SemesterLessonId;
                            TimeLineData[NewNode.TimeLineId].schedule[j].data.TeacherId=comboTree3.getSelectedNames().data.TeacherId;
                            TimeLineData[NewNode.TimeLineId].schedule[j].text=comboTree3.getSelectedNames().title;
                        }
                    }

                }
                $sc.timeSchedule('setRows', TimeLineData);
                $('#Edit_DeleteClass').modal('hide');
            })

            document.getElementById('GetClassInf').addEventListener('submit',function (event) {
                event.preventDefault();
                let Form=new FormData(this);
                if (Form.get('CollegeId')!='' && Form.get('SemesterId')!='')
                {
                    $('#ShowSchedule').modal('show');
                    document.getElementById('ShowCircleLoader').removeAttribute('hidden');
                    axios.post(this.action,Form)
                        .then((response)=>{
                            $("#schedule").timeSchedule('setRows',response.data.class);
                            comboTree2.setSource(response.data.SemesterLesson);
                            comboTree3.setSource(response.data.SemesterLesson);
                            document.getElementById('ShowCircleLoader').setAttribute('hidden','hidden');
                        })
                        .catch((error)=>{
                            console.log(error.data);
                        })
                }
                else{
                    ShowMsg('لطفا دانشکده و نیمسال را انتخاب کنید.','red')
                }
            })
        });
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
        function StorePlan() {
            document.getElementById('StoreCircleLoader').removeAttribute('hidden');
            let Form=new FormData(document.getElementById('GetClassInf'));
            axios.post('{{ route('AddSemesterLessonToClass') }}',{
                CollegeId:Form.get('CollegeId'),
                SemesterId:Form.get('SemesterId'),
                WeekId:Form.get('WeekId'),
                DayId:Form.get('DayId'),
                TimeLine:$("#schedule").timeSchedule('timelineData'),
                DeletedItems:Status,
            })
            .then((response)=>{
                console.log(response.data);
                $('#ShowSchedule').modal('hide');
                Status=[];
                // $("#schedule").timeSchedule('setRows',response.data.class);
                document.getElementById('StoreCircleLoader').setAttribute('hidden','hidden');
            })
            .catch((error)=>{
                console.log(error.data)
            })
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
