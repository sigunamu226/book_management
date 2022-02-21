<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    //コンストラクタ（このクラスが呼ばれたら最初に処理をする）
    public function __construct(){
        $this->middleware('auth');
    }

    //本一覧表示
    public function index(){
        $books = Book::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(5);
        return view('books', [
            'books' => $books
        ]);
    }

    //編集画面表示
    public function edit(Book $book_id){
        $book = Book::where('user_id',Auth::user()->id)->first();
        return view('bookedit', [
            'book' => $book
        ]);
    }

    //更新
    public function update(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'book_name' => 'required|max:255',
            'book_quantity' => 'required|min:1',
        ]);

        //バリデーションエラー
        if($validator->fails()) {
            return redirect()
                ->route('bookedit', ['book' => $request->id])
                ->withInput()
                ->withErrors($validator);
        }

        $file=$request->file('book_image');
            if(!empty($file)){
                $filename = $file->getClientOriginalName();
                $file->move('./upload/',$filename);
            }else{
                $filename = "";
            }

        //Eroquent モデル（更新処理）
        $books = Book::where('user_id',Auth::user()->id)->find($request->id);
        $books->book_name = $request->book_name;
        $books->book_quantity = $request->book_quantity;
        $books->book_image = $filename;
        $books->book_new = $request->book_new;
        $books->save();
        return redirect('/');
    }

    //更新処理エラー時表示画面
    public function reload(Book $book){
        return view('bookedit', [
            'book' => $book
        ]);
    }

    //登録
    public function store(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'book_name' => 'required|max:255',
            'book_quantity' => 'required|min:1',
        ]);

        //バリデーションエラー
        if($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $file=$request->file('book_image');
            if(!empty($file)){
                $filename = $file->getClientOriginalName();
                $file->move('./upload/',$filename);
            }else{
                $filename = "";
            }

        //Eroquent モデル（登録処理）
        $books = new Book;
        $books->user_id = Auth::user()->id;
        $books->book_name = $request->book_name;
        $books->book_quantity = $request->book_quantity;
        $books->book_image = $filename;
        $books->book_new = $request->book_new;
        $books->save();
        return redirect('/');
    }

    //削除
    public function delete(Book $book){
        Storage::disk('public')->delete($book->book_image);
        $book->delete();
        return redirect('/');
    }
}
