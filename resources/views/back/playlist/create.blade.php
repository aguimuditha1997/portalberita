@extends('layouts.default')

@section('content')

<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
			</div>
			<div class="ml-md-auto py-2 py-md-0">
				{{-- <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
				<a href="#" class="btn btn-secondary btn-round">Add Customer</a> --}}
			</div>
		</div>
	</div>
</div>
<div class="page-inner mt--5">

	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">Form Playlist Video</div>
                        <a href="{{route('playlist.index')}}" class="btn btn-warning btn-sm ml-auto">Back<a>
					</div>
				</div>
				<div class="card-body">
                    <form method="post" action="{{route('playlist.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Judul">Playlist Video</label>
                            <input type="text" name="judul_playlist" class="form-control" id="text" placeholder="Enter kategori">
                        </div>
                        <div class="form-group">
                            <label for="body">Deskripsi</label>
                            <textarea type="text" name="deskripsi" id="editor" class="form-control"  ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="gambar_playlist">Gambar playlist</label>
                            <input type="file" name="gambar_playlist" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select type="text" name="is_active" class="form-control" id="text">
                                <option value="1">publish</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                            <div class="form-group">
                                 <button class="btn btn-primary btn-sm" type="submit"> save </button>
                                 <button class="btn btn-danger btn-sm" type="reset"> reset </button>
                            </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
