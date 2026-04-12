
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
      <h2 class="page-title">勤怠一覧</h2>

      <!-- 月移動 -->
      <div class="month-nav">
        <a class="month-nav__link" href="{{ route('attendance.list', ['month' => $prevMonth]) }}">← 前月</a>
        <div class="month-nav__current">{{ $currentMonth }}</div>
        <a class="month-nav__link" href="{{ route('attendance.list', ['month' => $nextMonth]) }}">翌月 →</a>
      </div>

      <table class="attendance-table">
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
          @foreach ($days as $day)
            @php
              $key = $day->format('Y-m-d');
              $a = $attendances[$key] ?? null;

              $clockIn  = $a?->clock_in ? \Carbon\Carbon::parse($a->clock_in) : null;
              $clockOut = $a?->clock_out ? \Carbon\Carbon::parse($a->clock_out) : null;

              $breakStart = $a?->break_start ? \Carbon\Carbon::parse($a->break_start) : null;
              $breakEnd   = $a?->break_end ? \Carbon\Carbon::parse($a->break_end) : null;

              // 休憩2も足す（任意）
              $break2Start = $a?->break2_start ? \Carbon\Carbon::parse($a->break2_start) : null;
              $break2End   = $a?->break2_end ? \Carbon\Carbon::parse($a->break2_end) : null;

              $breakMin = 0;
              if ($breakStart && $breakEnd) $breakMin += $breakEnd->diffInMinutes($breakStart);
              if ($break2Start && $break2End) $breakMin += $break2End->diffInMinutes($break2Start);

              $workMin = null;
              if ($clockIn && $clockOut) {
                $workMin = $clockOut->diffInMinutes($clockIn) - $breakMin;
                if ($workMin < 0) $workMin = 0;
              }

              $breakStr = $breakMin ? sprintf('%d:%02d', intdiv($breakMin, 60), $breakMin % 60) : '';
              $workStr  = is_null($workMin) ? '' : sprintf('%d:%02d', intdiv($workMin, 60), $workMin % 60);

              $week = ['日','月','火','水','木','金','土'][$day->dayOfWeek];
            @endphp

            <tr>
              <td>{{ $day->format('m/d') }}（{{ $week }}）</td>

              <td>{{ $clockIn ? $clockIn->format('H:i') : '' }}</td>
              <td>{{ $clockOut ? $clockOut->format('H:i') : '' }}</td>
              <td>{{ $breakStr }}</td>
              <td>{{ $workStr }}</td>

              <td>
                @if($a)
                  <a class="detail-link" href="{{ route('attendance.detail', ['id' => $a->id]) }}">詳細</a>
                @else
                  <span class="detail-link--disabled">-</span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </main>
</body>
</html>