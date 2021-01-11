@extends('app_layouts.master')
@section('main_content')



<div class="container">

   
    <div class="row  card  w-50  justify-content-center mx-auto  m-5">
        <!-- left column -->
        <div class="card-header">
            <h3 class="card-title text-center">Update Service</h3>
        </div>
        <form class="form-horizontal" action="/service/editservice">
        @foreach($service as $item)
            @csrf

            <div class="card-body">
                <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">Service Name :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="ser_name" id="ser_name" required value="{{$item->ser_name}} ">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">Discrption :</label>
                    <div class="col-sm-8">
                        <textarea type="text" class="form-control" name="discrption" id="discrption" required  placeholder=" "> {{$item->discrption}}</textarea>
                    </div>
                </div>
                 
               
                <div class="form-group row">
                    <div class="offset-sm-4 col-sm-8">
                        <div class="form-check">
                        @if($item->is_active==1)
                            <input type="checkbox" checked  class="form-check-input" name="is_active" id="is_active">
                            <label class="form-check-label" for="exampleCheck2">Active</label>
                        @else
                        <input type="checkbox"   class="form-check-input" name="is_acive" id="is_active">
                            <label class="form-check-label" for="exampleCheck2">Active</label>
                       
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            
            <!-- /.card-footer -->
            <input type="hidden" name="id" value="{{$item->ser_id}}" id="id">
         @endforeach
         <div class="">
                <a href="{{url('service_test')}}" class="btn btn-default float-left col-3 m-3 p-2">Cancel</a>
                <button type="submit" class="btn btncolor float-right col-3 m-3 p-2">Update</button>
           
            </div>
        </form> 
    </div>
</div>

@endsection