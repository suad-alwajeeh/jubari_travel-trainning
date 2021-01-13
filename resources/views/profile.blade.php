@extends('app_layouts.master')
@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="container p-4">


<div class="row">
  <!-- /.col -->
  <div class="col-md-12">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      @foreach($data as $item)
      <div class="widget-user-header bg-info">
        <h3 class="widget-user-username">
        {{$item->ef_name}} {{$item->em_name}} {{$item->et_name}} {{$item->l_name}}</h3>
        <h5 class="widget-user-desc">{{$item->dept}}</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{asset('img/users/'.$item->photo)}}" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="row">
        <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">email</h5>
              <span class="description-text">{{$item->email}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">mobile</h5>
              <span class="description-text">{{$item->mobile}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">hirdate</h5>
              <span class="description-text">{{$item->hirdate}}</span>
            </div>
            <!-- /.description-block -->
          </div>
           <!-- /.col -->
           <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">ss number</h5>
              <span class="description-text">{{$item->ssn}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">account number</h5>
              <span class="description-text">{{$item->account}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2">
            <div class="description-block">
              <h5 class="description-header">salary</h5>
              <span class="description-text">{{$item->salary}}</span>
            </div>
            <!-- /.description-block -->
          </div>
           <!-- /.col -->
           <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header"> passwor</h5>
              <span class="description-text">{{$item->pass}}</span>
            </div>
            <!-- /.description-block -->
          </div>
          
          <!-- /.col -->
           <!-- /.col -->
           
          
        </div>
        @endforeach
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  </div>
  </div>
  </div>
  @endsection


