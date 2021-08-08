<table class="table text-right">
    <thead class="thead-light">
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
    </tr>
    </thead>
    <tbody>
    {{ $Table }}
{{--        @foreach($Table as $t)--}}
            <tr>
                <th scope="row">1</th>
                <td>ehsan</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
{{--        @endforeach--}}
    </tbody>
</table>
