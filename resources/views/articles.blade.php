@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table>
            <caption>文章列表</caption>
            <th>编号</th>
            <th>标题</th>
            <th>内容</th>
            <th>作者</th>
            <th>创建时间</th>
            <th>修改时间</th>
            @foreach($data as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->title}}</td>
                <td>{{$row->body}}</td>
                <td>{{$row->user_id}}</td>
                <td>{{$row->created_at}}</td>
                <td>{{$row->updated_at}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
