<div class="table-responsive">
    <table class="table table-striped">
        <thead class="bg-light">
        <tr>
            <th scope="col" class="text-center" style="width: 20px;">#</th>
            <th scope="col" class="text-right" style="width: 300px;">نام درس</th>
            <th scope="col" class="text-right">استاد</th>
            <th scope="col" class="text-center">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" value="100" name="LessonList" id="SelectAll">
                    <label class="custom-control-label" for="SelectAll">انتخاب همه</label>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($SemesterLesson as $lesson)
            <tr>
                <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                <td class="text-right">{{ $lesson['LessonName'] }}</td>
                <td class="text-right">{{ $lesson['Teacher'] }}</td>
                <td class="text-center">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" value="{{ $lesson['SemesterLessonId'].'|'.$lesson['SemesterLessonTeacherId'] }}" name="LessonList" id="Lesson{{ $loop->index+1 }}">
                        <label class="custom-control-label" for="Lesson{{ $loop->index+1 }}"></label>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
