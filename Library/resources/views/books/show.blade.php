@extends('layouts.app')

@section('content')
  <h1>資料詳細画面</h1>
  <form action="{{ route('books.index') }}" method="get">
    <button>一覧へ</button>
  </form>
  <form action="{{ route('books.edit', $book) }}" method="get">
    <button>編集</button>
  </form>
  @if($book->trash_date)
    <p>資料は廃棄済みです</p>
  @else
    @if($book->lendings->whereNull('return_date')->count() > 0)
    <p>この資料は貸出中の為廃棄できません</p>
    @else
    <form action="{{ route('books.trash', $book->id) }}" method="post">
      @method('patch')
      @csrf
      <input type="hidden" name="trash_date" value="
      <?php
        echo date('Y-m-d');
      ?>">
      <input type="submit" value="廃棄">
    </form>
    @endif
  @endif
  <dl>
    <dt>ISBN: </dt>
    <dd>{{ $book->isbn }}</dd>
    <dt>資料名: </dt>
    <dd>{{ $book->title }}</dd>
    <dt>分類コード: </dt>
    <dd>{{ $book->classify_id }}</dd>
    <dt>著者: </dt>
    <dd>{{ $book->author }}</dd>
    <dt>出版社: </dt>
    <dd>{{ $book->publisher }}</dd>
    <dt>出版日: </dt>
    <?php
      preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$book->publish_date, $date_match);
    ?>
    <dd>{{ $date_match[0] }}</dd>
    @if($book->trash_date)
      <dt>廃棄年月日</dt>
      <?php
            preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$book->trash_date, $trash_date_match);
        ?>
      <dd>{{ $trash_date_match[0] }}</dd>
    @endif
  </dl>
@endsection