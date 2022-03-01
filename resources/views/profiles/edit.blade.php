@extends('layouts.app')

@section('content')
<div class="container">
	<form method="POST" enctype="multipart/form-data" action="/profile/{{ $user->id }}">
		@csrf
		@method('PATCH')

		<div class="row">
			<div class="col-8 offset">
				<div class="row">
					<h1>Edit Your Profile</h1>
				</div>

				{{-- TITLE --}}
				<div class="row mb-3">
					<label for="title" class="col-md-4 col-form-label text-md-end">Profile title</label>
					<div class="col-md-6">
						<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}" autocomplete="title">
						@error('title')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				{{-- DESCRIPTION --}}
				<div class="row mb-3">
					<label for="description" class="col-md-4 col-form-label text-md-end">Profile description</label>
					<div class="col-md-6">
						<input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description }}" autocomplete="description">
						@error('description')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				{{-- URL --}}
				<div class="row mb-3">
					<label for="url" class="col-md-4 col-form-label text-md-end">Profile url</label>
					<div class="col-md-6">
						<input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}" autocomplete="url">
						@error('url')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				{{-- IMAGE --}}
				<div class="row mb-3">
					<label for="image" class="col-md-4 col-form-label text-md-end">Profile Image</label>
					<div class="col-md-6">
						<input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
						@error('image')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
		
				{{-- SUBMIT --}}
				<div class="row mb-0">
					<div class="col-md-6 offset-md-4">
						<button type="submit" class="btn btn-primary">
							Submit
						</button>
					</div>
				</div>
			</div>
		</div>

	</form>
</div>
@endsection

