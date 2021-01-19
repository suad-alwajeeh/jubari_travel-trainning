@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">
<div class="card card-outline card-info">
            <div class="card-header">
              <h2 class="card-title">edit Supplier page</h2>
              </div>
              <div class="card-body">

<form id="supplier_edit" method="post" action="/edit_supplier"  enctype="multipart/form-data">
<div class="row">
@foreach($data as $item)

    <div class="form-group col-md-6 mb-3">
      <label for="supplier_name">Supplier Name</label>
      <input type="text" value="{{$item->supplier_name}}" class="form-control" id="supplier_name" placeholder="Enter Supplier Name:" name="supplier_name">
    </div>
    <div class="form-group col-md-3 mb-3">
    <label for="supplier_mobile">Mobile</label>
      <input type="number" value="{{$item->supplier_mobile}}"  class="form-control" id="" placeholder="supplier_mobile" name="supplier_mobile">
    </div>
    <div class="form-group col-md-3 mb-3">
    <label for="supplier_phone">Phone</label>
      <input type="number" value="{{$item->supplier_phone}}"  class="form-control" id="supplier_phone" placeholder="supplier_phone" name="supplier_phone">
    </div>
    <div class="form-group mb-3">
      <input type="hidden" value="{{$item->s_no}}"  class="form-control" id="s_no" placeholder="s_no" name="s_no">
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="supplier_address">Address</label>
      <input type="text" value="{{$item->supplier_address}}"  class="form-control" id="supplier_address" placeholder="supplier_address" name="supplier_address">
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_email">Email</label>
      <input type="email" value="{{$item->supplier_email}}"  class="form-control" id="supplier_email" placeholder="supplier_email" name="supplier_email">
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_acc_no">Supplier Account No.</label>
      <input type="number" value="{{$item->supplier_acc_no}}"  class="form-control" id="supplier_acc_no" placeholder="supplier_acc_no" name="supplier_acc_no">
    </div>
    <div class="form-group col-md-6 mb-3">
    <label for="supplier_service">Service</label>

    <select class="form-control col-2   mx-5 d-inline-block select2" name="supplier_service[]" multiple="multiple" id="dropselect" placeholder="select service" style="width: 100%;">
    <option value="" disabled>select Service</option>
    @foreach($sup_ser as $sers)

    <option  value="{{$sers->ser_id}}" selected>{{$sers->ser_name}}</option>
@endforeach
               
@foreach($data1 as $ser)
<option  value="{{$ser->ser_id}}" >{{$ser->ser_name}}</option>

@endforeach
              
                  
                </select>
                </div>
                <div class="form-group col-md-3 mb-3">
      <label for="supplier_currency">Select currency</label>
     <select class="form-control  mx-5 d-inline-block select2" multiple="multiple" name="supplier_currency[]" id="">
     <option value="" disabled>select currency</option>
     @foreach($sup_cur as $sup_cur)

               
                      @foreach($data2 as $cur)

                      @if($sup_cur->cur_id==$cur->cur_id)
                      <option  value="{{$cur->cur_id}}" selected>{{$cur->cur_name}}</option>
@else
<option  value="{{$cur->cur_id}}" >{{$cur->cur_name}}</option>

@endif
                      @endforeach
                      @endforeach
              
                  
                </select>
    <!-- @if($errors->any('is_active'))
      <span class="text-danger">{{$errors->first('is_active')}}</span>
      @endif -->
    </div>
   
    
   
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_remark">Remark</label>
      <textarea class="form-control" name="supplier_remark" id="supplier_remark"> 
      {{$item->supplier_remark}}
      </textarea>
    </div>
    <div class="form-group col-md-3 mb-3">
      <label for="supplier_photo">Photo</label>
     <div class="form-group " data-select2-id="44">
                                    <img id="image1" name="supplier_photo"
                                        style="border:1px solid #CC8B79; width:150px; height:150px" alt=""
                                        height="200px" width="200px" name="main_img" src="{{asset('img/suppliers/'.$item->supplier_photo)}}"
                                        class="img-fluid rounded shadow-sm mx-auto d-block">
         <input type="hidden"  class="form-check-input" name="supplier_photo1" value="{{$item->supplier_photo}}">

                                    <div class="input-group ">
                                        <label for="upload" class=" p-2 mt-3 mx-auto btncolor">Chose Image:</label>
                                        <input id="upload" type="file" name="supplier_photo" onchange="onFilePicked(event)"
                                            accept="image/*" style="display: none;">

                                    </div>
                                </div>
   
   
    </div>
    

    <div class="form-group col-md-12 mb-3">
    <label class="checkbox-inline"><input type="checkbox" name="is_active" checked value="1">   Active</label>
    </div>
    </div>
    </div>
    <div class="card-footer" >
   <a href="/displaySupplier" class="btn btn-outline-danger so_form_btn">cansel</a>
   <button type="submit" class="btn btn-outline-primary so_form_btn">send</button>
    </div> 
    
    @endforeach
</div>
  </form>  
  <script>
    $('#supplier_display1').on('submit',function(e){
         e.preventDefault();
         $.ajax({
             type:'post',
             url:'/addsupplier',
             data:$('#supplier_display1').serialize(),
             success:function(response){console.log(response);
             alert("data saved");
             },
             error:function(error){console.log(error);
             alert("data dont saved");
             } 
         });

    });
    

    function onFilePicked(event) {

const files = event.target.files
console.log(files)
let filename = files[0].name
if (filename.lastIndexOf('.') <= 0) {
    return alert('not image')
}
let filesize = files[0].size
console.log(filesize)

let fileType = files[0].type
console.log(fileType)

if (fileType !== 'image/png') {
    if (fileType !== 'image/jpeg') {
        return alert('image type not supported')
    }
}
const fileReder = new FileReader()
let formData = new FormData()
formData.append('file', files[0])
fileReder.addEventListener('load', () => {
    let dataURI = fileReder.result
    if (dataURI) {
        document.getElementById('image1').src = dataURI

    }
})
fileReder.readAsDataURL(files[0])
console.log(this.image)
}
  </script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

  </div>
  </div>
  @endsection


