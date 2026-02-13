@extends('layouts.app')
@section('title', 'Edit Product')

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
        <h1>Edit Product</h1>
        <p style="color: var(--text-muted);">Update {{ $product->name }}.</p>
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

    <form action="{{ route('provider.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" class="form-input" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-input" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="stock" class="form-input" value="{{ old('stock', $product->stock) }}" required>
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
                                <option value="{{ $sub->id }}" {{ (old('category_id', $product->category_id) == $sub->id) ? 'selected' : '' }}>{{ $sub->name }}</option>
                            @endforeach
                        @else
                            <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endif
                    </optgroup>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-input" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Image URL</label>
            <input type="url" name="image" class="form-input" value="{{ old('image', $product->image) }}">
            @if($product->image)
                <img src="{{ $product->image }}" alt="Preview" style="max-height: 100px; margin-top: 0.5rem; border-radius: 4px;">
            @endif
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('provider.dashboard') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</main>
@endsection
