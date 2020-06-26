@extends('layouts.superadmin')

@section('content')


@push('styles')

<style type="text/css">

</style>


@endpush


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 mt-5">
        <h1 class="m-0 text-dark"><i class="fas fa-home mr-3"></i>Available Properties</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Properties</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Property Name</th>
                  <th style="width: 15%">Address</th>
                  <th>City</th>
                  <th>States</th>
                  <th>Images</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($properties as $key=>$property)
                <tr>
                  <td>{{$property->property_name}}</td>
                  <td>{{$property->property_address}}</td>
                  <td>{{$property->city}}</td>
                  <td>{{$property->state}}</td>
                  <td>
                    {{-- image one --}}
                    @if(!is_null($property->property_image))
                    <img src="{{ url('images/'.$property->property_image) }}" alt="Property image one" width="30">
                    @endif
                    @if(!is_null($property->property_image2))
                    <img src="{{ url('images/'.$property->property_image2) }}" alt="Property image two" width="30">
                    @endif
                    @if(!is_null($property->property_image3))
                    <img src="{{ url('images/'.$property->property_image3) }}" alt="Property image three" width="30">
                    @endif
                    @if(!is_null($property->property_image4))
                    <img src="{{ url('images/'.$property->property_image4) }}" alt="Property image four" width="30">
                    @endif
                    @if(!is_null($property->property_image5))
                    <img src="{{ url('images/'.$property->property_image5) }}" alt="Property image five" width="30">
                    @endif
                  </td>
                  <td>{{$property->created_at->diffForHumans() }}</td>
                  <td>
                    <a href="#" data-id="{{$property->id}}" class="btn btn-default resend">
                      <i class="far fa-eye"></i>
                    </a>
                    <p style="font-size: 0.5em; font-weight:600" class="d-inline">View Properties</p>
                    <!-- Delete -->
                    <a href="#" class="btn btn-default delete mr-invite3" data-id="{{$property->id}}">
                      <i class="far fa-eye"></i>
                    </a>
                    <p style="font-size: 0.5em; font-weight:600" class="d-inline">View Projects</p>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->


      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->

@push('script')
<script>
  // Delete Function 
	setInterval(function(){
// Remove Invitation
$(".delete").on("click",function(e){
	e.preventDefault();    
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Remove it!'
	}).then((result) => {
		if (result.value) {
			var id = $(this).data("id");
			console.log("post ID is "+ id);
			var token = $("meta[name='csrf-token']").attr("content");
			$.ajax(
			{
				url: "invite/"+id,
				type: 'DELETE',
				data: {
					"id": id,
					"_token": token,
				},
				success:function(data){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 1500
					})
					.then(() => {
						$('div.flash-message').html(data);
						// window.location.reload();
					})

				},          
				error: function (jqXHR, textStatus, errorThrown) 
				{  
					swal.fire({
						title: "Something error",
						text: "Check input fields!",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
				}
			});
		}
	})
	
});
// Resent Code
$(".resend").on("click" , function(e){
	e.preventDefault();    
	Swal.fire({
		title: 'Are you sure?',
		text: "Resent Invitation to Cleaner!",
		icon: 'info',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Resent!'
	}).then((result) => {
		if (result.value) {
			var id = $(this).data("id");
			console.log("Resent Id is "+ id);
			var token = $("meta[name='csrf-token']").attr("content");
			$.ajax(
			{
				url: "invite/resent/"+id,
				type: 'get',
				data: {
					"id": id,
					"_token": token,
				},
				success:function(data){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Invitation Successfully resent to Cleaner',
						showConfirmButton: false,
						timer: 1500
					})
					.then(() => {
						$('div.flash-message').html(data);
						// window.location.reload();
					})

				},          
				error: function (jqXHR, textStatus, errorThrown) 
				{  
					swal.fire({
						title: "Something error",
						text: "Check input fields!",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
				}
			});
		}
	})
});

},1000);
</script>
@endpush

@endsection