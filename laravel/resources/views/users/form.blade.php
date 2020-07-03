@csrf
<label for="">ユーザー名:<input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"></label>
<label for="">自己紹介欄:
<textarea name="profile" class="form-control" id="" cols="30" rows="6" style="display:block; width: 100%;">{{ old('profile', $user->profile) }}</textarea>
</label>

プロフィール画像:
<label class="update-profImg">
  <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
  <input type="file" name="myPic" class="input-file">
  <img src="" alt="" class="jsprev-profImg">

  <figure class="db-img">
    <img src="{{ asset('storage/profile_images/' . $user->my_pic) }}" width="100px" height="auto">
  </figure>

  ドラッグ＆ドロップ
</label>
