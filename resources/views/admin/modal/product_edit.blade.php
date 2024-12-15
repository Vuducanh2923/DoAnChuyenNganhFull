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
<form action="{{route('admin.postProductEdit',['id'=> $product->id ])}}" method="post" class="container" enctype="multipart/form-data">
    @csrf
    @method('PUT')
                <div class="mb-3 me-2 bp-4">
                          <label for="formGroupExampleInput2" class="form-label">Name </label>
                          <input name="name" type="text" class="form-control" id="formGroupExampleInput2" placeholder="name" value="{{ isset($product)?$product->name: "" }}">
                        </div>
                        @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
                      <div class="mb-3">
                          <label for="formGroupExampleInput" class="form-label" >description </label>
                          <input name="description" type="text" class="form-control" id="formGroupExampleInput" placeholder="description" value="{{ isset($product)?$product->description: "" }}">
                        </div>
                        @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              {{-- // --}}
              <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label" >unit_price </label>
                <input name="unit_price" type="text" class="form-control" id="formGroupExampleInput" placeholder="description" value="{{ isset($product)?$product->unit_price: "" }}">
              </div>
              @error('unit_price')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    {{-- // --}}
    <div class="mb-3">
      <label for="formGroupExampleInput" class="form-label" >promotion_price </label>
      <input name="promotion_price" type="text" class="form-control" id="formGroupExampleInput" placeholder="description" value="{{ isset($product)?$product->promotion_price: "" }}">
    </div>
    @error('promotion_price')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
              <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">loại bánh</label>
                <select class="form-select" name="id_type" aria-label="Default select example">
                  <option value="">Chọn loại bánh</option>
                  @foreach ($type_products as $key => $type_product)
                  <option value="{{$type_product->id}}" {{$type_product->id==$product->id_type?"selected":""}}>{{$type_product->name}}</option>
                  @endforeach
                </select>
              </div>      

              <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">đóng gói</label>
                <select name="unit"  class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                  <option value="">Chọn kiểu đóng gói</option>
                
                  <option value="hộp" {{$product->unit=='hộp'?"selected":""}}>hộp</option>
                  <option value="cái" {{$product->unit=='cái'?"selected":""}}>cái</option>
                 
                </select>
              </div>      
                        
              
              
              
              <div class="form-group">
                  <label for="exampleFormControlFile1">Hình ảnh</label>
                  <img src="/source/image/product/{{$product->image}}" alt="{{$product->image}}" height="200" width="" id="img" style="padding: 20px;">
                  <input name="image" type="file" class="form-control-file" id="input" value="{{ isset($product)?$product->image: "" }}" style=" ">
                </div>
                @error('image')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Lưa lại</button>
              <a href="{{route('admin.getProductList')}}" class="btn btn-danger">Quay lại</a>

                
           
            
            <!-- Modal footer -->
           
         
  </form>
  <script>
    let img = document.getElementById('img');
    let input = document.getElementById('input');

    input.onchange = (e) => {
        if (input.files[0])
        img.src = URL.createObjectURL(input.files[0]);
    };
 </script> 
@endsection