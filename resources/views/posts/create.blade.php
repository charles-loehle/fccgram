@extends('layouts.app')

@section('content')
<div class="container">
	<form method="POST" enctype="multipart/form-data" action="/p">
		@csrf

		<div class="row">
			<div class="col-8 offset">
				<div class="row">
					<h1>Add New Post</h1>
				</div>

				{{-- CAPTION --}}
				<div class="row mb-3">
					<label for="caption" class="col-md-4 col-form-label text-md-end">Post caption</label>
					<div class="col-md-6">
						<input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption">
						@error('caption')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				{{-- IMAGE --}}
				<div class="row mb-3">
					<label for="image" class="col-md-4 col-form-label text-md-end">Image</label>
					<div class="col-md-6">
						<input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="image">
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

