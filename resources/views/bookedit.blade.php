@extends('layouts.app')

@section('content')
<!-- Bootstrapの定型コード・・・ -->
<div class="card-body">

    <!-- バリデーションエラーの表示に使用 -->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用 -->

    <!-- 本登録フォーム -->
    <form enctype="multipart/form-data" action="{{ url('books/update') }}" method="POST" class="form-horizontal">
        @csrf

            <!-- 本のタイトル -->
            <div class="form-group col-sm-6 mb-4">
                <div class="card-title">
                    本のタイトル
                </div>
                <input type="text" name="book_name" class="form-control" value="{{ $book->book_name }}">
            </div>

            <!-- 本の冊数 -->
            <div class="form-group col-sm-6 mb-4">
                <div class="card-title">
                    冊数
                </div>
                <input type="text" name="book_quantity" class="form-control" value="{{ $book->book_quantity }}">
            </div>

            <!-- 本の画像登録 -->
            <div class="form-group col-sm-6 mb-4">
                <div class="card-title">
                    サムネイル
                </div>
                <input type="file" name="book_image" class="form-control">
            </div>

            <!-- 最新刊発売日 -->
            <div class="form-group col-sm-6 mb-4">
                <div class="card-title">
                    最新刊発売日
                </div>
                <input type="date" name="book_new" class="form-control" value="{{ $book->book_new }}">
            </div>
    
            <!-- 更新・戻るボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">
                    更新
                </button>
                <a class="btn btn-danger pull-right" href="{{ url('/') }}">
                    戻る
                </a>
            </div>

            <!-- id値を送信 -->
            <input type="hidden" name="id" value="{{ $book->id }}">
    </form>
</div>

@endsection
