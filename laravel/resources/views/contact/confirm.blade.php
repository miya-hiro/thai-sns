@extends('app')

@section('title', 'お問い合わせフォーム')

@section('content')
<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <h2 class="h5 card-title m-0">お問い合わせフォーム確認画面</h2>
    </div>

    <form method="POST" action="{{ route('contact.send') }}" class="prof-formWrap">
      @csrf

      <label>メールアドレス</label>
      {{ $inputs['email'] }}
      <input name="email" class="form-control" value="{{ $inputs['email'] }}" type="hidden">

      <label>タイトル</label>
      {{ $inputs['title'] }}
      <input class="form-control" name="title" value="{{ $inputs['title'] }}" type="hidden">

      <label>お問い合わせ内容</label>
      {!! nl2br(e($inputs['body'])) !!}
      <input name="body" class="form-control" 
      value="{{$inputs['body'] }}" 
      type="hidden"
      style="display:block; width: 100%;">

      <button type="submit" value="back" name="action" class="btn blue-gradient btn-block">
        入力内容修正
      </button>
      <button type="submit" value="submit" name="action" class="btn blue-gradient btn-block">
        送信する
      </button>
    </form>
  </div>

</div>

@endsection