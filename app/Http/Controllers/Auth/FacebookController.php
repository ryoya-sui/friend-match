<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\User;
use Socialite;

class FacebookController extends Controller
{
    //facebookへリダイレクト
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    //facebook情報でログイン
    public function handleProviderCallback()
    {
        $oauth_user = Socialite::driver('facebook')->user();
        $user = $this->findOrCreateUser($oauth_user);
        Auth::login($user);
        return redirect()->route('home');
    }

    
    //新規登録Orログイン
    public function findOrCreateUser($oauth_user)
    {
        //usersテーブルのユーザー情報があるか確認する。
        $user = User::where('facebook_id', $oauth_user->id)->first();

        //user情報があればログイン処理
        if (!is_null($user)) {
            $user->name = $oauth_user->name;
            $user->save();
            return $user;
        }

        $new_user = new User; 
        $new_user->name = $oauth_user->name;
        $new_user->facebook_id = $oauth_user->id;
        $img = file_get_contents($oauth_user->avatar_original);
        if ($img !== false) {
            $file_name = $this->imgUpload($img);
            $new_user->img_name = $file_name;
        }
        
        $new_user->save();
        return $new_user;
    }

    //画像の処理
    public function imgUpload($avatar)
    {
        //ファイル名作成
        $file_name =  uniqid(mt_rand(), true) . '.jpg';
        $img = Image::make($avatar);
        $img->resize(400, 400)->save(storage_path() . '/app/public/images/' . $file_name);
        return $file_name;

    }
}
