@extends('layouts.app')

@section('content')
  <h1>資料情報更新</h1>
  <form action="#" method="post">
    @method('patch')
    @csrf
    <dl>
      <dt>ISBN</dt>
      <dd>
          <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}">
      </dd>
      <dt>資料名</dt>
      <dd>
          <input type="text" name="title" value="{{ old('title', $book->title) }}">
      </dd>
      <dt>分類コード </dt>
      <dd>
          <select name="classify_id">
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
      <dt>著者</dt>
      <dd>
          <input type="text" name="author" value="{{ old('author', $book->author) }}">
      </dd>
      <dt>出版社</dt>
      <dd>
          <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}">
      </dd>
      <dt>出版日</dt>
      <dd>
          <input type="date" name="publish_date" value="{{ old('publish_date', $book->publish_date) }}">
      </dd>
    </dl>
    <button type="submit">更新</button>
  </form>
  <form action="{{ route('books.show', $book) }}" method="get">
    <button>キャンセル</button>
  </form>
@endsection