@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">

    <div class="row">
       
    </div>
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="rounded card">
          <div class="card-body">
            <div class="mb-2 d-flex align-items-center justify-content-between">
               
              <div>
                <img class="wd-80 rounded-circle" src="{{ (!empty($data->photo)) ? url('upload/admin_image/'.$data->photo) : url('upload/no_image.jpg') }}" alt="profile">
                <span class="h4 ms-3">{{ $data->username }}</span>
              </div>
               
            </div>
          
            <div class="mt-3">
              <label class="mb-0 tx-11 fw-bolder text-uppercase">Name:</label>
              <p class="text-muted">{{ $data->name }}</p>
            </div>
            <div class="mt-3">
              <label class="mb-0 tx-11 fw-bolder text-uppercase">Email:</label>
              <p class="text-muted">{{ $data->email }}</p>
            </div>
            <div class="mt-3">
              <label class="mb-0 tx-11 fw-bolder text-uppercase">Phone:</label>
              <p class="text-muted">{{ $data->phone }}</p>
            </div>
            <div class="mt-3">
              <label class="mb-0 tx-11 fw-bolder text-uppercase">Address:</label>
              <p class="text-muted">{{ $data->address }}</p>
            </div>
            <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="border btn btn-icon btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="border btn btn-icon btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="border btn btn-icon btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
           
            <div class="card">
                <div class="card-body">
  
                <h6 class="card-title">Change Password</h6>

            <form class="forms-sample" method="POST" action="{{ route('admin.update.password') }}">
                         @csrf
                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Old Password</label>
                        <input type="password" class="form-control @error('old_password') is-invalid
                           @enderror" name="old_password" id="old_password" autocomplete="off" >
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid
                          @enderror" name="new_password" id="new_password" autocomplete="off" >
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    
                    <div class="mb-3">
                      <label for="exampleInputUsername1" class="form-label">Confirm Password</label>
                      <input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off" >
                      
                  </div>

                     

 
 
 

              
                     
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                     
                </form>
  
                </div>
              </div>
           
        </div>
      </div>
      <!-- middle wrapper end -->
      <!-- right wrapper start -->
       
      <!-- right wrapper end -->
    </div>

        </div>
     


@endsection