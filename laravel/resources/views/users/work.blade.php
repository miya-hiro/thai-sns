@extends('app')

@section('title')

@section('content')
<h1>出勤日設定</h1>
    <!-- 休日入力フォーム -->
    <form method="POST" action="/work"> 
    <div class="form-group">
    @csrf
    <label for="day">日付[YYYY/MM/DD] </label>
    <input type="text" name="day" class="form-control" id="day">
    <label for="description">説明</label>
    <input type="text" name="description" class="form-control" id="description"> 
    </div>
    <button type="submit" class="btn btn-primary">登録</button> 
    </form> 
    <!-- 休日一覧表示 -->
    <table class="table">
    <thead>
    <tr>
    <th scope="col">日付</th>
    <th scope="col">説明</th>
    <th scope="col">作成日</th>
    <th scope="col">更新日</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
    </table>
@endsection