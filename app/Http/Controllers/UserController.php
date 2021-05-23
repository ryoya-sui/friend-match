<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserInfoRequest;
use App\User;

class UserController extends Controller
{
    //プロフィール画面
    public function show()
    {
        $user = User::findOrFail(Auth::id());
        return view('users.show', compact('user'));
    }

    //プロフィール変更画面
    public function edit()
    {
        $user = User::findOrFail(Auth::id());
        return view('users.edit', compact('user'));
    }


    //プロフィールの変更
    public function update(UserInfoRequest $request) 
    {
        //ユーザー情報の取得
        $user = User::findOrFail(Auth::id());

        //画像アップロード処理
        if (!is_null($request->img_name)) {
            $extension = $request->img_name->extension();
            $img_name = uniqid(mt_rand()) . '.' . $extension;
            $img = Image::make($request->file('img_name')->getRealPath());
            $img->resize(400,400)->save(storage_path() . '/app/public/images/' . $img_name);
            if ($user->img_name) {
                //前の画像を削除
                Storage::delete('public/images/' . $user->img_name);
            }
            $user->img_name = $img_name;
        }

        //プロフィール内容の変更
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->self_introduction = $request->self_introduction;
        $user->save();

        //ホーム画面にリダイレクト
        return redirect()->route('users.show');
    }


}