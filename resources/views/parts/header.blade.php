<nav class="navbar navbar-expand-lg navbar-light pl-5 pr-5 pt-2 pb-2">
  <a class="navbar-brand text-white" href="#">friendmatch</a>
  <div class="collapse navbar-collapse" id="Navber">
    <ul class="navbar-nav">
      @auth
      <li class="nav-item ml-2">
        <a href="#" class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ホーム</a>
      </li>
      @endauth
    </ul>

    <ul class="navbar-nav ml-auto mr-5">
      @auth
      <li class="nav-item ml-2">
        <a class="nav-link text-white" id="post-link" href="#">投稿する</a>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        アイコン
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('users.show') }}">マイページ</a>
          <a class="dropdown-item" href="#">投稿一覧</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">下書き一覧</a>
          <a class="dropdown-item" href="#">編集リクエスト一覧</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">設定</a>
          <a class="dropdown-item" href="#">ヘルプ</a>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              ログアウト
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
      @endauth
      @guest
      <li class="nav-item ml-2">
        <a class="nav-link text-white" id="register" href="{{ route('register') }}">ユーザ登録</a>
      </li>
      <li class="nav-item ml-2">
        <a class="nav-link text-white" href="{{ route('login') }}">ログイン</a>
      </li>
      @endguest
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>


