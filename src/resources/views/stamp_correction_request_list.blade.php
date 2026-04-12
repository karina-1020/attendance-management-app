<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>勤怠一覧画面 - 一般</title>

  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/attendance_list.css') }}" />
</head>

<body>
  <!-- ヘッダー（attendance.blade.php と同じでOK） -->
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">COACHTECH</a>
    </div>

    <nav class="nav">
      <a href="{{ route('attendance.show') }}">勤怠</a>
      <a href="{{ route('attendance.list') }}">勤怠一覧</a>
      <a href="{{ route('stamp_correction_request.list') }}">申請</a>

       <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav_logout">ログアウト</button>
    </form>
</nav>
  </header>

  <main class="main">
    <div class="container">
      <h2 class="page-title">申請一覧</h2>