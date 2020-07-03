import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import ArticleTagsInput from './components/ArticleTagsInput'
import FollowButton from './components/FollowButton'
import ProfEditButton from './components/ProfEditButton.vue'

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    ArticleTagsInput,
    FollowButton,
    ProfEditButton,
  }
})

// 画像ライブプレビュー
      //drag&dropするエリアのドム
      var $dropArea = $('.update-profImg');
      //prev画面のドム
      var $fileInput = $('.input-file');

      $dropArea.on('dragover', function(e) {
        //余計なイベントをキャンセルする
        e.stopPropagation();
        e.preventDefault();
        $(this).css('border', '3px #ccc dashed');
      });
      $dropArea.on('dragleave', function(e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).css('border', 'none');
      });

      //画像情報が入って(changeしたら)きたら
      $fileInput.on('change', function(e) {
        $dropArea.css('border', 'none');
        $('.js__toggle__disabled').prop('disabled', false);
        // 2. files配列にファイルが入っています
        //ファイル情報を取得
        var file = this.files[0],
        //input要素と兄弟の中のクラス属性prev-imgを取得
        $img = $(this).siblings('.jsprev-profImg'),
        // 3. jQueryのsiblingsメソッドで兄弟のimgを取得
        //4. ファイルを読み込むFileReaderオブジェクトを変数に
        fileReader = new FileReader();

        // 5. 読み込みが完了した際のイベントハンドラ。imgのsrcにデータをセット
        //fileReaderの読み込みが完了した時のイベント
        fileReader.onload = function(event) {
          // 読み込んだデータをimgに設定
          //最初非表示になってるimgを表示
          $img.attr('src', event.target.result).show();

        };

        // 6. 画像ファイル自体をデータURLとして読み込んでいる（画像のsrcへ挿入）
        fileReader.readAsDataURL(file);

      });

//メッセージ機能
      async function message() {
        const messages = JSON.parse($('.messages').val());
    
        let content = "";
        messages.forEach(msg => {
            let user_icon = $('.sender_icon').val();
            let user_name = $('.sender_name').val();
            if (msg.user_id == $('.recipient_id').val()) {
                user_icon = $('.recipient_icon').val();
                user_name = $('.recipient_name').val();
            }
            const val = {
                'message': msg,
                'user_icon': user_icon,
                'user_name': user_name
            }
                content += tag(val)
        });
    
        $('.msgArea').html(content);
    }
    
    message();
    
    
    $('.btn').on('click', function () {
        async function submit() {
            const params = {
                msg: $('.form-control').val(),
                board_id: $('.board_id').val(),
                user_id: $('.user_id').val(),
            }
    
            await axios.post(`/boards/${params.board_id}/messages`, params)
                .then(res => {
                    const content = tag(res.data);
                    $('.msgArea').append(content);
                    $('.form-control').val('');
                })
                .catch(e => {
                    alert(e.response);
                });
        }
    
        submit();
    })
    
    function tag(val) {
        return `<li class="mb-3 p-3">
    <div class="container row">
    <div class="col-3">
    　<img src="/storage/icon/${val.user_icon}" alt="icon" class="icon rounded-circle img-fluid">
    　<p class="user_name">${val.user_name}</p>
    </div>
    <div class="col-9 baloon">
    　<p class="content says">${val.message.msg}</p>
    </div>
    <div class="col-12 text-left p-0">
    　<p class="date">${val.message.created_at}</p>
    </div>
                </li>`;
    }