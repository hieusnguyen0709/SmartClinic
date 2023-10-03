@extends('layouts.admin')
@section('content')
    @php 
        $disabled = '';
        if (request()->route('is_view')) {
            $disabled = 'disabled';
        }
    @endphp
    <form action="{{ route('prescription.store') }}" id="frm-prescription" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-50">
                                <h5>Prescription / {{ empty($disabled) ? 'Edit' : 'View' }} / {{ $prescription->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-name"></div>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">

                        <div class="container m-auto row justify-content-md-center pb-5">
                            <div class="col-md-3 d-flex">
                                <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-60 mx-1" onclick="location.href='{{ route('prescription.index') }}'">Cancel</button>
                                <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-60 mx-1" id="but-create-prescription">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('scripts')
    <script>
    </script>
@endsection