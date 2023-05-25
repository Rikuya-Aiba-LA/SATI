@extends('layouts/app')

@section('content')
<h1>会員詳細画面</h1>
<form action="{{ route('customers.index') }}" method="get">
    <button>一覧へ</button>
  </form>
<!-- 会員の情報を変更するために会員情報変更画面へ飛ぶ -->
<form action="{{route('customers.edit', $customer->id) }}">
    <button type="submit">情報変更</button>
</form>
<form action="{{ route('customers.unsub',$customer->id) }}" method= "post">
                
                @csrf
                <input type="hidden" name="unsub_date" value="<?php echo date('Y-m-j');?>">
                <input type="submit" value="退会">
            </form>
    
</form>
<!-- 資料検索し資料貸出画面へ -->
<form action="{{ route('lendings.check', $customer) }}" method="get">
    <input type="number" name="book_id" value="{{ request('id') }}" placeholder="資料ID" required>
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
            <form action="{{ route('lendings.update',[$data,$customer]) }}" method="post">
            
            @csrf
            <input type="hidden" name="return_date" value="
            <?php
            echo date('Y-m-d');
            ?>">
            <input type="submit" value="返却">
           </form>
        </td>
    
    @endif

    </tr>
    @endforeach
</table>
@endsection