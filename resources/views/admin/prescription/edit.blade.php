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
                        <!-- Information -->
                        <div class="row">
                            <p class="text-bold text-uppercase text-base">Information</p>      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Name" value="{{ $prescription->name }}" {{ $disabled }}>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-name"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Doctor</label>
                                    <select class="form-control" id="doctor-id" name="doctor_id" {{ $disabled }}>
                                        <option value="">----</option>
                                        @foreach ($doctors as $key => $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $prescription->doctor_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-doctor-id"></div>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark mt-5">
                        <!-- Information -->

                        <!-- Patient -->
                        <div class="row">
                            <p class="text-bold text-uppercase text-base">Patient</p>      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Patient</label>
                                    <select class="form-control" id="patient-id" name="patient_id" {{ $disabled }}>
                                        <option value="">----</option>
                                        @foreach ($patients as $key => $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $prescription->patient_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-patient-id"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" id="patient-name" value="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input class="form-control" type="text" id="patient-email" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Address</label>
                                    <input class="form-control" type="text" id="patient-address" value="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Phone</label>
                                    <input class="form-control" type="text" id="patient-phone" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Age</label>
                                    <input class="form-control" type="text" id="patient-age" value="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Gender</label>
                                    <select class="form-control" id="patient-gender" disabled>
                                        <option>----</option>
                                        @foreach(config('constants.GENDER') as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark mt-5">
                        <!-- Patient -->

                        <!-- Medicine -->     
                        <div class="row mt-4">
                            <p class="text-bold text-uppercase text-base">Medicine</p>   
                            <div class="col-md-12">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2 w-10">Order</th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Medicine</th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2 w-10">Quantity</th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2">Unit</th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2 w-40">Note</th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2"><button type="button" class="text-uppercase btn bg-gradient-success mt-2 add-medicine" {{ $disabled }}><i class="fas fa-plus"></i></button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(json_decode($prescription->medicine) as $medicine)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div class="text-danger text-xs font-weight-bold err-medicine-0-id">&nbsp;</div>  
                                                    <input type="hidden" name="medicine[0][id]" class="hidden-medicine-id" value="{{ $medicine->id }}">
                                                    <select class="form-control medicine-id" {{ $disabled }}>
                                                        <option value="">----</option>
                                                        @foreach ($medicines as $key => $item)
                                                            <option value="{{ $item->id }}" {{ $item->id == $medicine->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>                                                      
                                                </td>
                                                <td>
                                                    <div class="text-danger text-xs font-weight-bold err-medicine-0-quantity">&nbsp;</div>
                                                    <input class="form-control quantity" type="number" name="medicine[0][quantity]" placeholder="Quantity" value="{{ $medicine->quantity }}" {{ $disabled }}>
                                                </td>
                                                <td>
                                                    <div class="text-danger text-xs font-weight-bold err-medicine-0-unit">&nbsp;</div>
                                                    <input type="hidden" name="medicine[0][unit]" class="hidden-unit" value="{{ $medicine->unit }}">
                                                    <select class="form-control unit" {{ $disabled }}>
                                                        <option value="">----</option>
                                                        @foreach(config('constants.UNIT') as $key => $item)
                                                            <option value="{{ $key }}" {{ $key == $medicine->unit ? 'selected' : '' }}>{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="text-danger text-xs font-weight-bold">&nbsp;</div>
                                                    <textarea class="form-control mt-6" name="medicine[0][note]" rows="4" cols="4" placeholder="Note" value="{{ $medicine->note }}" {{ $disabled }}>{{ $medicine->note }}</textarea>
                                                </td>
                                                <td>
                                                    <button type="button" class="text-uppercase btn bg-gradient-danger mt-2 delete-medicine" {{ $disabled }}><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                                          
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark mt-5">
                        <!-- Medicine -->

                        <!-- Detail -->
                        @php 
                            $detail = json_decode($prescription->detail);
                        @endphp
                        <div class="row mt-4">
                            <p class="text-bold text-uppercase text-base">Detail</p>     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Symptom</label>
                                    <textarea class="form-control" type="text" name="symptom" rows="5" id="symptom" placeholder="Symptom"  value="{{ $detail->symptom }}" {{ $disabled }}>{{ $detail->symptom }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Diagnosis</label>
                                    <textarea class="form-control" type="text" name="diagnosis" rows="5" id="diagnosis" placeholder="Diagnosis" value="{{ $detail->diagnosis }}" {{ $disabled }}>{{ $detail->diagnosis }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Advice</label>
                                    <textarea class="form-control" type="text" name="advice" rows="5" id="advice" placeholder="Advice" value="{{ $detail->advice }}" {{ $disabled }}>{{ $detail->advice }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Usage</label>
                                    <textarea class="form-control" type="text" name="usage" rows="5" id="usage" placeholder="Usage" value="{{ $detail->usage }}" {{ $disabled }}>{{ $detail->usage }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark mt-5">
                        <!-- Detail -->

                        <input type="hidden" name="id" id="id" value="{{ $prescription->id }}">

                        @if (empty($disabled))
                        <div class="container m-auto row justify-content-md-center pb-5">
                            <div class="col-md-3 d-flex">
                                <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-70 mx-1" onclick="location.href='{{ route('prescription.index') }}'">Cancel</button>
                                <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-70 mx-1" id="but-create-prescription">Save</button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('scripts')
    <script>
        const medicineIds = [];

        function updateTable() {
            $('tbody').find('tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
                $(this).find('[name*="medicine"]').each(function() {
                    let newName = $(this).attr('name').replace(/\[\d+\]/g, '['+ index +']');
                    $(this).attr('name', newName);
                });
                $(this).find('[class*="err-medicine"]').each(function() {
                    let newClass = $(this).attr('class').replace(/\d+/g, index);
                    $(this).attr('class', newClass);
                });
            });
        }
        updateTable();

        $('.add-medicine').on('click', function () {
            let $firstRow = $('tbody').find('tr:first').html();
            let $newRow = $('<tr>'+ $firstRow +'</tr');
            $newRow.find('input, select').val('');
            $newRow.find('[class*="err-medicine"]').html('&nbsp;');
            $newRow.find('input.is-invalid, select.is-invalid').removeClass('is-invalid');
            $('tbody').append($newRow);
            updateTable();
        });
        $(document).on('click', '.delete-medicine', function () {
            if ($('tbody').find('tr').length == 1) {
                return false;
            }
            let medicineId = $(this).closest('tr').find('.medicine-id option:selected').val();
            if (medicineId !== '') {
                medicineIds.splice($.inArray(medicineId, medicineIds), 1);
                disabledMedicineIds();
            }
            $(this).closest('tr').remove();
            updateTable();
        });
        $(window).on('load', function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('prescription.change.patient') }}',
                data: {
                    'patient_id': $('#patient-id').val()
                },
                success: function(result) {
                    $('#patient-name').val(result.patient[0].name);
                    $('#patient-email').val(result.patient[0].email);
                    $('#patient-address').val(result.patient[0].address);
                    $('#patient-phone').val(result.patient[0].phone);
                    $('#patient-age').val(result.patient[0].age);
                    $('#patient-gender').val(result.patient[0].gender);
                }
            });
            $('.unit').prop('disabled', true);
            $('.medicine-id option:selected').each(function() {
                if (!medicineIds.includes($(this).val())) {
                    medicineIds.push($(this).val());
                }
            });
            disabledMedicineIds();
        });
        $('#patient-id').change(function() {
            let patientId = $(this).val();
            if (patientId === '') {
                $('[id^="patient"]').each(function() {
                    $(this).val('');
                });
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('prescription.change.patient') }}',
                    data: {
                        'patient_id': patientId
                    },
                    success: function(result) {
                        $('#patient-name').val(result.patient[0].name);
                        $('#patient-email').val(result.patient[0].email);
                        $('#patient-address').val(result.patient[0].address);
                        $('#patient-phone').val(result.patient[0].phone);
                        $('#patient-age').val(result.patient[0].age);
                        $('#patient-gender').val(result.patient[0].gender);
                    }
                });
            }
        });
        $(document).on('change', '.medicine-id', function () {
            let medicineId = $(this).val();
            let hiddenMedicineId = $(this).closest('tr').find('.hidden-medicine-id');
            let unit = $(this).closest('tr').find('.unit');
            let hiddenUnit = $(this).closest('tr').find('.hidden-unit');
            let prevMedicineId = medicineIds.indexOf($(this).data('prevMedicineId'));

            if (medicineId === '') {
                if (prevMedicineId !== -1) {
                    medicineIds.splice($.inArray(prevMedicineId, medicineIds), 1);
                }
                unit.val('');
                unit.prop('disabled', false);
                hiddenUnit.val('');
            } else {
                if (medicineId !== prevMedicineId) {
                    if (prevMedicineId !== -1) {
                        medicineIds.splice($.inArray(prevMedicineId, medicineIds), 1);
                    }
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('prescription.change.medicine') }}',
                        data: {
                            'medicine_id': medicineId
                        },
                        success: function(result) { 
                            unit.val(result.medicine[0].unit);
                            unit.prop('disabled', true);
                            hiddenUnit.val(result.medicine[0].unit);
                        }
                    });
                    if (!medicineIds.includes(medicineId)) {
                        medicineIds.push(medicineId);
                    }
                }
            }
            hiddenMedicineId.val(medicineId);
            $(this).data('prevMedicineId', medicineId);
            disabledMedicineIds();
        });
        function disabledMedicineIds() {
            $('.medicine-id').each(function() {
                $(this).find('option').each(function() {
                    if (medicineIds.includes($(this).val())) {
                        $(this).prop('disabled', true);
                        $(this).css({
                            'background-color': '#2dce89',
                            'color': 'white'
                        });
                    } else {
                        $(this).prop('disabled', false);
                        $(this).css({
                            'background-color': 'white',
                            'color': 'black'
                        });
                    }
                });
            });
        }

        let timeoutId;
        $(document).on('keyup', '.quantity', function() {
            let input = $(this);
            clearTimeout(timeoutId);
            timeoutId = setTimeout(function() {
                let quantity = input.val();
                let medicineId = input.closest('tr').find('.medicine-id option:selected').val();
                if (quantity !== '' && medicineId !== '') {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('prescription.check.medicine.quantity') }}',
                        data: {
                            'quantity': quantity,
                            'medicine_id': medicineId
                        },
                        success: function(result) {
                            if (result.response !== '') {
                                input.closest('td').find('[class*="err-medicine"]').html(result.response);
                                input.addClass('is-invalid');
                                $('#but-create-prescription').prop('disabled', true);
                            } else {
                                input.closest('td').find('[class*="err-medicine"]').html('&nbsp;');
                                input.removeClass('is-invalid');
                                $('#but-create-prescription').prop('disabled', false);
                            }
                        }
                    });
                }
            }, 500);
        });
        $('#but-create-prescription').on('click', function() {
            $('#but-create-prescription').text('Save');
            $('#but-create-prescription').prop('disabled', true);
            let form = $('#frm-prescription')[0];
            let data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url:'{{ route("prescription.store") }}',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result){
                    if (result.code == 422) {
                        resetErrors();
                        $('#but-create-prescription').text('Save');
                        $('#but-create-prescription').prop('disabled', false);
                        $('#err-name').text(result.errors.name);
                        $('#err-patient-id').text(result.errors.patient_id);
                        $('#err-doctor-id').text(result.errors.doctor_id);
                        for (let key in result.errors) {
                            $('input[name="'+ key +'"], select[name="'+ key +'"]').addClass("is-invalid");
                            if (key.startsWith('medicine.')) {
                                let medicine = key.split('.');
                                if (medicine.length === 3) {
                                    let index = medicine[1];
                                    let field = medicine[2];
                                    $('.err-medicine-'+ index +'-'+ field +'').text(result.errors[key]);
                                    $('.err-medicine-'+ index +'-'+ field +'').closest('td').find('select, input').addClass("is-invalid");
                                }
                            }
                        }
                    } else {
                        location.href = '{{ route("prescription.index") }}';
                    }
                }
            })
        });
        function resetErrors() {
            $('#err-name').text('');
            $('#err-patient-id').text('');
            $('#err-doctor-id').text('');
            $("#name").removeClass("is-invalid");
            $("#patient-id").removeClass("is-invalid");
            $("#doctor-id").removeClass("is-invalid");
            $('tbody').find('tr').each(function() {
                $(this).find('[class*="err-medicine"]').html('&nbsp;');
                $(this).find('input.is-invalid, select.is-invalid').removeClass('is-invalid');
            });
        }
    </script>
@endsection