@extends('user.master')
@section('content')

                    <div class="container-fluid">
                        <h1 class="mt-4">Product</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Interface -> Product</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable
                            </div>
                            <div class="card-body">
                                @include('includes.flash_msg')
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product-ID</th>
                                                <th>Product-Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product-ID</th>
                                                <th>Product-Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($ps as $row)
                                            <tr align="centery">
                                                <td>{{ $row->pimgid }}</td>
                                                <td>{{ $row->pid }}</td>
                                                <td>{{ $row->pname }}</td>
                                                <td>
                                                    <style> img{border-radius:10%;}</style>
                                                    <img src="{{url('/files/'.$row->pimg) }}" width="50px">
                                                </td>
                                                <td>
                                                    <a class="align-items-center" href="{{ url('edit-image'.$row->pimgid) }}"><i class="fas fa-edit" color="black"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a class="align-items-center" onclick="return confirm('Are you sure?')" href="{{ url('delete-image'.$row->pimgid) }}"><i class="fas fa-trash-alt" color="black"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection