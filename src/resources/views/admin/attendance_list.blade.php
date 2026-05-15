<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理者勤怠一覧画面</title>

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
    <div class="admin_attendance_list__content">

      <!-- タイトル -->
      <div class="admin_attendance_list__heading">
        <h2>管理者勤怠一覧画面</h2>
      </div>



    
      <!-- 日移動 -->
      <div class="date-nav">
        <a href="{{ route('admin.attendance.list', ['date' => $prevDate]) }}">← 前日</a>

       <div>{{ $currentDate }}</div>

        <a href="{{ route('admin.attendance.list', ['date' => $nextDate]) }}">翌日 →</a>
      </div>

      <table class="attendance-table">
        <thead>
          <tr>
            <th>名前</th>
            <th>出勤</th>
            <th>退勤</th>
            <th>休憩</th>
            <th>合計</th>
            <th>詳細</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($attendances as $a)
        <tr>
        <!-- <td>{{ $currentDate }}</td> -->
        <td>{{ $a->user->name }}</td>
        <td>{{ $a->clock_in }}</td>
        <td>{{ $a->clock_out }}</td>

        <td>
          <a href="{{ route('admin.attendance.detail', ['id' => $a->id]) }}">詳細</a>
        </td>
        </tr>
        @endforeach
        </tbody>
      </table>

    </div>
  </main>
</body>
</html>