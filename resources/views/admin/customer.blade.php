@extends('admin.masters')
@section('css')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Người dùng</title>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<link href="/source/assets/dest/css/styles1.css" rel="stylesheet" />
<link rel="stylesheet" href="/template/admin/fronend/css/style.css">

<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Người dùng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">admin</a></li>
            <li class="breadcrumb-item active">Người dùng</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                @if (session('success'))
		<div class="alert alert-success">
			{{session('success')}}
		</div>
        @endif
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Danh sách người dùng
            </div>
            <div class="card-body">
                <section class="content">

                    <!-- Default box -->
                    <div class="card card-solid">
                      <div class="card-body pb-0">
                        <div class="row">
                            @foreach ($ctms as $item)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                  <div class="card-header text-muted border-bottom-0">
                                    Digital Strategist
                                  </div>
                                  <div class="card-body pt-0">
                                    <div class="row">
                                      <div class="col-7">
                                        <h2 class="lead"><b>{{$item->name}}</b></h2>
                                        <p class="text-muted text-sm"><b>Email: </b> {{$item->email}} </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$item->address}}</li>
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + {{$item->phone_number}}
                                            @if ($item->contact == 0 )
                                            <span class="badge badge-info">chưa liên hệ </span>
                                        @elseif($item->contact == 1)
                                            <span class="badge badge-success">đã liên hệ</span>
                                       
                                        @endif
                                        </li>
                                        </ul>
                                      </div>
                                     
                                    </div>
                                  </div>
                                  <div class="card-footer">
                                    <div class="text-right">
                                      <a href="#" class="btn btn-sm bg-teal">
                                        <i class="fas fa-comments"></i>
                                      </a>
                                      <a href="{{route('admin.getCustomerEdit',['id'=> $item->id ])}}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> Edit Profile
                                      </a>
                                      
                                    </div>
                                    <form action="{{route('admin.getCustomerDelete',['id'=> $item->id ])}}" onclick="return confirm('bạn có muốn xóa người dùng này!');" method="post">
                     
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> </button>
                                      </form> 
                                  </div>
                                </div>
                              </div>
                              
                            @endforeach
                          
                          
                           
                          
                        </div>
                      </div>
                      <!-- /.card-body -->
                      
                      <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
              
                  </section>
               
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/source/assets/dest/js/scripts1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="/source/assets/dest/js/datatables-simple-demo.js"></script>
<script src="/public/template/js/datatables-simple-demo.js"></script>
<script src="/public/template/js/scripts.js"></script>
@endsection