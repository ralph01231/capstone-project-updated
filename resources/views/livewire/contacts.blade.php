<div>
    @include('livewire.contactsmodals')
    <div class="container">
        <div class="row">
            <div class="col-md-12">


                @if(session('success'))
                <script>
                    toastr.success('{{ session('
                        success ') }}');
                </script>
                @endif


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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->hotlines_id }}</td>
                                <td>{{ $contact->hotlines_number }}</td>
                                <td>{{ $contact->userfrom}}</td>
                                <td>{{ $contact->responder_name }}</td>
                                <td>
                                    <li class="nav-item dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0)" class="text-success dropdown-item" data-bs-toggle="modal" data-bs-target="#updateContactModal" wire:click="editContact({{$contact->hotlines_id}})" >
                                                <i class="bi bi-pencil-square w-2"></i>
                                                Edit
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteContactModal" wire:click="deleteContact({{$contact->hotlines_id}})">
                                                <i class="bi bi-trash3 w-2"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </li>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Record Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#hotline-table').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": 4
            }]
        });
    });
</script>