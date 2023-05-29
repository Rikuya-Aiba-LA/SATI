@extends('layouts/app')

@section('content')
<h1>会員詳細画面</h1>
<form action="{{ route('customers.index') }}" method="get">
    <button>一覧へ</button>
  </form>
<!-- 会員の情報を変更するために会員情報変更画面へ飛ぶ -->
<form action="{{route('customers.edit', $customer->id) }}">
    <button type="submit">編集</button>
</form>
@if($customer->unsub_date)
    <p>この会員は退会済みです</p>
@else
    @if($lend_num > 0)
        <p>退会不可: </p>
        <p>未返却図書があるため退会できません</p>
    @else
        <form action="{{ route('customers.unsub',$customer->id) }}" method= "post" name="contact_form">         
            @csrf
            <input type="hidden" name="unsub_date" value="<?php echo date('Y-m-j');?>">
            <button onclick="unsubCustomer()">退会</button>
        </form>
        <script>
        //[確認]ボタンが押されたときの処理を定義
       function unsubCustomer() {
            //input要素の入力内容を取得
            const name = "{{$customer->name}}";
            const address = "{{$customer->address}}";
            const tel = "{{$customer->tel}}";
            const email = "{{$customer->email}}";
            const birth = "{{$customer->birth}}";
            const record_date = "{{$customer->record_date}}";
            event.preventDefault();
            if (confirm('以下の会員が退会しますか？\n' + "氏名:" + name + "\n"
                    + "住所:" + address +"\n"
                    + "電話番号:" + tel + "\n"
                    + "E-mail:" + email + "\n"
                    + "生年月日:" + birth + "\n"
                    + "今日の日付:" + record_date)
        ) {
                contact_form.submit();
            }
        }
        ;
    </script>
    @endif
    @if($count > 0)
        <p>貸出不可: </p>
        <p>返却日を過ぎたの資料が{{ $count }}冊あります</p>
    @elseif($lend_num >=  5)
        <p>貸出不可: </p>
        <p>同時に借りられる資料は5冊までです</p>
    @else
        <form action="{{ route('lendings.check', $customer) }}"  class="button001" method="get">
            <input type="number" name="book_id" value="{{ request('id') }}" placeholder="資料ID" required>
            <input type="submit" class="btn" value="検索する">
        </form>
    @endif
@endif

<hr>
<dl>
    <dt>会員ID: </dt>
    <dd>{{ $customer->id }}</dd>
    <dt>氏名: </dt>
    <dd>{{ $customer->name}}</dd>
    <dt>住所: </dt>
    <dd>{{ $customer->address}}</dd>
    <dt>電話番号: </dt>
    <dd>{{ $customer->tel}}</dd>
    <dt>E-mail: </dt>
    <dd>{{ $customer->email}}</dd>
    <dt>生年月日: </dt>
    <?php
        preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$customer->birth, $birth_date_match);
    ?>
    <dd>{{ $birth_date_match[0] }}</dd>
    <dt>入会年月日: </dt>
    <?php
        preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$customer->record_date, $record_date_match);
    ?>
    <dd>{{ $record_date_match[0] }}</dd>
    <dt>退会年月日: </dt>
    @if($customer->unsub_date)
        <?php
            preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$customer->unsub_date, $unsub_date_match);
        ?>
        <dd>{{ $unsub_date_match[0] }}</dd>
    @else
        <dd>{{ $customer->unsub_date }}</dd>
    @endif
</dl>

<hr>
<h2>貸出中資料</h2>
<table border="1">
    <tr>
        <th>資料ID</th>
        <th>資料名</th>
        <th>貸出日</th>
        <th>返却予定日</th>
        <th>返却</th>
    </tr>
    <?php
        $today = date('Y-m-d');
        $count = 0;
    ?>
    @foreach($customer->lendings as $data)
    @if($data->return_date == null)
    <tr>
        <td>{{ $data->book->id }}</td>

        <td><a href="{{route('books.show', $data->book->id)}}">{{ $data->book->title }}</a></td>
        <?php
            preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$data->lend_date, $lend_date_match);
        ?>
        <td>{{ $lend_date_match[0] }}</td>
        <!--返却予定日-->
        <?php
            preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$data->expectied_date, $expectied_date_match);
        ?>
        <td>{{ $expectied_date_match[0] }}</td> 
        <td>
        <form action="{{ route('lendings.update',[$data,$customer]) }}" method="post" name="return_form">
            
            @csrf
            <input type="hidden" name="return_date" value="
            <?php
            echo date('Y-m-d');
            ?>">
           <button onclick="returnBook()">返却</button>
           </form>
        </td>
        <script>
        //[確認]ボタンが押されたときの処理を定義
       function returnBook() {
            //input要素の入力内容を取得
            const id = "{{$data->book->id}}";
            const title = "{{$data->book->title}}";
            const lend_date = "{{$data->lend_date}}";
            const expectied_date = "{{$data->expectied_date}}";
            event.preventDefault();
            if (confirm('以下の資料を返却しますか？\n' + "資料ID:" + id + "\n"
                    + "資料名:" + title +"\n"
                    + "貸出日:" + lend_date + "\n"
                    + "返却予定日:" + expectied_date )
        ) {
                return_form.submit();
            }
        }
        ;
    </script>
    
    @endif

    </tr>
    @endforeach
</table>
@endsection