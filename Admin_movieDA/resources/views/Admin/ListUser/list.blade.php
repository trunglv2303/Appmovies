@extends('admin.main')
@section('content')
<div class="container">
    <h1>Danh sách người dùng</h1>
    @include('alert')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Password</th>
                <th>Email</th>
                <th>Quyền Hạn</th>
                <th>Thao Tác</th>

        </thead>
        <tr>
            @foreach($listusers as $listuser)
            <th>{{ $listuser['id']}}</th>
            <th>{{ $listuser['password']}}</th>
            <th>{{ $listuser['power']}}</th>
            <th>{{$listuser['email'] }}</th>
            <th>
                <a class="btn btn-danger btn-sm" href="/user/delete/{{ $listuser['id']}}">
                    <i class="fas fa-trash"></i> Xóa
                </a>
            </th>
        </tr>
        @endforeach
    </table>
</div>
@endsection