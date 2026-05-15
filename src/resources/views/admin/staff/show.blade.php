<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理者スタッフ別一覧画面</title>

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

  <main class="main">

    <div class="staff_attendance_content">

        <div class="staff_attendance_heading">
            <h2>{{ $staff->name }}さんの勤怠</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>日付</th>
                    <th>出勤</th>
                    <th>退勤</th>
                    <th>休憩</th>
                    <th>合計</th>
                    <th>詳細</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($staff->attendances as $attendance)

                <tr>
                    <td>{{ $attendance->work_date }}</td>

                    <td>{{ $attendance->clock_in }}</td>

                    <td>{{ $attendance->clock_out }}</td>

                    <td>
                        {{ $attendance->break_start }}
                        〜
                        {{ $attendance->break_end }}
                    </td>

                    <td>--</td>

                    <td>
                        <a href="{{ route('admin.attendance.detail', $attendance->id) }}">
                            詳細
                        </a>
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>

    </div>

</main>

