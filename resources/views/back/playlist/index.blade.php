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
						<div class="card-title">Data Playlist</div>
                        <a href="{{route('playlist.create')}}" class="btn btn-primary btn-sm ml-auto">Tambah Playlist<a>
					</div>
				</div>
				<div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-primary">
                            {{Session('success')}}
                        </div>
                    @endif
					<div class="table-responsive">
                       <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Judul Playlist</th>
                                <th>Slug</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($playlist as $row )
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->judul_playlist}}</td>
                                <td>{{$row->slug}}</td>
                                <td>{{$row->users->name}}</td>
                                <td>@if( $row->is_active == '1'  )
                                    Active
                                    @else
                                    Draft

                                @endif
                                <td>
                                    <img src="{{asset('uploads/' . $row->gambar_playlist)}}" alt="" width="100">
                                </td>
                                <td>
                                    <a href="{{route('playlist.edit',$row->id)}}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pen"></i>
                                    </a>

                                    <form action="{{route('playlist.destroy',$row->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn  btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </form>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Data Masih Kosong</td>
                            </tr>
                            @endforelse

                        </tbody>
                       </table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
