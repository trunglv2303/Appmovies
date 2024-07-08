@extends('admin.main')
@section('content')
    <div class="container">
        <h1>Danh sách sản phẩm</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Phim</th>
                    <th>Tên Phim</th>
                    <th>Ảnh </th>
                    <th>URL Phim</th>
                    <th>QUyền Phim</th>

                    <th>Thể Loại Phim</th>
                    <th>Mô tả nội dung phim</th>
                    <th>Thười Lượng</th>
                    <th>Giới hạn độ tuổi</th>
                    <th>Ngôn Ngữ</th>
                    <th>Thao Tác</th>

                </tr>
            </thead>
            @foreach ($listviews as $listview)
                
                <tr>
            <th style="white-space: normal;width: 1px; "> {{ $listview['code_phim'] }}</th>
                    <th style="white-space: normal; width:150px;">{{$listview['name_movie'] }}</th>
                    <th> <img style="width:110px;height:160px;border-radius:0%" src="{{$listview['file_movie'] }}" alt=""> </th>
                    <th style="white-space: normal;max-width:100px;overflow: hidden; text-overflow: ellipsis;">{{ $listview['url_phim'] }}</th>
                    <th style="white-space: normal; width:150px;">{{$listview['power'] }}</th>

                    <th><?php $movies = app('firebase.firestore')
                        ->database()
                        ->collection('type_movie')
                        ->where('id_type', '=', $listview['category_movie'])
                        ->limit(1)
                        ->documents();
                        ?>
                   @foreach ($movies as $movie)
                  
                {{$movie['name_type']}}
                
                   @endforeach  
                    </th>
                    <th style="white-space: normal;max-width: 70px; ">{{ $listview['info_movie'] }}</th>

                    <th>{{$listview['time_movie']}}</th>
                    <th>{{$listview['age_movie']}}</th>
                    <th>{{ $listview['language_movie']}}</th>
              
                    <th><a class="btn btn-primary btn-sm" href="/movie/edit/{{$listview['code_phim']}}">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a class="btn btn-danger btn-sm" href="/movie/delete/{{ $listview['code_phim'] }}">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </th>
                </tr>
                
            @endforeach
 <tbody>
            
        </tbody>
        </table>
    </div>
@endsection