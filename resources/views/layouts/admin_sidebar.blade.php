<div id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
            class="fa-solid fa-user-tie"></i> {{ Auth::user()->usertype }}</div>
    <div class="list-group list-group-flush my-3">
        <a href="{{route('admin_dashboard')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>

        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fa-solid fa-list-check"></i> Content Management
        </a>

        <a href="activerequest.html"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fa-solid fa-hospital-user"></i> Active Request
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fa-solid fa-house-circle-check"></i> Accepted Request
        </a>

        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
            <i class="fa-solid fa-file-signature"></i> Master List
        </a>
    </div>
</div>
