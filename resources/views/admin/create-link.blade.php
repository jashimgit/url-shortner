@extends('layouts.admin.adminlayout')
@section('content')
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-2">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLinkModal" id="#myBtn">
			+ Create Link
		</button>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
		</ol>
	</div>


	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Link List</h6>
			</div>
			<div class="table-responsive p-3">
				<table class="table  table-sm align-items-center table-flush table-hover" id="dataTableHover">
					<thead class="thead-light">
						<tr>
							<th>SL #</th>
							<th>Link Hash</th>
							<th>Redirect To</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($links as $key => $row)
						<tr>
							<td>{{ $key +1 }}</td>
							<td>
								<textarea class="form-control fcopy" rows="3">{{ url('/go/'.$row->link_hash) }}</textarea>
<br>
								<button class="btnCopy btn btn-danger btn-sm" data-url="{{ url('/go/'.$row->link_hash) }}" >Click to Copy</button>
							</td>
							<td>
								<textarea class="form-control fcopy"  rows="3">{{ $row->redirect_to }}</textarea>
								
							</td>
							<td>
								@if ($row->status == 1 )
								<label class="badge badge-success">Active</label>
								@else
								<label class="badge badge-danger"> Inactive </label>
								@endif
							</td>
							<td>
								<a class="btn btn-outline-primary btn-sm edit"
									href="{{ url('/admin/link/report/'.$row->link_hash)}}"> <i class="fa fa-edit"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


 
<div class="modal fade" id="addLinkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Redirect</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ url('/admin/link/create')}}" method="POST">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label>Redirect to</label>
						<input type="text" class="form-control" name="redirect_to" placeholder="Redirect to">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add Url </button>
				</div>
			</form>
		</div>
	</div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(".btnCopy").click(function () {
        var element = $(this).attr("data-url");
        copyToClipboard(element);
});

function copyToClipboard(element) {
	console.log(element);
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(element).select();
    document.execCommand("copy");
    $temp.remove();
}
          
</script>

@endsection