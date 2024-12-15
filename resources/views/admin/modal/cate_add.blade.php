<!doctype html>
<html lang="en">
  <head>
    <title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <form action="{{route('admin.postCateAdd')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Thêm danh mục</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3">
                              <label for="formGroupExampleInput2" class="form-label">Name </label>
                              <input name="name" type="text" class="form-control" id="formGroupExampleInput2" placeholder="name">
                            </div>
                            @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                          <div class="mb-3">
                              <label for="formGroupExampleInput" class="form-label" >description </label>
                              <input name="description" type="text" class="form-control" id="formGroupExampleInput" placeholder="description">
                            </div>
                            @error('description')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                            
                            
                  
                  
                  
                  <div class="form-group">
                      <label for="exampleFormControlFile1">Hình ảnh</label>
                      <img src="" alt="" id="img" height="200" width="" style="padding: 20px">
                      <input name="image" type="file" class="form-control-file" id="input">
                    </div>
                    @error('image')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                            <button type="submit" class="btn btn-primary">Thêm vào</button>
                    
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                
              </div>
            </div>
          </div>
      </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
      let img = document.getElementById('img');
      let input = document.getElementById('input');

      input.onchange = (e) => {
          if (input.files[0])
          img.src = URL.createObjectURL(input.files[0]);
      };
   </script> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>