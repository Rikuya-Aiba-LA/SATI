<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->id) {
            
            $books = Book::where('id',$request->id)->orderBy('created_at','desc')->paginate(20);

        }else if ($request->trash_date){
            
            $books = Book::whereNotNull('trash_date')->orderBy('created_at','desc')->paginate(20);

        }else {

            $books = Book::whereNull('trash_date')->orderBy('created_at','desc')->paginate(20);

        }
        
        return view('books/index',['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $book = new Book;
        return view('books/create',['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector returned
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'isbn'=>'required|size:13',
            'title'=>'required|max:255',
            'classify_id'=>'max:9',
            'publisher'=>'max:255',
            'publish_date'
        ]);
        $book = new Book(
           $request->all()
        );
       $book->save();
        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Book $book)
    {
        return view('books/show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Book $book)
    {
        return view('books/edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request,[
            'isbn'=>'required|size:13',
            'title'=>'required|max:255',
            'classify_id'=>'max:9',
            'publisher'=>'max:255',
            'publish_date'
        ]);
        $book->update($request->all());
        return redirect(route('books.show', $book));
    }

    public function trash(Request $request ,Book $book){
        $this->validate($request, [
            'trash_date'
        ]);
        $book->update($request->all());
        return redirect(route('books.show', $book));
    }
}
