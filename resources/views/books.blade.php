@extends('layouts.app')

@section('content')
<!-- Bootstrapの定型コード・・・ -->
<div class="card-body">

    <!-- バリデーションエラーの表示に使用 -->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用 -->

    <!-- 本登録フォーム -->
    <form enctype="multipart/form-data" action="{{ url('books') }}" method="POST" class="form-horizontal">
        @csrf

        <div class="row">
            <!-- 本のタイトル -->
            <div class="form-group col-sm-6">
                <div class="card-title">
                    本のタイトル
                </div>
                <input type="text" name="book_name" class="form-control">
            </div>

            <!-- 本の冊数 -->
            <div class="form-group col-sm-6 regist-content">
                <div class="card-title">
                    冊数
                </div>
                <input type="text" name="book_quantity" class="form-control">
            </div>
        </div>

        <div class="row mt-md-4">
            <!-- 本の画像登録 -->
            <div class="form-group col-sm-6 regist-content">
                <div class="card-title">
                    サムネイル
                </div>
                <input type="file" name="book_image" class="form-control">
            </div>

            <!-- 最新刊発売日 -->
            <div class="form-group col-sm-6 regist-content">
                <div class="card-title">
                    最新刊発売日
                </div>
                <input type="date" name="book_new" class="form-control">
            </div>
        </div>
    
        <!-- 本登録ボタン -->
        <div class="form-group mt-4">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary">
                    登録
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Book:すでに登録されている本のリスト -->
    <div class="card-body">
            <table class="table table-striped task-table">
                <!-- テーブルヘッダ -->
                <thead>
                    <th>本一覧</th>
                    <th>&nbsp;</th>
                </thead>
                <!-- テーブル本体 -->
                <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td class="col-2">
                            <div><img src="data:image/jpeg;base64,<?= $book->book_image ?>" width="100"></div>
                        </td>

                        <!-- 本タイトル -->
                        <td class="col-7">
                            <div> {{ $book->book_name }} </div>
                            <div> 所持巻数：{{ $book->book_quantity }}冊 </div>
                            <div> 最新刊発売日：{{ date("Y年m月d日", strtotime($book->book_new)) }} </div>
                        </td>

                        <!-- ボタン -->
                        <td class="col-3">
                            <!-- 本編集ボタン -->
                            <form action="{{ url('/bookedit', $book->id) }}" method="POST" class="mb-2">
                                @csrf

                                <button type="submit" class="btn btn-primary">
                                    編集
                                </button>
                            </form>
                            
                            <!-- 本削除ボタン -->
                            <form action="{{ url('book/'.$book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    削除
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>

@endsection
