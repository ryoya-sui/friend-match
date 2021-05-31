<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Socialite;
use App\User;

class TwitterController extends Controller
{
    //twitter認証へリダイレクト
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    //twitterからユーザー情報受け取る
    public function  handleProviderCallback()
    {
        try {
            $oauth_user = Socialite::driver('twitter')->user();
        } catch (Exeption $e){
            return redirect('/');
        }


        $user = $this->findOrCreateUser($oauth_user);
        Auth::login($user);
        return redirect()->route('home');
    }

    //新規登録またはユーザーログイン
    public function findOrCreateUser($oauth_user)
    {
        //新規登録かログインなのかを判定する
        $user =  User::where('twitter_id', $oauth_user->id)->first();
        $avatar_name = $oauth_user->avatar != null ? basename($oauth_user->avatar) : '';
        
        //ログインユーザーの場合
        if (!is_null($user)) {
            //ユーザー名の変更があれば変更
            $user->name = $oauth_user->name;
            $user->save();
            return $user;
        }

        //新規登録の場合
        if (!empty($avatar_name)) {
            $this->imgUpload($oauth_user->avatar);
        }

        $new_user = User::create([
            'name' => $oauth_user->name,
            'img_name' => $avatar_name, 
            'twitter_id' => $oauth_user->id,
        ]);

        return $new_user;
    }

    //画像のアプロ-ド
    public function imgUpload($avatar)
    {
        $file_name = basename($avatar);
        $img = Image::make(file_get_contents($avatar));
        return $img->resize(400, 400)->save(storage_path() . '/app/public/images/' . $file_name);
    }
}
