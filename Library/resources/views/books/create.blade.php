@extends('layouts.app')

@section('content')
<h1>書籍登録</h1>

<form action="{{ route('books.store') }}" method="post">
    @csrf
    <dl>
        <dt>ISBN</dt>
        <dd>
            <input type="text" name="isbn" id="{{ old('isbn', $book->isbn) }}">
        </dd>
        <dt>資料名</dt>
        <dd>
            <input type="text" name="title" id="{{ old('title', $book->title) }}">
        </dd>
        <dt>分類コード </dt>
        <dd>
            <select name="classify_id" id="{{ old('classify_id, $book->classify_id') }}">
                <option value="0">総記</option>
                <option value="1">哲学</option>
                <option value="2">歴史</option>
                <option value="3">社会科学</option>
                <option value="4">自然科学</option>
                <option value="5">技術</option>
                <option value="6">産業</option>
                <option value="7">芸術</option>
                <option value="8">言語</option>
                <option value="9">文学</option>

            </select>
        </dd>
        <dt>出版社</dt>
        <dd>
            <input type="text" name="publisher" id="{{ old('publisher', $book->publisher) }}">
        </dd>
        <dt>出版日</dt>
        <dd>
            <input type="date" name="publish_date" id="{{ old('publish_date', $book->publish_date) }}">
        </dd>
    </dl>
    <button type="submit">登録</button>
</form>
@endsection