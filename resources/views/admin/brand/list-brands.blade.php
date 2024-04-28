@extends('admin.layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">
@endsection
@section('content-wrapper')
<div class="page-header d-none">
    <h3 class="page-title"> Form elements </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form elements</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="order-listing" class="dataTable entrance-dataTable table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script async src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script async src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
<script async src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.entrance-dataTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': '{{ url("api/admin/brandlist") }}/',
            },
            'columns': [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'slug'
                },
                {
                    data: 'action'
                },
            ],
            'success': function(response) {
                console.log('work')
            }
        });

    });



    $('.dataTable').css('width', '100%')
</script>
<!-- https://code.jquery.com/jquery-3.7.1.js -->
@endsection