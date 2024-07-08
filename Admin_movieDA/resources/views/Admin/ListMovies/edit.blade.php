@extends('admin.main')
@section('content')
    <form action="  " method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <h1 style="text-align: center">Sửa phim</h1>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            @foreach ($movies as $movie)
            <div class="form-group">
                <label for="menu">Mã Phim</label>
                <input type="text" name="code_movie" value="{{$movie['code_phim']}}" class="form-control" style="color: aliceblue;"
                    placeholder="Nhập mã sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="menu">Tên Phim</label>
                <input type="text" name="name_movie" value="{{$movie['name_movie']}}" style="color: aliceblue;" class="form-control"
                    placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="menu">URL Phim </label>
                <input type="text" name="url_phim" value="{{$movie['url_phim']}}" style="color: aliceblue;" class="form-control"
                    placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="menu">Quyền Phim </label>
                <input type="text" name="power" value="{{$movie['power']}}" style="color: aliceblue;" class="form-control"
                    placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="menu">Thể Loại Phim</label>
                <select class="form-control" style="color: aliceblue;" name="category_movie">

@foreach ($listtypes as $listtype)
                    <option value="{{ $listtype['id_type'] }}" {{ $movie['category_movie']  == $listtype['id_type'] ? 'selected' : ''}}>{{ $listtype['name_type'] }}</option>
                @endforeach
                   

                </select>
            </div>
            <div class="row">
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label for="menu">Thời Lượng(Phút)</label>
                        <input type="number" value="{{ $movie['time_movie']}}"  name="time_movie" style="color: aliceblue;" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="menu">Giới hạn độ tuổi</label>
                        <input type="number" value="{{ $movie['age_movie']}}" name="age_movie" style="color: aliceblue;"class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="menu">Ngôn Ngữ </label>
                        <input type="text" value="{{ $movie['language_movie']}}" name="language_movie" style="color: aliceblue;" class="form-control"
                     >
                    </div>
                </div>
            </div>

            <div class="form-group" style="color: black">
                <label style="color: white">Mô tả nội dung phim</label> <br>
                <textarea id="editor" name="info_movie">
                    <p> {{$movie['info_movie']}}</p>
                </textarea>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#editor'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            </div>
            <div class="form-group">
                <label for="menu">Ảnh đại diện phim</label>
                <input type="text" value="{{ $movie['file_movie']}}" class="form-control" name="file_movie" required>
            </div>
            @endforeach
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </div>
        @csrf
    </form>
@endsection
