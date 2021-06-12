<option value="{{ $category->getKey() }}" {{ ((int)$parentId == (int)$category->getKey()) ? ' selected' : '' }} >
        @for ($i = 1; $i < $category->level; $i++)
                |--- &nbsp;&nbsp;
        @endfor
        {{ $category->name }}
</option>
