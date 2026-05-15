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

<main class="main">

    <div class="stamp_request_content">

        <div class="stamp_request_heading">
            <h2>修正申請一覧</h2>
        </div>

        <div class="stamp_request_tabs">
            <a href="/stamp_correction_request/list?status=pending">
                承認待ち
            </a>

            <a href="/stamp_correction_request/list?status=approved">
                承認済み
            </a>
        </div>

        <table class="stamp_request_table">

            <thead>
                <tr>
                    <th>状態</th>
                    <th>名前</th>
                    <th>対象日時</th>
                    <th>申請理由</th>
                    <th>申請日時</th>
                    <th>詳細</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($requests as $request)

                <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->date }}</td>

                    <td>
                        <a href="{{ route('stamp_correction_request.detail', $request->id) }}">
                            詳細
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>

        </table>

    </div>

</main>