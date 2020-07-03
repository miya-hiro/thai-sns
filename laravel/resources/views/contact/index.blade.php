@extends('app')

@section('title', 'お問い合わせフォーム')

@section('content')
<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <h2 class="h5 card-title m-0">お問い合わせフォーム</h2>
    </div>

    <form method="POST" action="{{ route('contact.confirm') }}" class="prof-formWrap">
      @csrf

      <label>メールアドレス</label>
      <input name="email" class="form-control" value="{{ old('email') }}" type="text">
      @if ($errors->has('email'))
      <p class="error-message">{{ $errors->first('email') }}</p>
      @endif

      <label>タイトル</label>
      <input class="form-control" name="title" value="{{ old('title') }}" type="text">
      @if ($errors->has('title'))
      <p class="error-message">{{ $errors->first('title') }}</p>
      @endif


      <label>お問い合わせ内容</label>
      <textarea name="body" class="form-control" cols="30" rows="6" style="display:block; width: 100%;">{{ old('body') }}</textarea>
      @if ($errors->has('body'))
      <p class="error-message">{{ $errors->first('body') }}</p>
      @endif

      <button type="submit" class="btn blue-gradient btn-block">
        入力内容確認
      </button>
    </form>
  </div>

</div>

@endsection