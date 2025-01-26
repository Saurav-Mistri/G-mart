@extends('user.master')
@section('content')

                    <div class="container-fluid">
                        <h1 class="mt-4">Sub-category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Interface -> Sub-category</li>
                        </ol>
                        <div class="container">
                            <div class="row justify-content-left">
                                <div class="col-lg-12">
                                    <div class="card border-0 rounded-lg mt-2">
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Sub-ategory</h3></div>
                                        <div class="card-body">
                                            @include('includes.flash_msg')
                                            <form action="{{ route('user.product.image.imageinsert') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="small mb-1">Select Product</label>
                                                    <select name="pid" class="form-control">
                                                    @foreach($pro as $row)
                                                          <option value="{{ $row->pid }}">{{ $row->pid }}  {{ $row->pname }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">Sub-category Name</label>
                                                    <input class="form-control" id="inputEmailAddress" name="pimg" type="file" placeholder="Choose file" required />
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