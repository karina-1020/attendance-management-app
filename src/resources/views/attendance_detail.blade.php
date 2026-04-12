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
      <h2 class="page-title"></h2>勤怠詳細

      <p>名前：{{ $attendance->user->name ?? '' }}</p>
      <p>日付：{{ \Carbon\Carbon::parse($attendance->work_date)->format('Y年n月j日') }}</p>

      <p>出勤・退勤：{{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '' }}〜
        {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '' }}
      </p>

      <p>休憩：{{ $attendance->break_start ? \Carbon\Carbon::parse($attendance->break_start)->format('H:i') : '' }}〜
        {{ $attendance->break_end ? \Carbon\Carbon::parse($attendance->break_end)->format('H:i') : '' }}
      </p>

      <p> 休憩2：{{ $attendance->break2_start ? \Carbon\Carbon::parse($attendance->break2_start)->format('H:i') : '' }}〜
        {{ $attendance->break2_end ? \Carbon\Carbon::parse($attendance->break2_end)->format('H:i') : '' }}
      </p>

      <p>備考：{{ $attendance->note ?? '' }}</p>

    <div>
        <form>
          <button>修正</button>
        </form>
    </div>