@extends('layouts.admin.adminlayout')
@section('content')
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-2">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
			{{-- <li class="breadcrumb-item active"><a href="{{ route('category.index')}}">Category</a></li>
			--}}
			{{-- <li class="breadcrumb-item active" aria-current="page">DataTables</li> --}}
		</ol>
	</div>


	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Report</h6>
			</div>
			<div class="table-responsive p-3">
				<table class="table  table-sm align-items-center table-flush table-hover" id="dataTableHover">
					<thead class="thead-light">
						<tr>
							<th>SL #</th>
							<th>Link Hash</th>
							<th>Redirect To</th>
							<th>Today's Visits</th>
							<th>Total Visits</th>
						</tr>
					</thead>

					<tbody>

						<tr>
							<td>1</td>
							<td>
								<textarea class="form-control fcopy" rows="3">{{ url('/go/'.$link->link_hash) }}</textarea>
								
							</td>
							<td>
								<textarea class="form-control fcopy" rows="3">{{ $link->redirect_to }}</textarea>
								
							</td>
							<td>
								{{ $todayVisits->count()}}
							</td>
							<td>
								{{ $totalVisits->count()}}
							</td>
							{{-- <td>
								0
							</td>
							<td>
								<a class="btn btn-outline-primary btn-sm edit"
									href="{{ url('/admin/link/report/'.$row->link_hash)}}"> <i class="fa fa-edit"></i>
								</a>

							</td> --}}
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>


	<div class="col-lg-12">
		<div class="card mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Link List</h6>
			</div>
			<div class="table-responsive p-3">
				<table class="table align-items-center table-flush table-hover" id="dataTableHover">
					<thead class="thead-light">
						<tr>
							<th>SL #</th>
							<th>Ip Address</th>
							<th>User Agent</th>
							<th>Referer</th>
							<th>Time</th>
							{{-- <th>Status</th>
							<th>Actions</th> --}}
						</tr>
					</thead>

					<tbody>
						@foreach ($totalVisits as $key => $row)
						<tr>
							<td>{{ $key +1 }}</td>
							<td>
								{{ $row->ip }}
							</td>
							<td>
								{{ $row->user_agent }}
							</td>
							<td>{{ $row->referer }}</td>
							<td>
								{{
								 
								$row->created_at->diffForHumans()
								}}
							</td>
							
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>




{{-- Add category Modal --}}


<!--  Add category modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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



{{-- Edit category modal

<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('category.update')}}" method="POST">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label>Category Name</label>
						<input type="text" class="form-control" id="e_cat_name" name="cat_name">
						<input type="hidden" name="id" id="e_cat_id">
					</div>
					<div class="form-group">
						<label>Category Slug</label>
						<input type="text" class="form-control" name="cat_slug" id="e_cat_slug">
					</div>
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="is_active" name="is_active" />
						<label class="form-check-label">Set Active</label>
						<small class="form-text text-danger">change status will do later</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update Category</button>
				</div>
			</form>
		</div>
	</div>
</div>
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$('body').on('click','.edit', function(){
              let cat_id=$(this).data('id');
              
              $.get("category/edit/"+cat_id, function(data){
                console.log(data);
                $('#e_cat_name').val(data.cat_name);
                $('#e_cat_slug').val(data.cat_slug);
               
                if(data.is_active == 1)  {
                  $('#is_active').prop('checked', true);
                }

                $('#e_cat_id').val(data.id);
               
                //  $("#modal_body").html(data);
              });
            });
          
</script>

@endsection