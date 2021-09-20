<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @can($objectSingular . '_create')
                    <div class="row m-2">
                        <div class="col-md-12">
                            <a class="btn btn-primary px-4" role="button" href="{{ route('admin.' . $object . '.create') }}">New {{ $titleSingular }}</a>
                        </div>
                    </div>
                @endcan

                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        {{ $header }}
                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {{ $data }}
                    </tbody>
                </table>
                <div class="row m-2">
                    <div class="col-md-12">
                        {{ $collection->links() }}
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
