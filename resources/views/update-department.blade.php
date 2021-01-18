@extends('app_layouts.master')
@section('main_content')


<div class="col-12">
            <ol class="breadcrumb float-sm-right bg-white">
              <li class="breadcrumb-item"><a href="/department">Department</a></li>
              <li class="breadcrumb-item active">Update Department </li>
            </ol>
  </div>
  </br>
  </br>
<div class="container">

   
    <div class="row  card  w-50  justify-content-center mx-auto  m-5">
        <!-- left column -->
        <div class="card-header">
            <h3 class="card-title text-center">Update DEPARTMENT</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="/department/editdepartment">
            @csrf
            @foreach($dept as $depts)
            <div class="card-body">
                <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">Department Name :</label>
                    <div class="col-sm-8">
      <input type="text" hidden=hidden  value="{{$depts->id}}" class="form-control" id="email" placeholder="Enter email" name="id">

                        <input type="text" class="form-control" name="name" required value="{{$depts->name}}">
                    </div>
                </div>
              
                <div class="form-group row">
                    <div class="offset-sm-4 col-sm-8">
                        <div class="form-check">
                        @if($depts->is_active==1)
                            <input type="checkbox" checked  class="form-check-input" name="is_active" id="is_active">
                            <label class="form-check-label" for="exampleCheck2">Active</label>
                        @else
                        <input type="checkbox"   class="form-check-input" name="is_active" id="is_active">
                            <label class="form-check-label" for="exampleCheck2">Active</label>
                       
                        @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /.card-body -->
            <div class="">
                <a href="{{url('department')}}" class="btn btn-default float-left col-3 m-3 p-2">Cancel</a>
                <button type="submit" class="btn btncolor float-right col-3 m-3 p-2">Update</button>
           
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</div>

@endsection