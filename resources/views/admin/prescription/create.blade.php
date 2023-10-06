@extends('layouts.admin')
@section('content')
    <form action="{{ route('prescription.store') }}" id="frm-prescription" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="table-header">
                        <div class="card-header d-flex w-100 mb-0">
                            <div class="w-50">
                                <h5>Prescription / Create</h5>
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
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-name"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Doctor</label>
                                    <select class="form-control" id="doctor-id" name="doctor_id">
                                        <option value="">----</option>
                                        @foreach ($doctors as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                    <select class="form-control" id="patient-id" name="patient_id">
                                        <option value="">----</option>
                                        @foreach ($patients as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 ps-2"><button type="button" class="text-uppercase btn bg-gradient-success mt-2 add-medicine"><i class="fas fa-plus"></i></button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <select class="form-control medicine-id" name="medicine[1][id]">
                                                        <option value="">----</option>
                                                        @foreach ($medicines as $key => $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="number" name="medicine[1][quantity]" placeholder="Quantity">
                                                </td>
                                                <td>
                                                    <select class="form-control unit" name="medicine[1][unit]" disabled>
                                                        <option value="">----</option>
                                                        <option value="0">Bottle</option>
                                                        <option value="1">Tube</option>
                                                        <option value="2">Pill</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea class="form-control mt-6" name="medicine[1][note]" rows="4" cols="4" placeholder="Note"></textarea>
                                                </td>
                                                <td>
                                                    <button type="button" class="text-uppercase btn bg-gradient-danger mt-2 delete-medicine"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>      
                                    <div class="text-danger text-xs font-weight-bold mt-2" id="err-medicine"></div>                                                        
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark mt-5">
                        <!-- Medicine -->

                        <!-- Detail -->
                        <div class="row mt-4">
                            <p class="text-bold text-uppercase text-base">Detail</p>     
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Symptom</label>
                                    <textarea class="form-control" type="text" name="symptom" rows="5" id="symptom" placeholder="Symptom"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Diagnosis</label>
                                    <textarea class="form-control" type="text" name="diagnosis" rows="5" id="diagnosis" placeholder="Diagnosis"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Advice</label>
                                    <textarea class="form-control" type="text" name="advice" rows="5" id="advice" placeholder="Advice"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Usage</label>
                                    <textarea class="form-control" type="text" name="usage" rows="5" id="usage" placeholder="Usage"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark mt-5">
                        <!-- Detail -->

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
        function updateTable() {
            $('tbody').find('tr').each(function(index) {
                let i = index + 1;
                $(this).find('td:first').text(i);
                let html = $(this).html();
                html = html.replace(/\[\d+\]/g, '['+ i +']');
                $(this).html(html);
            });
        }
        updateTable();

        $('.add-medicine').on('click', function () {
            let td = $('tbody').find('tr').html();
            let html = '<tr>'+ td + '</tr>';
            $('tbody').append(html);
            updateTable();
        });
        $(document).on('click', '.delete-medicine', function () {
            if ($('tbody').find('tr').length == 1) {
                return false;
            }
            $(this).closest('tr').remove();
            updateTable();
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
                        $('#err-medicine').text(result.errors.medicine);
                        for (let key in result.errors) {
                            $('input[name='+ key +'], select[name='+ key +']').addClass("is-invalid");
                        }
                    } else {
                        location.href = '{{ route("prescription.index") }}';
                    }
                }
            })
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
            let unit = $(this).closest('tr').find('.unit');
            if (medicineId === '') {
                unit.val('');
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('prescription.change.medicine') }}',
                    data: {
                        'medicine_id': medicineId
                    },
                    success: function(result) {
                        unit.val(result.medicine[0].unit);
                    }
                });
            }
    
            $('.medicine-id').not(this).each(function() {
                let row = $(this).attr('name').match(/\d+/)[0];

                if (!$(this).data('disabledOptions')) {
                    $(this).data('disabledOptions', []);
                }

                let disabledOptions = $(this).data('disabledOptions');
                $(this).find('option').each(function() {
                    $(this).prop('disabled', false); 
                });
                disabledOptions.push(medicineId);
                $(this).find('option').each(function() {
                    let optionValue = $(this).val();
                    if (disabledOptions.includes(optionValue)) {
                        $(this).prop('disabled', true);
                    }
                });
            });
        });
        function resetErrors() {
            $('#err-name').text('');
            $('#err-patient-id').text('');
            $('#err-doctor-id').text('');
            $('#err-medicine').text('');
            $("#name").removeClass("is-invalid");
            $("#patient-id").removeClass("is-invalid");
            $("#doctor-id").removeClass("is-invalid");
        }
    </script>
@endsection