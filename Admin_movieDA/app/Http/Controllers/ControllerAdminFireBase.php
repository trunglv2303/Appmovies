<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;
class ControllerAdminFireBase extends Controller
{
    function loginadmin(Request $request){
        if ($request->username) {
            $firebaseAuth=Firebase::auth();

            try {
                $login = $firebaseAuth->signInWithEmailAndPassword($request->username, $request->password);
                if ($login) {
                    return view('Admin.main');
                }
            } catch (InvalidPassword $e) {
                // Handle invalid password error
                return redirect()->back()->with('password' , 'Invalid password. Please try again.');
            } catch (UserNotFound $e) {
                // Handle user not found error
                return redirect()->back()->with('username' , 'The account does not exist. Please check your username.');
            } catch (\Exception $e) {
                // Handle other errors
                return redirect()->back()->with('error' , 'An unexpected error occurred. Please try again later.');
            }
        } else {
            return view('Admin.Login');
        }
    }
    function login()
    {
        return view('Login');
    }
    //View thêm phim
    function viewaddproductmovie()
    {
        $listtypes = app('firebase.firestore')->database()->collection('type_movie')->documents();
        return view('Admin.ListMovies.add', compact('listtypes'));
    }
    //Thêm dữ liệu vài firebase
    function addMovie(Request $request)
    {
        $code_phim = $request->code_movie;
        $name_movie = $request->name_movie;
        $category_movie = $request->category_movie;
        $time_movie = $request->time_movie;
        $age_movie = $request->age_movie;
        $language_movie = $request->language_movie;
        $info_movie = $request->info_movie;
        $url_phim = $request->url_phim;
        $file_movie = $request->file_movie;
        $power = $request->power;
        // $image_firebase = app('firebase.firestore')->database()->collection('Images')->add([]);
        // // Định nghĩa đường dẫn trên Firebase Storage để lưu trữ hình ảnh
        // $firebase_storage_path = 'Images/';
        // // Tạo tên cho hình ảnh dựa trên ID của tài liệu
        // $name = $image_firebase->id();
        // // Đường dẫn thư mục tạm thời trên máy chủ Laravel
        // $localfolder = public_path('firebase-temp-uploads') . '/';
        // // Lấy phần mở rộng của tệp hình ảnh
        // $extension = $file_movie->getClientOriginalExtension();
        // // Tạo tên tệp mới dựa trên ID của tài liệu và phần mở rộng của hình ảnh
        // $file = $name . '.' . $extension;
        $check_codephim = app('firebase.firestore')->database()->collection('movies')->where('code_phim', '=', $code_phim)->documents();
        if ($check_codephim->isEmpty()) {
            // if ($file_movie->move($localfolder, $file)) {
            // Mở tệp và tải lên Firebase Storage
            // $uploadedfile = fopen($localfolder . $file, 'r');
            // app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
            // // Xóa tệp hình ảnh từ thư mục tạm thời trên máy chủ Laravel
            // unlink($localfolder . $file);
            // // Gửi thông báo flash thông qua session
            $stuRef = app('firebase.firestore')->database()->collection('movies')->newDocument();
            $stuRef->set([
                'url_phim' => $url_phim,
                'code_phim' => $code_phim,
                'name_movie' => $name_movie,
                'category_movie' => $category_movie,
                'time_movie' => $time_movie,
                'age_movie' => $age_movie,
                'language_movie' => $language_movie,
                'info_movie' => $info_movie,
                'file_movie' => $file_movie,
                'power' => $power,
            ]);
        } else {
            Session::flash('error', 'Mã sản phẩm đã tồn tại');
            return redirect()->back();
        }

        Session::flash('success', 'Đăng ký sản phẩm thành công.');
        return redirect()->back();
        // }


    }
    function listsmovie()
    {
        $listviews = app('firebase.firestore')->database()->collection('movies')->documents();

        return view('Admin.ListMovies.list', compact('listviews'));
    }
    //xThêm thể loại phim
    function viewtype()
    {
        return view('Admin.ListTypeMovies.add');
    }
    function addtypemovie(Request $request)
    {
        $id_type = $request->id_type;
        $name_type = $request->name_type;
        $check_type = app('firebase.firestore')->database()->collection('type_movie')->where('id_type', '=', $id_type)->documents();
        if ($check_type->isEmpty()) {
            $add = app('firebase.firestore')->database()->collection('type_movie')->newDocument();
            $add->set([
                'id_type' => $id_type,
                'name_type' => $name_type,
            ]);
            Session::flash('success', 'Thêm thành công');
            return redirect()->back();
        } else {
            Session::flash('error', 'Mã thể loại đã tồn tại');
            return redirect()->back();
        }
    }
    function listtype()
    {
        $listtypes = app('firebase.firestore')->database()->collection('type_movie')->documents();
        return view('Admin.ListTypeMovies.list', compact('listtypes'));
    }
    //editmovie
    function editmovie($id)
    {
        $movies = app('firebase.firestore')->database()->collection('movies')->where('code_phim', '=', $id)->documents();
        $listtypes = app('firebase.firestore')->database()->collection('type_movie')->documents();

        return view('Admin.ListMovies.edit', compact(
            'movies',
            'listtypes'
        ));
    }
    function editmoviepost(Request $request, $id)
    {
        $code_phim = $request->code_movie;
        $name_movie = $request->name_movie;
        $category_movie = $request->category_movie;
        $time_movie = $request->time_movie;
        $age_movie = $request->age_movie;
        $language_movie = $request->language_movie;
        $info_movie = $request->info_movie;
        $url_phim = $request->url_phim;
        $file_movie = $request->file_movie;
        $power = $request->power;
        $movies = app('firebase.firestore')->database()->collection('movies')->where('code_phim', '=', $id)->documents();
        $movies = app('firebase.firestore')->database()->collection('movies')->where('code_phim', '=', $id)->documents();
        if ($movies) {
            foreach ($movies as $movie) {
                $movie->reference()->update([
                    ['path' => 'url_phim', 'value' => $url_phim],
                    ['path' => 'code_phim', 'value' => $code_phim],
                    ['path' => 'name_movie', 'value' => $name_movie],
                    ['path' => 'category_movie', 'value' => $category_movie],
                    ['path' => 'time_movie', 'value' => $time_movie],
                    ['path' => 'age_movie', 'value' =>  $age_movie],
                    ['path' => 'language_movie', 'value' => $language_movie],
                    ['path' => 'info_movie', 'value' => $info_movie],
                    ['path' => 'power', 'value' => $power],
                    ['path' => 'file_movie', 'value' => $file_movie]
                ]);
                Session::flash('success', 'Cập nhật thành công.');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Cập nhật không thành công.');
            return redirect()->back();
        }
    }
    function deletemovie($id)
    {
        $query = app('firebase.firestore')->database()->collection('movies')->where('code_phim', '=', $id);
        // Lấy các tài liệu thỏa mãn điều kiện
        $documents = $query->documents();
        foreach ($documents as $document) {
            // Xóa tài liệu
            app('firebase.firestore')->database()->collection('movies')->document($document->id())->delete();
        }
        return redirect()->back();
    }
    function edittypemovie($id)
    {
        $listtypes = app('firebase.firestore')->database()->collection('type_movie')->where('id_type', '=', $id)->documents();
        return view('Admin.ListTypeMovies.edit', compact(
            'listtypes'
        ));
    }
    function edittypemoviepost(Request $request, $id)
    {
        $name_type = $request->name_type;
        $listtypes = app('firebase.firestore')->database()->collection('type_movie')->where('id_type', '=', $id)->documents();
        if ($listtypes) {
            foreach ($listtypes as $listtype) {
                $listtype->reference()->update([
                    ['path' => 'name_type', 'value' => $name_type],
                ]);
                Session::flash('success', 'Cập nhật thành công.');
                return redirect()->back();
            }
        } else {
            Session::flash('error', 'Cập nhật không  thành công.');
            return redirect()->back();
        }
    }
    function deletetypemovie($id)
    {
        $query = app('firebase.firestore')->database()->collection('type_movie')->where('id_type', '=', $id);
        // Lấy các tài liệu thỏa mãn điều kiện
        $documents = $query->documents();
        foreach ($documents as $document) {
            // Xóa tài liệu
            app('firebase.firestore')->database()->collection('type_movie')->document($document->id())->delete();
        }
        return redirect()->back();
    }
    function listuser()
    {
        $listusers = app('firebase.firestore')->database()->collection('User')->documents();
        return view('Admin.ListUser.list', compact("listusers"));
    }
    function listcomment()
    {
        $listuserscomments = app('firebase.firestore')->database()->collection('comments')->documents();
        return view('Admin.ListComment.list', compact("listuserscomments"));
    }

    function deleteuser($id)
    {
        $listusers = app('firebase.firestore')->database()->collection('User')->where('id', '=', $id);
        $documents = $listusers->documents();
        foreach ($documents as $document) {
            // Xóa tài liệu
            app('firebase.firestore')->database()->collection('User')->document($document->id())->delete();
        }
        return redirect()->back();
    }
    function deletecomment($id)
    {
        $listusers = app('firebase.firestore')->database()->collection('comments')->where('id', '=', $id);
        $documents = $listusers->documents();
        foreach ($documents as $document) {
            // Xóa tài liệu
            app('firebase.firestore')->database()->collection('comments')->document($document->id())->delete();
        }
        return redirect()->back();
    }
}
