<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex justify-content-between  align-items-center">
    <div class="d-flex">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
      <p class="profImg-wrapper">
      <img src="{{ asset('storage/profile_images/' . $user->my_pic) }}" alt="">
      </p>
      </a>
      <div class="profile" style="max-width:450px;margin-left:15px; ">
      {{ $user->profile }}</div>
      </div>
      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
        >
        </follow-button>
        <a href="user/message/{{ $user->id }}">
        <button  type="button" class="btn btn-info">メッセージを送る</button>
        </a>
      @endif
      @if( Auth::id() === $user->id )
      <button type="button" class="btn btn-info" 
  onclick="location.href='{{ route("users.edit", ["name" => $user->name]) }}'">プロフィール編集</button>
      <button type="button" class="btn btn-primary" 
  onclick="location.href='{{ route("users.showcallender", ["name" => $user->name]) }}'">カレンダー編集</button>
        <!-- <prof-edit-button
          class="ml-auto"
          :authorized='@json(Auth::check())'
        >
        </prof-edit-button> -->
      @endif


    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        {{ $user->name }}
      </a>
    </h2>
  </div>
  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followers }} フォロワー
      </a>
    </div>
  </div>
</div>