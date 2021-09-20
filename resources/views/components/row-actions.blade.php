<td class="text-right">
    @can($objectSingular . '_show')
    <a class="btn btn-primary btn-sm" href="{{ route('admin.' . $object . '.show', $model) }}">
        <i class="fas fa-folder"></i>
        View
    </a>
    @endcan
    @can($objectSingular . '_edit')
    <a class="btn btn-info btn-sm" href="{{ route('admin.' . $object . '.edit', $model) }}">
        <i class="fas fa-pencil-alt"></i>
        Edit
    </a>
    @endcan
    @can($objectSingular . '_delete')
    <a class="btn btn-danger btn-sm" href="#" onclick="deleteObject('{{ route('api.admin.' . $object . '.destroy', $model) }}', '{{ Auth::user()->api_token }}', '{{ route('admin.' . $object . '.index') }}', '{{ $title }}: {{ $ref }}')">
        <i class="fas fa-trash"></i>
        Delete
    </a>
    @endcan
</td>
