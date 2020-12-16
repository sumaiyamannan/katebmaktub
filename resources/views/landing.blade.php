@extends('layouts.master')

@section('content')

    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron my-4">
            <h1 class="display-3">Authors in WikiArabia</h1>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <a href="/admin/dashboard" class="btn btn-primary btn-lg">Add New Author</a>

        </header>

        <!-- Search Bar -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Search123</div>
                    <div class="card-body">
                        <form action="{{ route('search') }}" method="GET">
                            @csrf
                            <input type="text" name="query" class="form-control" />
                            <input type="submit" class="btn btn-sm btn-primary" value="Search" style="margin-top: 10px;" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Features -->
        <div class="row text-center">
            @foreach ($authors as $author)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="{{$author->author_image}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">{{ $author->first_name }} {{ $author->last_name }}</h4>
                            <p class="card-text">{{ Str::limit($author->body, 200) }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="/authors/{{ $author->id }}" class="btn btn-primary">Find Out More!</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
@endsection
