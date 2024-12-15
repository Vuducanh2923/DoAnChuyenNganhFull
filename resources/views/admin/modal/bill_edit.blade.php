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
    <form action="{{ route('admin.postBillEdit', ['id' => $bill->id]) }}" method="post" class="container" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Tên khách hàng -->
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Tên khách hàng</label>
            <input name="name" type="text" class="form-control" id="formGroupExampleInput2" value="{{ $bill->customer->name ?? 'Chưa có khách hàng' }}" disabled>
        </div>

        <!-- Tổng tiền -->
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Tổng tiền</label>
            <input name="total" type="text" class="form-control" id="formGroupExampleInput2" value="{{ $bill->total }}" disabled>
        </div>

        <!-- Tình trạng đơn hàng -->
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Tình trạng đơn hàng</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="status" type="radio" id="inlineRadio1" value="0" {{ $bill->status == '0' ? "checked" : "" }}>
                <label class="form-check-label" for="inlineRadio1">Đơn hàng mới</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="status" type="radio" id="inlineRadio2" value="1" {{ $bill->status == '1' ? "checked" : "" }}>
                <label class="form-check-label" for="inlineRadio2">Đang giao</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="status" type="radio" id="inlineRadio3" value="2" {{ $bill->status == '2' ? "checked" : "" }}>
                <label class="form-check-label" for="inlineRadio3">Đã giao</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="status" type="radio" id="inlineRadio4" value="3" {{ $bill->status == '3' ? "checked" : "" }}>
                <label class="form-check-label" for="inlineRadio4">Đã hủy</label>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="mt-3">
            <label for="formGroupExampleInput2" class="form-label">Danh sách sản phẩm</label>
            @if ($bill->billDetail && $bill->billDetail->count() > 0)
                <ul class="list-group">
                    @foreach ($bill->billDetail as $detail)
                        <li class="list-group-item">
                            <strong>{{ $detail->product->name }}</strong> - 
                            Số lượng: {{ $detail->quantity }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Không có sản phẩm cho đơn hàng này.</p>
            @endif
        </div>

        <!-- Ghi chú (Note) -->
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Ghi chú</label>
            <input name="name" type="text" class="form-control" id="formGroupExampleInput2" value="{{ $bill->note ?? '' }}" disabled>
        </div>

        <!-- Button -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save" aria-hidden="true"></i> Lưu lại
            </button>
            <a href="{{ route('admin.getBillList') }}" class="btn btn-danger">Quay lại</a>
        </div>
    </form>
@endsection