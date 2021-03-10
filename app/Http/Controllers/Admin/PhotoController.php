<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photo;

class PhotoController extends Controller
{
    //
    public function add()
    {
        return view('admin.photo.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request,Photo::$rules);
        
        $photo = new Photo;
        $form = $request->all();
        
        if(isset($form['image'])){
            $path = $request->file('image')->store('public/image');
            $photo->image_path = basename($path);
        } else {
            $photo->image_path = null;
        }
        
        unset($form['_token']);
        unset($form['image']);
        
        $photo->fill($form);
        $photo->save();
        
        return redirect('admin/photo/create');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if($cond_title != ''){
            $posts = Photo::where('title', $cond_title)->get();
        } else {
            $posts = Photo::all();
        }
        return view('admin.photo.index', ['posts' => $posts, 'cond_title' => $cond_title]);
        
    }
    
    public function edit(Request $request)
    {
        $photo = Photo::find($request->id);
        if(empty($photo)){
            abort(404);
        }
        return view('admin.photo.edit',['photo_form' => $photo]);
    }
    
    public function update(Request $request)
    {
        //validationをかける
        $this->validate($request, Photo::$rules);
        //Photo Modelからデータ取得
        $photo = Photo::find($request->id);
        //送信されてきたフォームデータを格納
        $photo_form = $request->all();
        //画像を削除した場合はimage_pathも削除する
        if($request->remove == 'ture'){
            $photo_form['image_path'] = null;
        //画像が更新されたら。。
        }elseif($request->file('image')){
            //上はpublic/imageに画像を保存
            //下はファイル名からpathを作成して(左辺)、image_pathに（右辺に）代入
            $path = $request->file('image')->store('public/image');
            $photo_form['image_path'] = basename($path);
        }else{
            //画像は変わってない時
            $photo_form['image_path'] = $photo->image_path;
        }
        
        
        unset($photo_form['image']);
        //削除というチェックボックスからチェックを外す（初期化してる）
        unset($photo_form['remove']);
        unset($photo_form['_token']);
        
        //該当するデータを上書き保存
        $photo->fill($photo_form)->save();
        return redirect('admin/photo');
    }
}
