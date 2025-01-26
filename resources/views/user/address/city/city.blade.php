@extends('user.master')
@section('content')

                    <div class="container-fluid">
                        <h1 class="mt-4">City</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Interface -> City</li>
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
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($city as $row)
                                            <tr>
                                                <td>{{ $row->cityid }}</td>
                                                <td>{{ $row->statename }}</td>
                                                <td>{{ $row->cityname }}</td>
                                                <td>
                                                    <a class="align-items-center" href="{{ url('edit-city'.$row->cityid) }}"><i class="fas fa-edit" color="black"></i></a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a class="align-items-center" href="{{ url('delete-city'.$row->cityid) }}"><i class="fas fa-trash-alt" color="black"></i></a>
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