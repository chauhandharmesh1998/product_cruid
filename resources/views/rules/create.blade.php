@include('navbar')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('rule.store') }}">
    @csrf

    <div class="form-group">
        <label>Rule Name</label>
        <input type="text" name="rule_name" class="form-control">
    </div>

    <div id="conditions-wrapper">
        <div class="row mb-2 condition-row">
            <div class="col-md-4">
                <select name="conditions[0][field]" class="form-control">
                    <option value="product_type">Type</option>
                    <option value="product_sku">SKU</option>
                    <option value="product_vendor">Vendor</option>
                    <option value="product_price">Price</option>
                    <option value="product_qty">Qty</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="conditions[0][operator]" class="form-control">
                    <option value="==">==</option>
                    <option value=">">></option>
                    <option value="<">
                        << /option>
                </select>
            </div>

            <div class="col-md-3">
                <input type="text" name="conditions[0][value]" class="form-control">
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-condition">X</button>
            </div>
        </div>
    </div>

    <button type="button" id="add-condition" class="btn btn-secondary mb-3">
        + Add Condition
    </button>

    <div class="form-group">
        <label>Apply Tags (comma separated)</label>
        <input type="text" name="apply_tags" class="form-control">
    </div>

    <button class="btn btn-primary">Save Rule</button>
</form>
<script>
    let index = 1;

    $('#add-condition').click(function() {
        $('#conditions-wrapper').append(`
        <div class="row mb-2 condition-row">
            <div class="col-md-4">
                <select name="conditions[${index}][field]" class="form-control">
                    <option value="product_type">Type</option>
                    <option value="product_sku">SKU</option>
                    <option value="product_vendor">Vendor</option>
                    <option value="product_price">Price</option>
                    <option value="product_qty">Qty</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="conditions[${index}][operator]" class="form-control">
                    <option value="==">==</option>
                    <option value=">">></option>
                    <option value="<"><</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="conditions[${index}][value]" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-condition">X</button>
            </div>
        </div>
    `);
        index++;
    });

    $(document).on('click', '.remove-condition', function() {
        $(this).closest('.condition-row').remove();
    });
</script>
