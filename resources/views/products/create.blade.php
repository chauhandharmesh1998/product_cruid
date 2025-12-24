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
<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="productname">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="productdesc">Product Description</label>
        {{-- <input type="text" class="form-control" id="name"placeholder="Enter product name"> --}}
        <textarea id="froala-editor" name='description'>{{ old('desc') }}</textarea>
    </div>
    <div class="form-group">
        <label for="product">Product Price</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Enter product Price"
            min="1" value="{{ old('price') }}">
    </div>
    <div class="form-group">
        <label for="productqty">Product Qty</label>
        <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter product qty"
            min="1" value="{{ old('qty') }}">
    </div>
    <div class="form-group">
        <label for="productsku">Product SKU</label>
        <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter product SKU">
    </div>
    <div class="form-group">
        <label for="producttype">Product Type</label>
        <input type="text" class="form-control" id="type" name="type" placeholder="Enter product type">
    </div>
    <div class="form-group">
        <label for="productvendor">Product Vendor</label>
        <input type="text" class="form-control" id="vendor" name='vendor' placeholder="Enter product vendor">
    </div>
    <div class="custom-file">
        <label class="custom-file-label" for="productimg">Product Image</label>
        <input type="file" class="custom-file-input" name="image" id="customFile">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js">
</script>
<script>
    new FroalaEditor("#froala-editor");
</script>
