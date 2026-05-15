<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>管理者申請一覧画面</title>

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

    <div class="stamp_request_content">

      <div class="stamp_request_heading">
        <h2>申請一覧</h2>
      </div>

      <!-- タブ -->
      <div class="stamp_request_tabs">

        <a href="/stamp_correction_request/list?status=pending">
          承認待ち
        </a>

        <a href="/stamp_correction_request/list?status=approved">
          承認済み
        </a>

      </div>

      <!-- テーブル -->
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

            <td>{{ $request->status }}</td>

            <td>{{ $request->user->name }}</td>

            <td>{{ $request->target_date }}</td>

            <td>{{ $request->reason }}</td>

            <td>{{ $request->created_at }}</td>

            <td>
              <a href="{{ route('stamp_correction_request.approve', $request->id) }}">
                詳細
              </a>
            </td>

          </tr>

          @endforeach

        </tbody>

      </table>

    </div>

  </main>

</body>
</html>