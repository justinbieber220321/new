@foreach($categories as $key => $category)
    @include('backend.category._form_select_category_recursive', ['category' => $category])
    @if ($category->has('childrenRecursive'))
        @include('backend.category._form_select_category', ['categories' => $category->childrenRecursive])
    @endif
@endforeach