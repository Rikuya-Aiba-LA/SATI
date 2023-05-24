@extends('layouts/app')

@section('content')
<h1>会員詳細画面</h1>
<form action="{{ route('customers.index') }}" method="get">
    <button>一覧へ</button>
  </form>
<!-- 会員の情報を変更するために会員情報変更画面へ飛ぶ -->
<form action="route('custoemrs.edit'ここにEcustomerはいるか)">
    <button type="submit">情報変更</button>
</form>
<form action="#" id=delete-form>
    <button>削除</button>
</form>
<!-- 削除ボタンが押されたら退会日が入力される処理。確認のポップアップも表示 -->
<!-- <script type="text/javascript">
        function deleteBook(){
            event.preventDefault();
            if(window.confirm('本当に削除しますか')){
                document.getElementById('delete-form').submit();
            }
        }
    </script> -->
<!-- 資料検索し資料貸出画面へ -->
<form action="#" method="get">
    <input type="number" name="book_id" value="#" placeholder="資料ID">
    <input type="submit" value="検索する">
</form>


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
    
    @foreach($customer->lendings as $data)
    
    <tr>
        <td>{{ $data->book->id }}</td>
        <td>{{ $data->book->title }}</td>
        <?php
            preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$data->lend_date, $lend_date_match);
        ?>
        <td>{{ $lend_date_match[0] }}</td>
        <!--返却予定日-->
        @if($data->book->expected_date)
            <?php
                preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$data->book->expected_date, $expected_date_match);
            ?>
            <td>{{ $expected_date_match[0] }}</td>
        @else
            <td>{{ $data->book->expected_date }}</td>
        @endif
        
        
        @if($data->return_date == null)
            <td><form action="#">
                <button type="submit">返却</button>
                <!-- ボタンを押したらポップアップが表示され、はいが選択されたらreturn_dateをその日の年月日が入力される -->
            </form></td>
        @else
           <td>{{ $data->return_date }}</td>
        @endif

    </tr>
    @endforeach
</table>
@endsection