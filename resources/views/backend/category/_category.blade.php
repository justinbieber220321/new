@php $render = []; @endphp
@foreach ($categories as $key => $category)
    @include('backend.category._category_recursive', ['entity' => $category, 'categories' => $categories, 'render' => $render])
    @if ($category->has('childrenRecursive'))
        @include('backend.category._category', ['categories' => $category->childrenRecursive])
    @endif
@endforeach