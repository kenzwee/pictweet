@extends('layouts.admin')
@section('title', '投稿内容の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>投稿内容編集</h2>
                <form action="{{ action('Admin\PhotoController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <img class = "col-md-10" src="{{secure_asset('storage/image/'.$photo_form->image_path)}}">
                            <div class="form-text text-info">
                                設定中: {{ $photo_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="country">国名</label>
                        <div class="dropdown col-md-10">
                            <select name="country" id="contry-select" value="{{ $photo_form->country }}">
                                <option value="">--国を選んでください--</option>
                                <option value="america" {{ ($photo_form->country == "america") ? "selected" : "" }}>アメリカ</option>
                                <option value="india" {{ ($photo_form->country == "india") ? "selected" : "" }}>インド</option>
                                <option value="china" {{ ($photo_form->country == "china") ? "selected" : "" }}>中国</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $photo_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ $photo_form->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $photo_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection