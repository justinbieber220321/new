@if ($errors->any())
    <div class="error alert alert-danger" style="padding-bottom: 0">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif