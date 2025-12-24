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
<form action="{{ route('product.update',$product->id) }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Product Name</label>
        <input type="text" class="form-control"
               name="name" value="{{ old('name',$product->name) }}">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea id="froala-editor"
                  name="description">{{ old('description',$product->description) }}</textarea>
    </div>

    <div class="form-group">
        <label>Price</label>
        <input type="number" class="form-control"
               name="price" value="{{ old('price',$product->price) }}">
    </div>

    <div class="form-group">
        <label>Qty</label>
        <input type="number" class="form-control"
               name="qty" value="{{ old('qty',$product->qty) }}">
    </div>

    <div class="form-group">
        <label>SKU</label>
        <input type="text" class="form-control"
               name="sku" value="{{ old('sku',$product->sku) }}">
    </div>

    <div class="form-group">
        <label>Type</label>
        <input type="text" class="form-control"
               name="type" value="{{ old('type',$product->type) }}">
    </div>

    <div class="form-group">
        <label>Vendor</label>
        <input type="text" class="form-control"
               name="vendor" value="{{ old('vendor',$product->vendor) }}">
    </div>

    {{-- TAGS (READ ONLY) --}}
    <div class="form-group">
        <label>Product Tags</label>
        <input type="text" class="form-control"
               value="{{ $product->tags }}"
               readonly>
    </div>

    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">

        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}"
                 width="120" class="mt-2">
        @endif
    </div>

    <button class="btn btn-primary">Update</button>
</form>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js">
</script>
<script>
    new FroalaEditor("#froala-editor");
</script>
