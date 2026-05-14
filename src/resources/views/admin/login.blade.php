<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理者ログイン</title>

  <!-- リセットCSS（入れておくとズレにくい） -->
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

  <!-- この画面専用CSS -->
  <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}" />
</head>

<body>

  <!-- ヘッダー -->
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        COACHTECH
      </a>
    </div>
  </header>

  <!-- メイン -->
  <main class="main">
    <div class="admin_login__content">

      <!-- タイトル -->
      <div class="admin_login__heading">
        <h2>管理者ログイン</h2>
      </div>

      <!-- フォーム -->
      <form class="form" action="{{ route('login') }}" method="POST">
        @csrf

        <!-- メールアドレス -->
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
          </div>

          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="" />
            </div>

            <div class="form__error">
              <!-- バリデーションを実装したら表示 -->
            </div>
          </div>
        </div>

        <!-- パスワード -->
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">パスワード</span>
          </div>

          <div class="form__group-content">
            <div class="form__input--text">
              <input type="password" name="password" placeholder="" />
            </div>

            <div class="form__error">
              <!-- バリデーションを実装したら表示 -->
            </div>
          </div>
        </div>

        <!-- ボタン -->
        <div class="form__button">
          <button class="form__button-submit" type="submit">管理者ログインする</button>
        </div>

      </form>
    </div>
  </main>

</body>

</html>