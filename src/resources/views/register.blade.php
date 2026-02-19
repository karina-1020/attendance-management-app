<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員登録</title>

  {{-- sanitize（先に読み込む） --}}
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

  {{-- register専用CSS（あとで作る） --}}
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>

  {{-- ヘッダー --}}
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        COACHTECH
      </a>
    </div>
  </header>

  <main class="main">

    <div class="register">
      <h1 class="register__title">会員登録</h1>

      {{-- Fortifyのregister送信先 --}}
      <form class="register__form" method="POST" action="{{ route('register') }}">
        @csrf

        {{-- 名前 --}}
        <div class="register__group">
          <label class="register__label" for="name">名前</label>
          <input class="register__input" type="text" name="name" id="name"
            value="{{ old('name') }}">
          <p class="register__error">
            @error('name')
              {{ $message }}
            @enderror
          </p>
        </div>

        {{-- メールアドレス --}}
        <div class="register__group">
          <label class="register__label" for="email">メールアドレス</label>
          <input class="register__input" type="email" name="email" id="email"
            value="{{ old('email') }}">
          <p class="register__error">
            @error('email')
              {{ $message }}
            @enderror
          </p>
        </div>

        {{-- パスワード --}}
        <div class="register__group">
          <label class="register__label" for="password">パスワード</label>
          <input class="register__input" type="password" name="password" id="password">
          <p class="register__error">
            @error('password')
              {{ $message }}
            @enderror
          </p>
        </div>

        {{-- パスワード確認 --}}
        <div class="register__group">
          <label class="register__label" for="password_confirmation">パスワード確認</label>
          <input class="register__input" type="password" name="password_confirmation" id="password_confirmation">
        </div>

        {{-- 登録ボタン --}}
        <div class="register__button">
          <button class="register__button-submit" type="submit">
            登録する
          </button>
        </div>

        {{-- リンク --}}
        <div class="register__link">
          <a class="register__link-login" href="{{ route('login') }}">
            ログインはこちら
          </a>
        </div>

      </form>
    </div>

  </main>

</body>

</html>