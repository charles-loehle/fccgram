@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img class="w-100 rounded-circle" src="{{ $user->profile->profileImage() }}" alt="">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <h1>{{ $user->username }}</h1>
                    <follow-button 
                        user-id="{{ $user->id }}"
                        follows="{{ $follows }}"
                    ></follow-button>
                </div>
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>

            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit profile</a>
            @endcan
            {{-- STATS --}}
            <div class="d-flex">
              <div class="pe-5">
                <strong>{{ $user->posts->count() }}</strong> posts
              </div>
              <div class="pe-5">
                <strong>{{ $user->profile->followers->count() }}</strong> followers
              </div>
              <div class="pe-5">liked 
                <strong>{{ $user->like->count() }}</strong> post
              </div>
              <div class="pe-5">
                <strong>{{ $user->following->count() }}
                </strong> following
              </div>
            </div>

            <div class="pt-4 fw-bold">
              <a href="#">{{ $user->profile->title }}</a>
            </div>

            <div>
              {{ $user->profile->description }}
            </div>

            <div>
              <a href="#">{{ $user->profile->url }}</a>
            </div>

        </div>
    </div>

    <h2 class="pt-5">My Posts</h2>
    <div class="row">
      @foreach ($user->posts as $post)
        <div class="col-4 pb-4">
          <a href="/p/{{ $post->id }}">
            <img class="w-100" src="/storage/{{ $post->image }}" alt="">
          </a>
        </div>
      @endforeach
    </div>

    <h2 class="pt-5">Posts I Have Liked</h2>
    <div class="row">
      @foreach ($user->like as $likes)
        <div class="col-4 pb-4">
          <a href="/p/{{ $likes->id }}">
            <img class="w-100" src="/storage/{{ $likes->image }}" alt="">
          </a>
        </div>
      @endforeach
    </div>
</div>
@endsection

