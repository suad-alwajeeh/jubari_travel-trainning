@extends('app_layouts.master')

@section('main_content')
<!-- <div class="text-center"> hhhhhhhhhhhhhhhhhhhhhhhhh</div> -->
<div class="content-wrapper" >

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">

                    <ul class="users">
                    <li class="groooop" id="0"> 
                    <div class="media">
                                    <div class="media-left">
                                        <img src="{{asset('assets/img/logo.png')}}" class="thumbnail" alt="" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name">Group Chat</p>
                                    </div>
                                </div>
                    
                    </li>

                     <li>
                     <div class="form-group col-md-12 col-sm-12 mb-3">
      <label for="adds_type"> From</label>
     <select class="form-control" name="adds_type" id="fromSelect">
     <option class=""  disabled selected > Select User</option>
     
     @foreach($users as $user)
     <option class="groooop" id="{{$user->id}}"  value="{{$user->id}}"> {{$user->name}}</option>
     @endforeach
     </select>
    </div>
                     </li>

                     <li>
                     <div class="form-group col-md-12 col-sm-12 mb-3">
      <label for="adds_type"> To</label>
     <select class="form-control" name="adds_type" id="toSelect">
     
     </select>
    </div>
                     </li>
                     <li id="test">
                     
                     </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
    </div>


@endsection
