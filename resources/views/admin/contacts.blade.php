@extends('layouts.app')

@section('header')

@section('title')
@endsection

@endsection

@section('content')
<div class="wrapper">
    @include('layouts.admin_sidebar')
    @include('hotlineModals.contactsmodals')
    <div class="main">
        @include('layouts.admin_nav')
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-3">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hotline</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12">
                    <div class="data_table table-responsive ">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h4 class="m-0">HOTLINES</h4>
                            <button type="button" class="btn btn-success m-0" data-bs-toggle="modal" data-bs-target="#contactModal">
                                <i class="bi bi-plus-square-fill"></i> ADD
                            </button>
                        </div>
                        <table class="table table-borderd table-striped" id="hotline-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hotlines No.</th>
                                    <th>User From</th>
                                    <th>Posted By</th>
                                    <th class="no-export text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                        <div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var hotlinesTable = $('#hotline-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('hotlines.index') }}",
            "columns": [{
                    data: 'hotlines_id',
                    name: 'hotlines_id'
                },
                {
                    data: 'hotlines_number',
                    name: 'hotlines_number'
                },
                {
                    data: 'userfrom',
                    name: 'userfrom'
                },
                {
                    data: 'responder_name',
                    name: 'responder_name'
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
                                <a href="#" class="text-success dropdown-item edit-hotline" data-bs-toggle="modal" data-bs-target="#updateContactModal" data-id="${row.hotlines_id}">
                                    <i class="bi bi-pencil-square w-2"></i>
                                    Edit
                                </a>
                                <a href="#" class="text-danger dropdown-item delete-hotline" data-id="${row.hotlines_id}">
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

        $('#hotline-table').on('click', '.edit-hotline', function() {
            var hotlineId = $(this).data('id');

            $.ajax({
                type: 'GET',
                url: "{{ url('admin/hotlines') }}/" + hotlineId + "/edit",
                success: function(response) {
                    var hotline = response.data;
                    $('#updateContactModal #hotline_id').val(hotline.hotlines_id);
                    $('#updateContactModal #hotline_number').val(hotline.hotlines_number);
                    $('#updateContactModal #user_from').val(hotline.userfrom);
                    $('#updateContactModal #responder_name').val(hotline.responder_name);
                    $('#updateContactModal #responder_id').val(hotline.responder_id);

                    $('#updateContactModal').modal('show');
                },
                error: function(error) {
                    console.log('Error fetching hotline details:', error);
                }
            });
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#hotline-table').on('click', '.delete-hotline', function(e) {
            e.preventDefault();

            var hotlineId = $(this).data('id');

            // Use SweetAlert for confirmation
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
                    // Perform the delete operation
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ route("hotlines.destroy", ["hotline" => "_hotlineId_"]) }}'.replace('_hotlineId_', hotlineId),
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Hotline has been deleted.',
                                'success'
                            );

                            var oTable = $('#hotline-table').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function(error) {
                            Swal.fire(
                                'Error!',
                                'Failed to delete hotline.',
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