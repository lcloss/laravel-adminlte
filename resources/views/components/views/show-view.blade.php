<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $titleSingular }} Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $titleSingular }} Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ $titleSingular }} Details</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{ $slot }}

                    <div class="row">
                        <div class="col-12 text-right">
                            @can($objectSingular . '_edit')
                                <a href="{{ route('admin.' . $object . '.edit', $model) }}" role="button" class="btn btn-info px-5">Edit</a>
                            @endcan
                            @can($objectSingular . '_access')
                                <a href="{{ route('admin.' . $object . '.index') }}" role="button" class="btn btn-primary px-5">List</a>
                            @endcan
                            @can($objectSingular . '_delete')
                                <a href="#" role="button" class="btn btn-danger px-5" onclick="deleteObject('{{ route('admin.' . $object . '.destroy', $model) }}', '{{ route('admin.' . $object . '.index') }}', '{{ $titleSingular }}: {{ $ref }}')">Delete</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
