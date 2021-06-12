<tr>
    <td>
        @for ($i = 1; $i < $category->level; $i++)
            |--- &nbsp;&nbsp;
        @endfor
        {{ $category->name }}
    </td>

    <td>{{ $entity->slug }}</td>
    <td>
        <div class="comment-footer">
            <a href="{{ backendRouter('category.edit', ['id' => $entity->getKey()]) }}">
                <button type="button" class="btn btn-cyan btn-xs">Edit</button>
            </a>
            <a href="#modal_confirm_delete"
               class="btn-danger btn btn-xs modal_confirm_delete rounded"
               data-toggle="modal"
               data-form-action="{{ backendRouter('category.destroy', ['id' => $entity->id]) }}"
            >
                Delete
            </a>
        </div>
    </td>
</tr>