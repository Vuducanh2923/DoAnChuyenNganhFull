@extends('admin.masters')
@section('css')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Tables - SB Admin</title>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<link href="/source/assets/dest/css/styles1.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

@endsection
@section('content')
<form action="{{route('admin.postUserEdit',['id'=> $user->id ])}}" method="post" class="container" enctype="multipart/form-data">
    @csrf
    @method('PUT')

                <div class="mb-3 me-2  bp-5">
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Name </label>
                    <input name="name" type="text" class="form-control" id="formGroupExampleInput2" value="{{$user->full_name}}" disabled="" >
                  </div>
                  
        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">email </label>
          <input name="name" type="text" class="form-control" id="formGroupExampleInput2" value="{{$user->email}}"disabled="" >
        </div>
       
      <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Address </label>
        <input name="name" type="text" class="form-control" id="formGroupExampleInput2" value="{{$user->address}}"disabled="" >
      </div>

      <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label"><i class="fa fa-phone" aria-hidden="true"></i> </label>
        <input name="name" type="text" class="form-control" id="formGroupExampleInput2" value="{{$user->phone}}"disabled="" >
      </div>

      
                        <div>
                          <label for="formGroupExampleInput2" class="form-label">Quyền hạn </label>
                          
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="level" type="radio"  id="inlineRadio1" value="1" {{$user->level=='1'?"checked":""}}>
                            <label class="form-check-label" for="inlineRadio1"> <span class="badge badge-primary">Admin </span></label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="level" type="radio"  id="inlineRadio2" value="2" {{$user->level=='2'?"checked":""}}>
                            <label class="form-check-label" for="inlineRadio2">
                              <span class="badge badge-success">Kỹ thuật</span>
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="level" type="radio"  id="inlineRadio2" value="3" {{$user->level=='3'?"checked":""}}>
                            <label class="form-check-label" for="inlineRadio2">
                              <span class="badge badge-info">người dùng</span>
                            </label>
                          </div>
                         
                        </div>
                      
                     
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Lưa lại</button>

                        <a href="{{route('admin.getUserList')}}" class="btn btn-danger">Quay lại</a>
                
            </div>
            
            <!-- Modal footer -->
           
         
  </form>
@endsection