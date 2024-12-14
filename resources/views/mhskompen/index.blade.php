@extends('layouts.template')

@section('content')
<div class="container-fluid" style="background-color: #f5f5f5;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-12">
            <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden; height: 100%; padding: 0;">
                <!-- Header Card -->
                <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
                    <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;"> Daftar Kompen</h3>
                </div>
                <!-- Body Card -->
                <div class="card-body">
                    <div id="alert-container"></div>
                    <!-- Tabel -->
                    <table class="table table-bordered table-striped table-hover table-sm" id="table_mhskompen">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kompen</th>
                                <th>Deskripsi</th>
                                <th>Quota</th>
                                <th>Jam Kompen</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalContent">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
        .table {
            border-radius: 0.5rem;
            border-collapse: separate;
            overflow: hidden;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
        }

        .table thead {
            background-color: #6b83a8;
            color: #ffffff;
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #dee2e6;
            background-color: #ffffff;
        }

        .table tbody tr {
            background-color: #ffffff;
            transition: background-color 0.3s;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table th {
            background-color: #6b83a8 !important;
            color: #ffffff !important;
        }

        /* Judul Card di tengah */
        .card-header h3.card-title {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            text-transform: none;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
@endpush

@push('js')
    <script>
        function showRequestModal(UUID_Kompen) {
    $.ajax({
        url: '{{ route("mhskompen.create-ajax", ":UUID_Kompen") }}'.replace(':UUID_Kompen', UUID_Kompen),
        type: 'GET',
        success: function(response) {
            $('#modalContent').html(response);
            $('#requestModal').modal('show');
        },
        error: function(xhr) {
            showAlert('Error: ' + xhr.statusText, 'danger');
        }
    });
}
function submitForm() {
    $.ajax({
        url: $('#requestForm').attr('action'),
        type: 'POST',
        data: $('#requestForm').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            showModalAlert(response.success, 'success');
            setTimeout(function() {
                $('#requestModal').modal('hide');
                $('#table_mhskompen').DataTable().ajax.reload();
            }, 2000);
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                showModalAlert(xhr.responseJSON.error, 'danger');
            } else {
                showModalAlert('Error: ' + xhr.statusText, 'danger');
            }
        }
    });
}

function showModalAlert(message, type) {
    var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
        message +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>';
    $('#modal-alert-container').html(alertHtml);
}

        $(document).ready(function() {
            var dataMhsKompen = $('#table_mhskompen').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('mhskompen/list') }}",
                    "dataType": "json",
                    "type": "GET"
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_kompen",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "deskripsi",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "quota",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jam_kompen",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_mulai",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_akhir",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush