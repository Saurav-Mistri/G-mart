@extends('user.master')
@section('content')

    <div class="container-fluid">
        <h1 class="mt-4">Quantity</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Interface -> Product - Master -> Quantity</li>
        </ol>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Update Quantity</h3>
                        </div>
                        <div class="card-body">
                            @include('includes.flash_msg')
                            <form action="{{ url('edit-product-image' . $product->pid) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Product Image</label>
                                    <input class="form-control py-4" id="inputEmailAddress" name="pname" type="text"
                                        placeholder="Enter Product Name" value="{{ $product->pname }}" autofocus
                                        disabled />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Product Image</label>
                                    @foreach (json_decode($product->pimg) as $img)
                                        <style>
                                            img {
                                                border-radius: 10%;
                                            }

                                        </style>
                                        <img src="files/{{ $img }}" width="50px">
                                    @endforeach
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small"></a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
