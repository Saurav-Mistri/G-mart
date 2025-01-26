@extends('user.master');
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Product</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Interface -> Product</li>
    </ol>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card border-0 rounded-lg mt-2">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Insert Product</h3></div>
                        <div class="card-body">
                            <form action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputFirstName">Category</label>
                                            <select name="categoryid" id="sub_category_name" class="form-control formselect required @error('categoryid') is-invalid @enderror" autofocus>
                                                <option value="0" disabled selected>Select Main Category*</option>
                                                    @foreach($category as $row)
                                                          <option value="{{ $row->cid }}">{{ ucfirst($row->cname) }}</option>
                                                    @endforeach
                                                    </select>
                                            @error('categoryid')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Sub-Category</label>
                                            <select name="subcategoryid" id="sub_category" class="form-control @error('subcategoryid') is-invalid @enderror">
                                                
                                                </select>
                                            @error('subcategoryid')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputFirstName">Product Name</label>
                                            <input class="form-control @error('pname') is-invalid @enderror" id="inputFirstName" type="text" name="pname" placeholder="Enter Product name" />
                                            @error('pname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Quantity</label>
                                            <input class="form-control @error('pqty') is-invalid @enderror" id="inputLastName" type="Number" min="1" name="pqty" placeholder="Enter Quantity" min="0"/>
                                            @error('pqty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Quantity Type</label>
                                            <select name="puid" class="form-control @error('puid') is-invalid @enderror">
                                                <option value="0" disabled selected>Select Quantity Type*</option>    
                                                @foreach($punit as $row)
                                                    <option value="{{ $row->puid }}">{{ ucfirst($row->putype) }}</option>
                                                @endforeach
                                                </select>
                                            @error('putype')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputEmailAddress">Product Description</label>
                                    <textarea class="form-control @error('pdesc') is-invalid @enderror" id="inputEmailAddress" name="pdesc" cols="135" rows="3" aria-describedby="emailHelp" autocomplete="off" placeholder="Enter Product Description"></textarea>
                                    @error('pdesc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Product Price</label>
                                            <input class="form-control @error('pprice') is-invalid @enderror" id="inputPassword" type="number" min="0" name="pprice" placeholder="Enter Product Price" />
                                            @error('pprice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-success btn-block">Submit</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function () 
    {
        $('#sub_category_name').on('change', function () 
        {
            let id = $(this).val();
            $('#sub_category').empty();
            $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'GET',
                url: 'CatEdit' + id,
                success: function (response) 
                {
                    var response = JSON.parse(response);
                    console.log(response);   
                    $('#sub_category').empty();
                    $('#sub_category').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
                    response.forEach(element => {
                        $('#sub_category').append(`<option name="subcategoryid" value="${element['id']}">${element['scname']}</option>`);
                    });
                }
            });
        });
    });
</script>
@endsection