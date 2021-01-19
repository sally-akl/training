@extends('layouts.app')

@section('content')

<!-- ==== Main content ==== -->
<main class="main-content profile-page">
    <div class="container">
        <div class="profile-content">
            <div class="profile-txt">
                <h4>Personal Information</h4>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea </p>
            </div>
            @include("dashboard.utility.error_messages")
            <form method="post" action="{{ url('/') }}/edit" enctype="multipart/form-data">
                @csrf
            <div class="profile-edit-img">
                <div class="profile-photo">
                    <img src="{{url("/")}}<?php echo  Auth::user()->image;  ?>" alt="" class="p_img">
                </div>
                <div class="custom-file">
                    <input type="file" name="profile_img" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" >
                    <label class="custom-file-label" for="inputGroupFile01"><i class="fas fa-camera"></i></label>
                </div>
            </div>
            <div class="profile-edit-info">

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo  Auth::user()->name;  ?>">
                        <i class="far fa-user"></i>
                      </div>
                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input type="email" class="form-control" id="Email"  name="email" value="<?php echo  Auth::user()->email;  ?>">
                      <i class="fas fa-at"></i>
                    </div>
                    <div class="form-group">
                      <label for="Password1">New Password</label>
                      <input type="password" class="form-control" id="Password1" name="password">
                      <i class="fas fa-unlock-alt"></i>
                    </div>
                    <div class="form-group">
                        <label for="Password2">Confirm New Password </label>
                        <input type="password" class="form-control" id="Password2" name="password_confirmation">
                        <i class="fas fa-unlock-alt"></i>
                      </div>
                    <div class="form-group text-center mt-5">
                       <button type="submit" class="main-btn mr-4">Update</button>
                       <button type="submit" class="sec-btn">Cancel</button>
                    </div>

            </div>
              </form>
        </div>
    </div>
</main>
@endsection
@section('footerjscontent')
<script type="text/javascript">

$(".custom-file-input").change(function(e){
  const file = e.target.files[0];
  $(".p_img").attr("src",URL.createObjectURL(file));
});

</script>
@endsection
