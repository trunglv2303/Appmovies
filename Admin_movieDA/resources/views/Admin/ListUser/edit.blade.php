@extends('admin.main')
@section('content')
@foreach($listtypes as $listtype)
<form action="" method="POST">
    @endforeach
    @include('alert')
    <div class="card-body">
        <h1>Cập Nhật Tình Trạng Đơn Hàng</h1>
        @foreach($listtypes as $listtype)
        <div class="form-group">
            <label for="menu">Mã Màu Sắc</label>
            <input type="text" value="{{$listtype['id_type']}}" style="color: aliceblue;" name="id" class="form-control" placeholder="Nhập mã Danh Mục">
        </div>
        <div class="form-group">
            <label for="menu">Tên Màu sắc</label>
            <input type="text" value="{{$listtype['name_type']}}"style="color: aliceblue;" name="name" class="form-control" placeholder="Vui lòng nhập bằng tiếng anh">
        </div>
        @endforeach
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
    @csrf
</form>
@endsection