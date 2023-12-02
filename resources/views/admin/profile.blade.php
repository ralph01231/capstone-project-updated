@extends('layouts.app')


@section('header')

@section('title')  @endsection

@endsection

@section('content')

    <div class="d-flex" id="wrapper">

        @include('layouts.admin_sidebar')
        <!-- Sidebar -->
        {{-- <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fa-solid fa-user-tie"></i> Admin Panel</div>
            <div class="list-group list-group-flush my-3">
                <a href="{{route('home')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>

                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-list-check"></i> Content Management
                </a>

                <a href="activerequest.html"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-hospital-user"></i> Active Request
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-house-circle-check"></i> Accepted Request
                </a>

                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fa-solid fa-file-signature"></i> Master List
                </a>
            </div>
        </div> --}}

        <div id="page-content-wrapper">

            @include('layouts.admin_nav')
            {{-- navigation bar --}}
            {{-- <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Profile</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                                        @csrf

                                        <a class="dropdown-item"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                            type="submit">Logout</a>
                                    </form>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav> --}}

            <div class="container-fluid px-4">
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Mian Christopher Dimatulac</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Edit Profile</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="Name" value=""></div>
                                    
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="enter address line 1" value=""></div>
                                 
                                </div>

                                
                                
                                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>

            <div class="container-fluid px-4">
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        
                        <div class="col-md-6 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Change Password</h4>
                                </div>
                                
                                
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Current Pasword</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                                    <div class="col-md-12"><label class="labels">New Password</label><input type="text" class="form-control" placeholder="enter address line 1" value=""></div>
                                    <div class="col-md-12"><label class="labels">Confirm Password</label><input type="text" class="form-control" placeholder="enter address line 1" value=""></div>
                                </div>
                    
                                
                                
                                <div class="mt-5 text-center"><button class="btn btn-danger profile-button" type="button">Save Profile</button></div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            


            
        </div>
    </div>
@endsection

@section('footer')

@endsection


