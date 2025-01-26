@extends('user.master')
@section('content')

                    <div class="container-fluid">
                        <h1 class="mt-4">State</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Interface -> State</li>
                        </ol>
                        <div class="container">
                            <div class="row justify-content-left">
                                <div class="col-lg-12">
                                    <div class="card border-0 rounded-lg mt-2">
                                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Add State</h3></div>
                                        <div class="card-body">
                                            @include('includes.flash_msg')
                                            <form action="{{ route('user.address.state.stateinsert') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="small mb-1">Select Country</label>
                                                    <select name="countryid" class="form-control">
                                                    @foreach($country as $row)
                                                          <option value="{{ $row->countryid }}">{{ $row->countryname }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">State Name</label>
                                                    <input class="form-control py-4" id="inputEmailAddress" name="statename" type="text" placeholder="Enter State" autofocus required />
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