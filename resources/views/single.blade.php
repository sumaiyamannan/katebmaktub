@extends('layouts.master')

@section('content')

    <div class="container">

        <!-- Heading Row -->
        <div class="row align-items-center my-5">
            <div class="col-lg-7">
                <img class="img-fluid rounded mb-4 mb-lg-0" src="{{$author->author_image}}" alt="">
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-5">
                <h1 class="font-weight-light">{{ $author->first_name }} {{ $author->last_name }} </h1>
                <p>
                    <strong>ISNI</strong>: {{ $author->ISNI }} <br>
                    <strong>Date of Birth</strong>: {{ $author->date_of_birth }} <br>
                    <strong>Date of Flourish</strong>: {{ $author->date_of_flourish }}

                </p>
                <a class="btn btn-primary" href="#">by  {{ $author->user->name }} </a>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->


        <!-- Content Row -->
        <div class="row  mt-3">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">Biography</h2>
                        <p class="card-text">{{ $author->body }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary btn-sm">More Info</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row  mt-3">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">Career</h2>
                        <p class="card-text">{{ $author->body }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
<p></p>
    </div>




@endsection
