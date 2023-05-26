@if(Auth::check())
<ul class="navgation">
    <li class="inline">
        <a href="{{ route('books.index') }}">資料一覧</a>
    </li>
    <li class="inline">
        <a href="{{ route('customers.index') }}">会員一覧</a>
    </li>
    <li class="inline">
        <a href="{{ route('lendings.index') }}">貸出台帳</a>
    </li>
    <li class="inline" >
        <a href="#" onclick="logout()">ログアウト</a>
        <form id="logout-form"action="{{ route('logout') }}" method="post">
            @csrf
        </form>
        <script type="text/javascript">
            function logout(){
                event.preventDefault();
                if (window.confirm('ログアウトしますか')) {
                    document.getElementById('logout-form').submit();
                }
            }
        </script>
    </li>
</ul>
@endif