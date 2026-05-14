<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理者スタッフ一覧画面</title>

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

       <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="nav_logout">ログアウト</button>
    </form>
</nav>
  </header>



  <!-- メイン -->
  <main class="main">
    <div class="admin_attendance_detail__content">

      <!-- タイトル -->
      <div class="admin_attendance_detail__heading">
        <h2>スタッフ一覧</h2>
      </div>

      <tbody>
    @foreach ($attendances as $a)
    <tr>
        <td>{{ $a->staff->name }}</td>
        <td>{{ $a->staff->email }}</td>
        <td>{{ $a->monthly_work }}</td>
        <td>{{ $a->break_time }}</td>
        <td>{{ $a->total_time }}</td>

        <td>
            <a href="{{ route('admin.attendance.staff.list', $a->staff->id) }}">
                詳細
            </a>
        </td>
    </tr>
    @endforeach
</tbody>

    </div>
  </main>
</body>
</html>