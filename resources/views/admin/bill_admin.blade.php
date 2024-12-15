@extends('admin.masters')
@section('css')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Tables - SB Admin</title>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<link href="/source/assets/dest/css/styles1.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Đơn hàng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin</a></li>
            <li class="breadcrumb-item active">Đơn hàng</li>
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
               Danh sách đơn hàng
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>tên người dùng</th>
                            <th>price</th>
                            <th>Pay ment</th>
                            <th>Ngày đặt</th>
                            <th>tình trạng đơn hàng</th>

                            <th>thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Ngày đặt</th>
                            <th>tình trạng đơn hàng</th>
                            <th>thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($bills as $item)
                        <tr>
                            <td>{{$item->id }}</td>
                            <td>{{$item->customer->name }}</td> 
                            <td>{{$item->total }}</td>
                           
                            <td>{{$item->payment }}</td>
                            <td>{{$item->date_order }}</td>
                            <td>
                                @if ($item->status == 0 )
                                    <span class="badge badge-info">đơn hàng mới</span>
                                @elseif($item->status == 1)
                                    <span class="badge badge-warning">đơn hàng đang giao</span>
                                @elseif($item->status == 2)
                                    <span class="badge badge-success">đơn hàng đã giao</span>
                                @elseif($item->status == 3)
                                    <h4 class="badge badge-danger">đơn hàng đã hủy</h4>
                                @endif
                                
                                
                            </td>
                            <td>
                                <div class="col md-3"><a href="{{route('admin.getBillEdit',['id'=> $item->id ])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('admin.getBillDelete',['id'=> $item->id ])}}" onclick="return confirm('bạn có muốn xóa đơn hàng {{$item->id}}');" method="post">
                     
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> </button>
                                      </form> 
                                </div>
                            </td>
                           
                        </tr>

                        
                        @endforeach
                        
                       
                       
                    </tbody>
                </table>
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
@endsection