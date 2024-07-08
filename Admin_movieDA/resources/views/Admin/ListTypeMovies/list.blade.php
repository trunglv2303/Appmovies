@extends('admin.main')
@section('content')
<div class="container">
    <h1>Danh sách thể loại phim</h1>
    @include('alert')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Thể Loại</th>
                <th>Tên  Thể Loại </th>
                <th>Thao Tác</th>
        </thead>
        <tr>
            @foreach($listtypes as $listtype)
            <th>{{ $listtype['id_type']}}</th>
            <th>{{$listtype['name_type'] }}</th>
            <th><a class="btn btn-primary btn-sm" href="/type_movie/edit/{{ $listtype['id_type']}}">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <a class="btn btn-danger btn-sm" href="/type_movie/delete/{{ $listtype['id_type']}}">
                    <i class="fas fa-trash"></i> Xóa
                </a>
            </th>
        </tr>
        @endforeach
    </table>
</div>
@endsection