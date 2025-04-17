<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    /* Membuat DataTables lebih modern */
    .dataTables_wrapper .dataTables_length, 
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }
    
    .dataTables_wrapper .dataTables_length select {
        min-width: 60px;
        padding: 0.375rem 2.25rem 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5rem;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        border: 1px solid #dee2e6;
    }
    
    .dataTables_wrapper .dataTables_info {
        font-size: 0.875rem;
        padding-top: 1rem;
    }
    
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 1rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.5rem;
        margin: 0 0.25rem;
        border-radius: 0.25rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
        color: white !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e9ecef !important;
        border-color: #dee2e6 !important;
        color: #212529 !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        background: transparent !important;
        border-color: transparent !important;
    }
    
    /* Perbaikan style untuk tooltip pada DataTables */
    .tooltip {
        z-index: 1060;
    }
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                @include('components.admin.sidebar')
            </div>
            <div class="col-lg-9">
                <div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Destroy tooltip before DataTables initialization to prevent conflicts
            $('[data-bs-toggle="tooltip"]').tooltip('dispose');
            
            // Initialize DataTables
            var table = $('#usersTable').DataTable({
                language: {
                    search: "",
                    searchPlaceholder: "Search users...",
                    lengthMenu: "_MENU_ records per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ users",
                    infoEmpty: "Showing 0 to 0 of 0 users",
                    paginate: {
                        first: '<i class="bi bi-chevron-double-left"></i>',
                        previous: '<i class="bi bi-chevron-left"></i>',
                        next: '<i class="bi bi-chevron-right"></i>',
                        last: '<i class="bi bi-chevron-double-right"></i>'
                    }
                },
                pagingType: "full_numbers",
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                pageLength: 10,
                dom: '<"row align-items-center"<"col-md-6"l><"col-md-6"f>>rtip',
                ordering: true,
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: 4 }, // Disable sorting on the Actions column
                    { responsivePriority: 1, targets: [1, 2] }, // NIS and Name have priority
                    { responsivePriority: 2, targets: 3 }, // Role next
                    { responsivePriority: 3, targets: 4 } // Actions last
                ],
                drawCallback: function() {
                    // Reinitialize tooltips after table draw
                    $('[data-bs-toggle="tooltip"]').tooltip();
                },
                initComplete: function() {
                    // Enhance the search box with Bootstrap styling
                    $('.dataTables_filter label').addClass('d-flex align-items-center m-0');
                    $('.dataTables_filter input').addClass('form-control');
                    $('.dataTables_filter input').attr('placeholder', 'Search users...');
                    
                    // Add search icon
                    $('.dataTables_filter label').prepend(
                        '<span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>'
                    );
                    
                    // Enhance the length selector with Bootstrap styling
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                }
            });
            
            // Custom positioning for length and search controls
            $('.dataTables_length').addClass('ps-3');
            $('.dataTables_filter').addClass('pe-3');
        });
        
        // Bootstrap tooltip initialization (for elements outside of DataTables)
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });

        
        
    </script>

</body>
</html>
