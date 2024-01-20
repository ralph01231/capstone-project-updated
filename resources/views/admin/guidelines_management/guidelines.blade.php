@extends('layouts.app')

@section('header')
@section('title')
@endsection
@endsection

@section('content')
<div class="wrapper">
    {{-- sidebar here --}}
    @include('layouts.admin_sidebar')

    <div class="main">
        @include('layouts.admin_nav')
        {{-- navigation bar --}}

        <main class="content px-3 py-2">
            <div class="container-fluid mt-3">
                <div class="row ">
                    <div class="col-12 text-start">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route('admin_dashboard') }}" class="text-muted"> Dashboard > </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route('users.index') }}" class="text-muted"> User Management </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="mb-3">
                    <h4>Disaster Guidelines</h4>
                </div>
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGuidelinesModal">
                            Add New Guidelines
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="guidelines-table">
                            <thead>
                                <tr>
                                    <th>Guidelines No.</th>
                                    <th>Guidelines Name</th>
                                    <th>Created_at</th>
                                    <th class="no-export text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('admin.guidelines_management.guidelinesModal')

    @endsection

    @section('scripts')

    <script>
        $(document).ready(function() {
            var guidelinesTable = $('#guidelines-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('guidelines.index') }}",
                "columns": [{
                        data: 'guidelines_id',
                        name: 'guidelines_id'
                    },
                    {
                        data: 'guidelines_name',
                        name: 'guidelines_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                        <li class="nav-item dropdown text-center">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="text-success dropdown-item edit-guidelines" data-bs-toggle="modal" data-bs-target="#editGuidelinesModal" data-id="${row.guidelines_id}">
                                    <i class="bi bi-pencil-square w-2"></i>
                                    Edit
                                </a>
                                <a href="#" class="text-danger dropdown-item delete-guidelines" data-id="${row.guidelines_id}">
                                    <i class="bi bi-trash3 w-2"></i>
                                    Delete
                                </a>
                            </div>
                        </li>
                    `;
                        },
                        orderable: false
                    }
                ],
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    }
                ],
                "paging": true,
                "lengthChange": true,
                "dom": '<"d-flex justify-content-between align-items-center mb-5"lB<"d-flex align-items-center">f>t<"d-flex justify-content-end">',
            });

            guidelinesTable.on('xhr.dt', function(e, settings, json, xhr) {
                console.log(json);
            });



            $('#guidelines-table').on('click', '.edit-guidelines', function() {
                var guidelinesId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/guidelines') }}/" + guidelinesId + "/edit",
                    success: function(response) {
                        var guideline = response.data;
                        $('#editGuidelinesModal #guidelines_id').val(guideline.guidelines_id);
                        $('#editGuidelinesModal #guidelines_title').val(guideline.guidelines_name);
                        $('#editGuidelinesModal #disaster_type').val(guideline.disaster_type);
                        $('#editGuidelinesModal #before_headings').val(guideline.before.headings);
                        $('#editGuidelinesModal #before_description').val(guideline.before.description);
                        $('#editGuidelinesModal #during_headings').val(guideline.during.headings);
                        $('#editGuidelinesModal #during_description').val(guideline.during.description);
                        $('#editGuidelinesModal #after_headings').val(guideline.after.headings);
                        $('#editGuidelinesModal #after_description').val(guideline.after.description);
                    },
                    error: function(error) {
                        console.error(error.responseText);
                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#guidelines-table').on('click', '.delete-guidelines', function(e) {
                e.preventDefault();

                var guidelinesId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ route("guidelines.destroy", ["guidelinesID" => "_guidelinesId_"]) }}'.replace('_guidelinesId_', guidelinesId),
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Guidelines have been deleted.',
                                    'success'
                                );

                                var guidelinesTable = $('#guidelines-table').dataTable();
                                guidelinesTable.fnDraw(false);
                            },
                            error: function(error) {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete guidelines.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    @endsection