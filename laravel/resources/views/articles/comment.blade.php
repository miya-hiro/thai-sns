@if (Auth::check())
<?php $user = Auth::user(); ?>
<form class="mb-4" method="POST" action="{{ route('comments.store', ['article' => $article->id]) }}">
  @csrf
  <input type="hidden" name="article_id" value="{{ $article->id }}">
  <input type="hidden" name="user_id" value="{{ $user->id }}">

  <div class="form-group" style="padding: 10px 20px">
    <!-- <label for="body">
                        コメント欄
                    </label> -->
    <textarea placeholder="コメントをどうぞ" id="body" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="4">{{ old('body') }}</textarea>
    @if ($errors->has('body'))
    <div class="invalid-feedback">
      {{ $errors->first('body') }}
    </div>
    @endif

  </div>

  <div class="mt-4" style="margin-left: 20px;">
    <button type="submit" class="btn btn-primary">
      コメントする
    </button>
  </div>
</form>
@endif

@unless (Auth::check())
<div class="mt-4" style="margin-left: 20px;">
  ログインするとコメント機能がご利用いただけます
</div>
@endunless


<div class="mt-4" style="margin-left: 20px;">

  @foreach($comments as $com)
  <div class="profImg-wrapper">
    <a href="{{ route('users.show' ,$com->user->name ) }}" class="text-dark">
      <img src="{{ asset('storage/profile_images/' . $com->user->my_pic) }}" width="100px" height="auto">
    </a>
  </div>

  {{ $com->body}}
  {{ $com->user->name}}
  @endforeach
  @if(isset( $com_data ))
  <div class="comment__person">
    @foreach ($com_data as $data)
    <div>
      <div class="profImg-wrapper">
        <a href="{{ route('users.show' ,['name' => $data[0]]) }}" class="text-dark">
          <img src="{{ asset('storage/profile_images/' . $data[1]) }}" width="100px" height="auto">
        </a>
      </div>
      <p>{{$data['0']}}</p>
    </div>
    <p>{{$data['body']}}</p>
    @endforeach
    @else
    <p>コメントはまだありません</p>
    @endif

  </div>