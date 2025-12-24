@include('navbar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column1">
            <div class="col-md-12">

                <div class="card shadow-sm">

                    {{-- Header --}}
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Product List</h4>
                        <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">
                            + Add Product
                        </a>
                    </div>

                    {{-- Table --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle" id="users-table">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Type</th>
                                        <th class="text-right">Price</th>
                                        <th>SKU</th>
                                        <th class="text-center">Qty</th>
                                        <th>Tags</th>
                                        <th>Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Card */
    .card {
        border-radius: 10px;
        border: none;
    }

    /* DataTable Header */
    table.dataTable thead th {
        vertical-align: middle;
        font-size: 14px;
    }

    /* Search input */
    .dataTables_filter input {
        border-radius: 20px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
    }

    /* Length select */
    .dataTables_length select {
        border-radius: 20px;
        padding: 4px 10px;
    }

    /* Pagination */
    .dataTables_paginate .paginate_button {
        border-radius: 50% !important;
        margin: 0 3px;
    }

    /* Action buttons */
    .btn-sm {
        padding: 4px 10px;
        font-size: 12px;
    }

    table.dataTable tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Center sorting icons */
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before {
        bottom: .5em;
    }

    .product-thumb {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #dee2e6;
    }
</style>
<script src="//cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.datatable') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: false
                },
                {
                    data: 'type',
                    name: 'type',
                    orderable: false
                },
                {
                    data: 'price',
                    name: 'price',
                },
                {
                    data: 'sku',
                    name: 'sku',
                },
                {
                    data: 'qty',
                    name: 'qty',
                },
                {
                    data: 'tags',
                    name: 'tags',
                },
                {
                    data: 'image',
                    name: 'image',
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });
    });
    $(document).on('click', '.delete-btn', function() {
        if (!confirm('Delete product?')) return;

        let id = $(this).data('id');

        $.ajax({
            url: "/product/" + id,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function() {
                $('#users-table').DataTable().ajax.reload();
            }
        });
    });
</script>
