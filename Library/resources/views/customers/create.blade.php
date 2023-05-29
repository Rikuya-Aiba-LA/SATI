@extends('layouts.app')
@section('content')
<h1>会員登録画面</h1>
@include('commons.flash')
<form action="{{ route('customers.store') }}" method="post" class="button_line004" name="contact_form" >
@csrf
<div class="create">
    <dl>
        <dt>氏名</dt>
        <dd>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}">
        </dd>
        <dt>住所</dt>
        <dd>
            <input type="text" name="address" value="{{ old('address', $customer->address) }}">
        </dd>
        <dt>電話番号</dt>
        <dd>
            <input type="number" name="tel" value="">
        </dd>
        <dt>E-mail</dt>
        <dd>
            <input type="email" name="email" value="">
        </dd>
        <dt>生年月日</dt>
        <dd>
            @if($customer->birth)
                <?php
                    preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$customer->birth, $birth_date_match);
                ?>
                <input type="date" name="birth" value="{{ old('birth', $birth_date_match[0]) }}">
            @else
                <input type="date" name="birth" value="{{ old('birth', $customer->birth) }}">
            @endif
            
        </dd>
        <input type="hidden" name="record_date" value="{{ date('Y-m-d') }}">
    </dl>
</div>
<button onclick = "createCustomer()" class="btn2" name = "check">登録</button>

</form>
<script>
        //[確認]ボタンが押されたときの処理を定義
       function createCustomer() {
            //input要素の入力内容を取得
            const name = contact_form.name.value;
            const address = contact_form.address.value;
            const tel = contact_form.tel.value;
            const email = contact_form.email.value;
            const birth = contact_form.birth.value;
            const record_date = contact_form.record_date.value;
            event.preventDefault();
            if (confirm('以下の入力で正しいですか？\n' + "氏名:" + name + "\n"
                    + "住所:" + address +"\n"
                    + "電話番号:" + tel + "\n"
                    + "E-mail:" + email + "\n"
                    + "生年月日:" + birth + "\n"
                    + "登録日:" + record_date)
        ) {
                contact_form.submit();
            }
        }
        ;
    </script>
@endsection