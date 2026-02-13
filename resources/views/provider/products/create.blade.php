@extends('layouts.app')

@section('title', 'Add Product')

@section('styles')
<style>
    .form-container {
        max-width: 700px;
        margin: 3rem auto;
        background: var(--card-bg);
        padding: 2rem;
        border-radius: var(--radius);
        border: 1px solid var(--border);
    }
    
    .form-header { margin-bottom: 2rem; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }
    
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
</style>
@endsection

@section('content')
<main class="form-container">
    <div class="form-header">
        <h1>Add New Product</h1>
        <p style="color: var(--text-muted);">List a new item for sale in your store.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('provider.products.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" class="form-input" placeholder="e.g. Vintage Leather Jacket" value="{{ old('name') }}" required>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-input" placeholder="0.00" value="{{ old('price') }}" required>
            </div>
            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="stock" class="form-input" placeholder="10" value="{{ old('stock') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-input" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        @if($category->children->count() > 0)
                            @foreach($category->children as $sub)
                                <option value="{{ $sub->id }}" {{ old('category_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                            @endforeach
                        @else
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endif
                    </optgroup>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-input" rows="4" placeholder="Describe your product...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Image URL</label>
            <input type="url" name="image" class="form-input" placeholder="https://..." value="{{ old('image') }}">
            <small style="color: var(--text-muted);">Enter a direct link to an image (e.g. Unsplash)</small>
        </div>

        <div class="form-group">
            <label>Available Colors</label>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 0.5rem;">
                <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                    <input type="checkbox" name="colors[]" value="#000000"> Black
                </label>
                <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                    <input type="checkbox" name="colors[]" value="#ffffff"> White
                </label>
                <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                    <input type="checkbox" name="colors[]" value="#ef4444"> Red
                </label>
                <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                    <input type="checkbox" name="colors[]" value="#3b82f6"> Blue
                </label>
                <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                    <input type="checkbox" name="colors[]" value="#10b981"> Green
                </label>
            </div>
        </div>

        <div class="form-group" id="gallery-container">
            <label>Gallery Images (Additional URLs)</label>
            <div class="gallery-input-group" style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                <input type="url" name="gallery[]" class="form-input" placeholder="https://...">
                <button type="button" class="btn btn-outline" onclick="addGalleryInput()" style="padding: 0 1rem;">+</button>
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Publish Product</button>
            <a href="{{ route('provider.dashboard') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</main>
@endsection

@section('scripts')
<script>
    function addGalleryInput() {
        const container = document.getElementById('gallery-container');
        const div = document.createElement('div');
        div.className = 'gallery-input-group';
        div.style.cssText = 'display: flex; gap: 0.5rem; margin-bottom: 0.5rem;';
        div.innerHTML = `
            <input type="url" name="gallery[]" class="form-input" placeholder="https://...">
            <button type="button" class="btn btn-outline" onclick="this.parentElement.remove()" style="padding: 0 1rem; color: var(--secondary); border-color: var(--secondary);">×</button>
        `;
        container.appendChild(div);
    }
</script>
@endsection
