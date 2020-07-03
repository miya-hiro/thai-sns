<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['articles.user', 'articles.likes', 'articles.tags']);

        // $mypic = Auth::user()->my_pic;

        $articles = $user->articles->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            // 'name' => $user->name,
            // 'mypic' => $user->my_pic,
            'articles' => $articles,
        ]);
    }

    public function edit(string $name)
    {
        // $user = User::where('name', $name)->first();
        $user = Auth::user();

      //  $mypic = $user->my_pic;

        // $is_image = false;

        // if($mypic) {
        //     $is_image = true;
        // }

        return view('users.edit', 
        ['user' => $user
         ]
    );
    }

    public function update(UpdateAdminRequest $request, $name)
    {

       // dd($request->name);
     $basedata = User::where('name', $name)->first();

     $form = $request->all();
      //  dd($form->name);

    //  $user->name = $request->name;
    //  $user->email = $basedata->email;

     if($request->myPic) {
        $filepath = $request->myPic->storeAs('public/profile_images', Auth::id() . date("YmdHis"). '.jpg');

        $request->myPic = basename($filepath);

        $basedata->my_pic = $request->myPic;
        }

        $basedata->name = $request->name;
        $basedata->profile =  $request->profile;
        $basedata->save();

        $user = User::find($basedata->id);

        $articles = $basedata->articles->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['articles.user', 'articles.likes', 'articles.tags']);
 
        $articles = $user->likes->sortByDesc('created_at');
 
        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }
    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followings.followers');
 
        $followings = $user->followings->sortByDesc('created_at');
 
        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }
    
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followers.followers');
 
        $followers = $user->followers->sortByDesc('created_at');
 
        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }
        public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
 
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
 
        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
 
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        $request->user()->followings()->detach($user);
 
        return ['name' => $name];
    }
    
}
