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
    <form action="{{ route('books.trash', $book->id) }}" method="post" name="contact_form">
      @method('patch')
      @csrf
      <input type="hidden" name="trash_date" value="
      <?php
        echo date('Y-m-d');
      ?>">
      <button onclick="trashBook()" name="check">廃棄</button>
    </form>
    <script>
        //[確認]ボタンが押されたときの処理を定義
       function trashBook() {
            //input要素（name属性がisbn）の入力内容を取得
            const isbn = "{{$book->isbn}}" ;
            const title = "{{$book->title}}";
            const classify_id = "{{$book->classify_id}}";
            const author = "{{$book->author}}";
            const publisher = "{{$book->publisher}}";
            const publish_date = "{{$book->publish_date}}"
            
            event.preventDefault();
            if (confirm('以下の資料を廃棄しますか？\n' + "ISBN番号" + isbn + "\n"
                    + "資料名:" + title +"\n" 
                    + "分類コード:" + classify_id + "\n" 
                    + "著者:" + author + "\n"
                    + "出版社:" + publisher + "\n"
                    + "出版日:" + publish_date 
                    
                    )
        ) {
                contact_form.submit();
            }
        }
        
        ;
  </script>
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