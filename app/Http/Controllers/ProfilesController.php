<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
      // if the user is authed 
      $follows = (auth()->user()) ? 
        // get the authed user following that contains the $user passed in
        auth()->user()->following->contains($user->id) : false;
      //dd($user->like);

      return view('profiles.index', compact('user', 'follows'));
    }

    public function edit(User $user) {
      $this->authorize('update', $user->profile);

      return view('profiles.edit', compact('user'));
    }

    public function update(User $user, Request $request) {
      $this->authorize('update', $user->profile);

      $data = $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'url' => 'url',
        'image' => ''
      ]);

      if($request->image) {
        $imagePath = $request->image->store('profile', 'public');

        $imageArray = ['image' => $imagePath];
      }
      //dd($data);
      auth()->user()->profile()->update(array_merge(
          $data,
          $imageArray ?? []
      ));

      return redirect("/profile/{$user->id}")->with('message', 'Profile updated successfully');
    }
}
