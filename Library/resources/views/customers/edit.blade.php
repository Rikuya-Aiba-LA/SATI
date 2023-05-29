@extends('layouts.app')

@section('content')
<h1>会員情報編集</h1>
@include('commons.flash')
<form action="{{ route('customers.update',$customer->id) }}" class="button_line004" method="post" name="contact_form" >
    @method('patch')
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
            <input type="tel" name="tel" value="{{ old('tel', $customer->tel) }}">
        </dd>
        <dt>E-mail</dt>
        <dd>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}">
        </dd>
        <dt>生年月日</dt>
        <dd>
        <?php
            preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}/',$customer->birth, $birth_match);
        ?>
            <input type="date" name="birth" value="{{ old('birth', $birth_match[0]) }}">
        </dd>
    </dl>
    </div>
    <button onclick = "createCustomer()" class="btn2" name = "check">更新</button>
    <button onclick="location.href='{{ route('customers.show', $customer) }}'" class="btn2">キャンセル</button>
</form>
    <!--<form action="{{ route('customers.show', $customer) }}" class="button_line004" method="get">
        <button class="btn2">キャンセル</button>
    </form>-->
<script>
        //[確認]ボタンが押されたときの処理を定義
       function createCustomer() {
            //input要素の入力内容を取得
            const name = contact_form.name.value;
            const address = contact_form.address.value;
            const tel = contact_form.tel.value;
            const email = contact_form.email.value;
            const birth = contact_form.birth.value;
            event.preventDefault();
            if (confirm('以下の入力で正しいですか？\n' + "氏名:" + name + "\n"
                    + "住所:" + address +"\n"
                    + "電話番号:" + tel + "\n"
                    + "E-mail:" + email + "\n"
                    + "生年月日:" + birth + "\n")
        ) {
                contact_form.submit();
            }
        }
        ;
    </script>
@endsection
