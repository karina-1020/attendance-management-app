
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>勤怠登録画面一般</title>

  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
</head>

<body>

  <!-- ヘッダー -->
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        COACHTECH
      </a>
    </div>
    <nav class="nav">
  <a href="{{ route('attendance.show') }}">勤怠</a>
  <a href="{{ route('attendance.list') }}">勤怠一覧</a>
  <a href="#">申請</a>

  <form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="nav__logout">ログアウト</button>
  </form>
 </nav>
</header>

<main class="main">
 <section class="card">

 {{-- ステータス --}}
  <div class="status">{{ $status_label }}</div>

{{-- 日付 --}} <div class="date">{{ $today }}</div>

 {{-- 時刻 --}}
 <div class="time">{{ $now }}</div>

 {{-- 勤務外 --}}
   @if($status === 'off')
  <form action="{{ url('/attendance/clock-in') }}" method="POST">
    @csrf
    <button type="submit" class="btn">出勤</button>
  </form>

{{-- 勤務中 --}}
@elseif($status === 'working')
  <div class="btn-area">
    <form action="{{ url('/attendance/clock-out') }}" method="POST">
      @csrf
      <button type="submit" class="btn">退勤</button>
    </form>
    <form action="{{ url('/break/start') }}" method="POST">
      @csrf
      <button type="submit" class="btn">休憩入</button>
    </form>
  </div>
{{-- 休憩中 --}}
@elseif($status === 'break')
  <form action="{{ url('/break/end') }}" method="POST">
    @csrf
    <button type="submit" class="btn">休憩戻</button>
  </form>
@endif

    {{-- 退勤後メッセージ --}}
    @if(session('message'))
      <p class="message">{{ session('message') }}</p>
    @endif

  </section>
</main>
