@extends('layouts.app')

@section('content')
  <h1>資料編集</h1>
  @include('commons.flash')
  <form action="{{ route('books.update', $book->id) }}" class="button_line004" method="post" name = "contact_form">
    @method('patch')
    @csrf
    <div class="create">
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
            <!--更新できず、バリデーションによって跳ね返された際の値保持-->
              <option type="text" value="0" @if(0 === (int)old('classify_id')) selected @endif>総記</option>
              <option type="text" value="1" @if(1 === (int)old('classify_id')) selected @endif>哲学</option>
              <option type="text" value="2" @if(2 === (int)old('classify_id')) selected @endif>歴史</option>
              <option type="text" value="3" @if(3 === (int)old('classify_id')) selected @endif>社会科学</option>
              <option type="text" value="4" @if(4 === (int)old('classify_id')) selected @endif>自然科学</option>
              <option type="text" value="5" @if(5 === (int)old('classify_id')) selected @endif>技術</option>
              <option type="text" value="6" @if(6 === (int)old('classify_id')) selected @endif>産業</option>
              <option type="text" value="7" @if(7 === (int)old('classify_id')) selected @endif>芸術</option>
              <option type="text" value="8" @if(8 === (int)old('classify_id')) selected @endif>言語</option>
              <option type="text" value="9" @if(9 === (int)old('classify_id')) selected @endif>文学</option>
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
      <?php
        preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$book->publish_date, $publish_date_match);
      ?>
          <input type="date" name="publish_date" value="{{ old('publish_date', $publish_date_match[0]) }}">
      </dd>
    </dl>
    </div>
    <button onclick = "editBook()" class="btn2" name = "check">更新</button>
    <form action="{{ route('books.show', $book) }}"  method="get">
    <button class="btn2">キャンセル</button>
  </form>
  </form>
  
  <script>
        //[確認]ボタンが押されたときの処理を定義
       function editBook() {
            //input要素（name属性がisbn）の入力内容を取得
            const isbn = contact_form.isbn.value;
            const title = contact_form.title.value;
            const classify_id = contact_form.classify_id.value;
            const author = contact_form.author.value;
            const publisher = contact_form.publisher.value;
            const publish_date = contact_form.publish_date.value;
            event.preventDefault();
            if (confirm('以下の入力で正しいですか？\n' + "ISBN番号" + isbn + "\n"
                    + "資料名:" + title +"\n" 
                    + "分類コード:" + classify_id + "\n" 
                    + "著者:" + author + "\n"
                    + "出版社:" + publisher + "\n"
                    + "出版日:" + publish_date)
        ) {
                contact_form.submit();
            }
        }
        
        ;
    </script>
@endsection