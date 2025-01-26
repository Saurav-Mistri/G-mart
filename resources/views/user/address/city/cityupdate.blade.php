@extends('user.master')
@section('content')

                    <div class="container-fluid">
                        <h1 class="mt-4">City</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Interface -> City</li>
                        </ol>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="card border-0 rounded-lg mt-5">
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Update City</h3></div>
                                        <div class="card-body">
                                            @include('includes.flash_msg')
                                            <form action="{{ url('update-city'.$city->cityid) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class=" form-control-label">Select Category</label>
                                                    <select name="stateid" class="form-control">
                                                    @foreach($state as $r)
                                                          <option value="{{ $r->stateid }}">{{ $r->statename }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">City Name</label>
                                                    <input class="form-control py-4" id="inputEmailAddress" name="cityname" type="text" placeholder="Update City" value="{{ $city->cityname }}" required />
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