@extends('app_layouts.master')

@section('main_content')
<!-- <div class="text-center"> hhhhhhhhhhhhhhhhhhhhhhhhh</div> -->
<div class="content-wrapper" >

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">

  
                    <ul class="users">
                    <li class="user" id="0"> 
                @foreach($group as $gg)
                @if($gg->unreadgroup)

                    <span style="" class="pending gm"> {{ $gg->unreadgroup }}</span>
                    @else
    <span style="" class="pending gm"> 0</span>

    @endif
   
    @endforeach
    

                    <div class="media">
                                    <div class="media-left">
                                        <img src="{{asset('assets/img/logo.png')}}" class="thumbnail" alt="" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name">Group Chat</p>
                                    </div>
                                </div>
                    
                    </li>

                        @foreach($users as $user)

                            <li class="user" id="{{ $user->id }}">
                                {{--will show unread count notification--}}
                                @if($user->unread)
                                    <span class="pending">{{ $user->unread }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-left">
                                        <img src="{{asset('img/users/'.$user->emp_photo)}}" class="thumbnail" alt="" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $user->name }}</p>
                                        <p class="email">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
    </div>
@endsection
