@extends('user.master')
@section('content')

                    <div class="container-fluid">
                        <h1 class="mt-4">Category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Interface -> Category</li>
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
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($category as $row)
                                            <tr>
                                                <td>{{ $row->cid }}</td>
                                                <td>{{ $row->cname }}</td>
                                                <td>
                                                    <a class="align-items-center" href="{{ url('edit-category'.$row->cid) }}"><i class="fas fa-edit" color="black"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a class="align-items-center" href="{{ url('delete-category'.$row->cid) }}"><i class="fas fa-trash-alt" color="black"></i></a>
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