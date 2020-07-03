@extends('app')
@section('title', 'カレンダー')
@include('nav')

@section('content')

<div class="container">
  <p>{{ $user }}さんのスケジュール編集</p>
  <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a>&nbsp;&nbsp; <?php echo $html_title; ?>&nbsp;&nbsp;<a href="?ym=<?php echo $next ?>">&gt;</a></h3>
  <form method="POST" action="{{ route('users.storecallender', [ $user ] )}}" class="prof-formWrap">
    @csrf
    <table class="table table-bordered">
      <tr>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th>土</th>
        <th>日</th>
      </tr>
      <?php
      foreach ($weeks as $week) {
        echo $week;
      }
      ?>
    </table>

    <button type="submit" class="btn blue-gradient btn-block">スケジュール送信</button>
  </form>

</div>
</body>

</html>

</div>
@endsection