@extends('admin.main')
@section('content')
<div class="container">
    <h1>Danh sách bình luận</h1>
    @include('alert')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Bình Luận</th>
                <th>Tài khoản người dùng </th>
                <th>ID phim</th>

                <th>Nội dung bình luận </th>
                <th>Thao Tác</th>
        </thead>
        <tr>
            @foreach($listuserscomments as $listuserscomment)
            <th>{{ $listuserscomment['id']}}</th>
            <th>{{$listuserscomment['userName'] }}</th>
            <th>{{$listuserscomment['movieID'] }}</th>

            <th>{{$listuserscomment['comments'] }}</th>

            <th>
                <a class="btn btn-danger btn-sm" href="/comment/delete/{{ $listuserscomment['id']}}">
                    <i class="fas fa-trash"></i> Xóa
                </a>
            </th>
        </tr>
        @endforeach
    </table>
</div>
@endsection