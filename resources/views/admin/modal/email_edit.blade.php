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
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


@endsection
@section('content')
<form action="{{route('admin.postEmailEdit',['id'=> $emails->id ])}}" method="post" class="container" enctype="multipart/form-data">
    @csrf
    @method('PUT')

                <div class="mb-3 me-2  bp-5">
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Name </label>
                    <input name="name" type="text" class="form-control" id="formGroupExampleInput2" value="{{$emails->name}}" disabled="" >
                  </div>
                  
        
     
                        <div>
                          <label for="formGroupExampleInput2" class="form-label">tình trạng liên hệ </label>
                          
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="status" type="radio"  id="inlineRadio1" value="0" {{$emails->status=='0'?"checked":""}}>
                            <label class="form-check-label" for="inlineRadio1"> <span class="badge badge-info">đã liên hệ </span></label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" name="status" type="radio"  id="inlineRadio2" value="1" {{$emails->status=='1'?"checked":""}}>
                            <label class="form-check-label" for="inlineRadio2">
                              <span class="badge badge-warning">chưa liên hệ</span>


                            </label>
                          </div>

                         
                         
                        </div>
                      
                     
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Lưa lại</button>
                        <a href="{{route('admin.getEmailList')}}" class="btn btn-danger">Quay lại</a>

                
            </div>
            
            <!-- Modal footer -->
           
         
  </form>
@endsection