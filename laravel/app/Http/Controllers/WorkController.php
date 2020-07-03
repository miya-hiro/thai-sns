<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Work;
use App\User;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function showcallender()
    {
        date_default_timezone_set('Asia/Tokyo');
        if (isset($_GET['ym'])) {
            $ym = $_GET['ym'];
        } else {
            // 今月の年月を表示
            $ym = date('Y-m');
        }

        $timestamp = strtotime($ym . '-01');
        // $timestamp = "2020-05-01"
        if ($timestamp === false) {
            $ym = date('Y-m');
            $timestamp = strtotime($ym . '-01');
        }
        $today = date('Y-m-j');
        //$today = "2020-05-27"
        $html_title = date('Y年n月', $timestamp);
        $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
        //$prev = 2020-04
        $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));
       // $next = 2020-06
        $day_count = date('t', $timestamp);
       // $day_count = 31
        $youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
        // $youbi = 5
        $weeks = [];
        $week = '';
        $week .= str_repeat('<td></td>', $youbi -1);
        // 第一引数を第二引数回繰り返す
        for ( $day = 1; $day <= $day_count; $day++, $youbi++) {
        
            // 2017-07-3
            $date = $ym . '-' . $day;
        
            if ($today == $date) {
                // 今日の日付の場合は、class="today"をつける
                $week .= '<td class="today"><input type="checkbox" name="work_days[]" value="'. $date .'">' . $day;
            } else {
                $week .= '<td><input type="checkbox" name="work_days[]" value="'. $date .'">' . $day;
            }
            $week .= '</td>';
        
            // 週終わり、または、月終わりの場合
            if ($youbi % 7 == 0 || $day == $day_count) {

                if ($day == $day_count && $youbi % 7 !=0 ) {
                    // 月の最終日の場合、空セルを追加
                    // 例）最終日が木曜日の場合、金・土曜日の空セルを追加
                    $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
                }
        
                // weeks配列にtrと$weekを追加する
                $weeks[] = '<tr>' . $week . '</tr>';
        
                // weekをリセット
                $week = '';
            }
        }

        $user = Auth::user();
        $user = $user->name;

        return view('users.calender', [
            'weeks' => $weeks,
            'html_title' => $html_title,
            'prev' => $prev,
            'next' => $next,
            'user' => $user
        ]);
    }

    public function storecallender(Request $request, $name)
    {
        $work = '';
        $user = '';
        if(empty($_POST['work_days'])){
            dd('empty');
        } else {
            $work = new Work;

            $work_days = $request->work_days;

            $user = User::where('name', $name)->first();
            $user_id = $user->id;
            foreach($work_days as $day) {
            $work->user_id = $user_id;
            $work->day = $day;
            $work->description = 'test';
            $work->save();
            }
        }
        $user = $user->name;

        return redirect()->route('users.showcallender', [
            'name' => $user
        ]);
    }
}
