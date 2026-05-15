<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理者勤怠詳細画面</title>

  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

  <!-- この画面専用CSS -->
  <!-- <link rel="stylesheet" href="{{ asset('css/admin_attendance_list.css') }}" /> -->
</head>

<body>

  <!-- ヘッダー -->

    <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">COACHTECH</a>
    </div>

    <nav class="nav">
      <a href="{{ route('admin.attendance.list') }}">勤怠一覧</a>
      <a href="{{ route('admin.staff.list') }}">スタッフ一覧</a>
      <a href="{{ route('stamp_correction_request.list') }}">申請一覧</a>

       <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav_logout">ログアウト</button>
    </form>
</nav>
  </header>


  <!-- メイン -->
  <main class="main">
  <div class="admin_attendance_detail__content">

  <div class="admin_attendance_detail__heading">
    <h2>勤怠詳細</h2>
  </div>

  <p>名前：{{ $attendance->user->name }}</p>

  <p>日付：{{ $attendance->date }}</p>

  <p>出勤：{{ $attendance->clock_in }}</p>

  <p>退勤：{{ $attendance->clock_out }}</p>

  <p>休憩1：{{ $attendance->break_time_1 ?? 'ー' }}</p>

  <p>休憩2：{{ $attendance->break_time_2 ?? 'ー' }}</p>

  <p>備考：{{ $attendance->note ?? 'ー' }}</p>

</div>

<div>
        <form>
          <button>修正</button>
        </form>
    </div>