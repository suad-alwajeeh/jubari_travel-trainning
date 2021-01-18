@extends('app_layouts.master')
@section('main_content')
<div class="col-12">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item"><a href="/services"> Services</a></li>
              <li class="breadcrumb-item active">Update Servces Services</li>
            </ol>
  </div>
  </br>
  </br>
<div class="content-wrapper">
  <div class="container p-4">


    <!-- /.card-header -->
    <!-- form start -->
    <div class="card card-outline card-info">
      <div class="card-header">
        <h2 class="card-title">
          Update Service page
        </h2>
      </div>
      <div class="card-body">

        <form class="form-horizontal" action="/service/editservice">
          @foreach($service as $item)
          @csrf

          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Service Name :</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="ser_name" id="ser_name" required
                  value="{{$item->ser_name}} ">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Discrption :</label>
              <div class="col-sm-8">
                <textarea type="text" class="form-control" name="discrption" id="discrption" required
                  placeholder=" "> {{$item->discrption}}</textarea>
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-sm-4 col-sm-8">
                <div class="form-check">
                  @if($item->is_active==1)
                  <input type="checkbox" checked class="form-check-input" name="is_active" id="is_active">
                  <label class="form-check-label" for="exampleCheck2">Active</label>
                  @else
                  <input type="checkbox" class="form-check-input" name="is_active" id="is_active">
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
            <a href="{{url('services')}}" class="btn btn-outline-danger so_form_btn">Cancel</a>
            <button type="submit" class="btn btn-outline-primary so_form_btn">Update</button>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection