
@extends('admin.main')
@section('content')
<form action="{{route('addtype')}}" method="POST">
    @include('alert')
    <div class="card-body">
        <h1>Thêm Thể loại phim</h1>
        <div class="form-group">
            <label for="menu">Mã Thể Loại</label>
            <input type="text" style="color: aliceblue;" name="id_type" class="form-control" placeholder="Nhập mã loại phim">
        </div>
        <div class="form-group">
            <label for="menu">Tên Thể Loại</label>
            <input type="text" style="color: aliceblue;" name="name_type" class="form-control" placeholder="Vui lòng nhập bằng tiếng việt">
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm</button>
    </div>
    @csrf
</form>
@endsection
