@include('navbar')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column1">
            <div class="col-md-12">

                <div class="card shadow-sm">

                    {{-- Header --}}
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Rule List</h4>
                        <a href="{{ route('rule.create') }}" class="btn btn-primary btn-sm">
                            + Add Rule
                        </a>
                    </div>

                    {{-- Table --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Rule Name</th>
                                        <th>Apply Tags</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rules as $rule)
                                        <tr>
                                            <td>{{ $rule->rule_name }}</td>
                                            <td>{{ $rule->apply_tags }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('rule.apply', $rule->id) }}">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">
                                                        Apply Rule
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
                    data: 'product_name',
                    name: 'product_name',
                    orderable: false
                },
                {
                    data: 'product_type',
                    name: 'product_type',
                    orderable: false
                },
                {
                    data: 'product_price',
                    name: 'product_price',
                },
                {
                    data: 'product_sku',
                    name: 'product_sku',
                },
                {
                    data: 'product_qty',
                    name: 'product_qty',
                },
                {
                    data: 'product_tags',
                    name: 'product_tags',
                },
                {
                    data: 'product_image',
                    name: 'product_image',
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
