@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-50">
                                <h5>Medicines</h5>
                                <button class="text-uppercase btn bg-gradient-success" id="create-medicine"  data-bs-toggle="modal" data-bs-target="#modal-medicine">Create&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                                <button class="text-uppercase btn bg-gradient-danger" id="bulk-delete-medicine"  data-bs-toggle="modal" data-bs-target="#modal-delete">Bulk Delete&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
                            </div>
                            <div class="w-50">
                                <div class="float-end">
                                    <h5>&nbsp;</h5>
                                    <button class="text-uppercase btn bg-gradient-warning" onclick="location.href='{{ route('medicine.index') }}'">Clear&nbsp;&nbsp;<i class="fas fa-broom"></i></button>
                                    <div class="d-flex float-end mx-1">
                                        <form action="{{ route('medicine.index') }}" method="get" id="frm-search" class="w-100 mx-1 d-flex">
                                            <input type="text" class="form-control" placeholder="Search here..." name="search" id="search" value="{{ $search }}">
                                            <!-- <i class="fas fa-search" aria-hidden="true"></i> -->
                                            <input type="hidden" name="num_per_page" id="num-per-page" value="{{ $numPerPage }}">
                                            <input type="hidden" name="sort_column" id="sort-column" value="{{ $sortColumn }}">
                                            <input type="hidden" name="sort_type" id="sort-type" value="{{ $sortType }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check-all">
                                            </div>
                                        </th>
                                        @php
                                            $classSortName = $classSortCategory = $classSortInstruction = $classSortUnit = $classSortQuantity = 'fa-sort';
                                            if ($sortColumn == 'name') {
                                                if ($sortType == 'asc') {
                                                    $classSortName = 'fa-sort-up';
                                                } else {
                                                    $classSortName = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'category_id') {
                                                if ($sortType == 'asc') {
                                                    $classSortCategory = 'fa-sort-up';
                                                } else {
                                                    $classSortCategory = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'instruction') {
                                                if ($sortType == 'asc') {
                                                    $classSortInstruction = 'fa-sort-up';
                                                } else {
                                                    $classSortInstruction = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'unit') {
                                                if ($sortType == 'asc') {
                                                    $classSortUnit = 'fa-sort-up';
                                                } else {
                                                    $classSortUnit = 'fa-sort-down';
                                                }
                                            } elseif ($sortColumn == 'quantity') {
                                                if ($sortType == 'asc') {
                                                    $classSortQuantity = 'fa-sort-up';
                                                } else {
                                                    $classSortQuantity = 'fa-sort-down';
                                                }
                                            }
                                        @endphp
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Name<i class="fas fa-solid {{ $classSortName }} cursor-pointer" aria-hidden="true" id="but-sort-name"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Category<i class="fas fa-solid {{ $classSortCategory }} cursor-pointer" aria-hidden="true" id="but-sort-category"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Instruction<i class="fas fa-solid {{ $classSortInstruction }} cursor-pointer" aria-hidden="true" id="but-sort-instruction"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Unit<i class="fas fa-solid {{ $classSortUnit }} cursor-pointer" aria-hidden="true" id="but-sort-unit"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Quantity<i class="fas fa-solid {{ $classSortQuantity }} cursor-pointer" aria-hidden="true" id="but-sort-quantity"></i></th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">User</th>
                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($medicines) > 0)
                                    @foreach ($medicines as $key => $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name='Medicine_ids[]' value="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->category->name ?? '' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->instruction }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->viewUnit() }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->quantity }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->user->name ?? '' }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-solid fa-eye ms-auto text-primary cursor-pointer view-medicine" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-medicine" data-id="{{ $item->id }}" title="View"></i>
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer edit-medicine" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-medicine" data-id="{{ $item->id }}" title="Edit" ></i>
                                            <i class="fas fa-trash-alt ms-auto text-danger cursor-pointer delete-medicine" data-bs-placement="top" data-bs-toggle="modal" data-bs-target="#modal-delete" data-id="{{ $item->id }}" title="Delete"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">{{ config('message.NO_DATA') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (count($medicines) > 0)
                    @include('admin.includes.paging', ['pageObject' => $medicines, 'numPerPage' => $numPerPage, 'search' => $search])
                @endif
            </div>
        </div>
    </div>
@include('admin.includes.modals.modal-medicine')
@include('admin.includes.modals.modal-delete')
@endsection
@section('scripts')
    <script>
        $('#search').keyup(function(event) {
            if (event.which === 13 || $(this).val() == '') {
                event.preventDefault();
                $('#frm-search').submit();
            }
        });
        $('#sel-num-per-page').change(function() {
            $('#num-per-page').val($(this).val());
            $('#frm-search').submit();
        });
        $('#but-sort-name').click(function() {
            $('#sort-column').val('name');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-category').click(function() {
            $('#sort-column').val('category_id');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-instruction').click(function() {
            $('#sort-column').val('instruction');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-unit').click(function() {
            $('#sort-column').val('unit');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('#but-sort-quantity').click(function() {
            $('#sort-column').val('quantity');
            let sortType = $('#sort-type').val();
            
            if (sortType == 'desc') {
                $('#sort-type').val('asc');
            } else {
                $('#sort-type').val('desc');
            }
            $('#frm-search').submit();
        });
        $('.select-category-tree').on('click', '.dropdown-item', function(event) {
            $('.select-category-tree .btn-select').html($(event.target).text());
            $('#category-id').val($(event.target).attr('value'));
        })
        $('#create-medicine').on('click', function() {
            $('.modal-title').html('New Medicine');
            $.ajax({
                type: 'GET',
                url: '{{ route('medicine.get.edit') }}',
                data: {
                    'id': ''
                },
                success: function(result) {
                    $('#id').val('');
                    $('#name').val('');
                    $('#category-id').val(result.categoryId);
                    $('#dropdown-parent-category').html(result.categoryList);
                    $('#instruction').val('');
                    $('#unit').val('');
                    $('#quantity').val('');
                }
            });
            resetErrors();
            $('#but-create-medicine').css('display', 'inline-block');
            $("#frm-medicine input, select, textarea").prop("disabled", false);
            $('#modal-medicine').show();
        });
        $('.edit-medicine').on('click', function() {
            $('.modal-title').html('Edit Medicine');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('medicine.get.edit') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#id').val(id);
                    $('#category-id').val(result.categoryId);
                    $('#dropdown-parent-category').html(result.categoryList);
                    $('#name').val(result.medicine.name);
                    $('#instruction').val(result.medicine.instruction);
                    $('#unit').val(result.medicine.unit);
                    $('#quantity').val(result.medicine.quantity);
                }
            });
            resetErrors();
            $('#but-create-medicine').css('display', 'inline-block');
            $("#frm-medicine input, select, textarea").prop("disabled", false);
            $('#modal-medicine').show();
        });
        $('.view-medicine').on('click', function() {
            $('.modal-title').html('View Medicine');
            let _this = $(this);
            let id = _this.data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('medicine.get.view') }}',
                data: {
                    'id': id
                },
                success: function(result) {
                    $('#id').val(id);
                    $('#category-id').val(result.categoryId);
                    $('#dropdown-parent-category').html(result.categoryList);
                    $('#name').val(result.medicine.name);
                    $('#instruction').val(result.medicine.instruction);
                    $('#unit').val(result.medicine.unit);
                    $('#quantity').val(result.medicine.quantity);
                }
            });
            resetErrors();
            $('#but-create-medicine').css('display', 'none');
            $("#frm-medicine input, select, textarea").prop("disabled", true);
            $('#modal-medicine').show();
        });
        $('#but-create-medicine').on('click', function() {
            $('#but-create-medicine').text('Saving ...');
            $('#but-create-medicine').prop('disabled', true);
            let form = $('#frm-medicine')[0];
            let data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url:'{{ route("medicine.store") }}',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result){
                    if (result.code == 422) {
                        resetErrors();
                        $('#but-create-medicine').text('Save');
                        $('#but-create-medicine').prop('disabled', false);
                        $('#err-name').text(result.errors.name);
                        $('#err-category-id').text(result.errors.category_id);     
                        $('#err-instruction').text(result.errors.instruction);
                        $('#err-unit').html(result.errors.unit);
                        $('#err-quantity').html(result.errors.quantity);
                        for (let key in result.errors) {
                            $('input[name='+ key +'], select[name='+ key +']').addClass("is-invalid");
                        }
                    } else {
                        $('#modal-medicine').hide(); 
                        location.reload();
                    }
                }
            })
        });
        $('.delete-medicine').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('medicine.delete') }}');
            $('#but-confirm-delete').prop('disabled', false);
            let _this = $(this);
            let id = _this.data('id');
            $('#id-delete').val(id);
            $('#modal-delete').show();
        });
        $('#bulk-delete-medicine').on('click', function() {
            $('#frm-delete').attr('action', '{{ route('medicine.delete') }}');
            let ids = [];
            $("tbody input:checked").each(function() {
                ids.push($(this).val());
            });
            if (ids.length == 0) {
                $('#but-confirm-delete').prop('disabled', true);
            } else {
                $('#but-confirm-delete').prop('disabled', false);
            }
            $('#id-delete').val(ids.toString());
            $('#modal-delete').show();
        });
        function resetErrors() {
            $('#err-category-id').text('');
            $('#err-name').text('');
            $('#err-instruction').text('');
            $('#err-unit').text('');
            $('#err-quantity').text('');
            $("#category-id").removeClass("is-invalid");
            $("#name").removeClass("is-invalid");
            $("#instruction").removeClass("is-invalid");
            $("#unit").removeClass("is-invalid");
            $("#quantity").removeClass("is-invalid");
        }
    </script>
@endsection