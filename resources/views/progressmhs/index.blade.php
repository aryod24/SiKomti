@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center" style="background-color: #ffffff; padding: 20px;">
        <h3 class="mb-0 font-weight-bold" style="color: #415f8d; font-size: 36px;">Progress Kompen</h3>     
    </div>
    <div class="card-body">
            <div id="alert-container"></div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_progress">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kompen</th>
                        <th>Pembuat Tugas</th>
                        <th>Status</th>
                        <th>Aksi Request</th>
                        <th>Aksi Progress</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modalContent">
                <!-- Modal content will be loaded here -->
            </div>
        </div>
    </div>
    <!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalContent">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>
<!-- Add this after your existing detailModal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .action-buttons {
        display: flex;
        gap: 5px;
    }
    .table {
            border-radius: 0.5rem;
            border-collapse: separate;
            overflow: hidden;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
        }
        .table thead {
            background-color: #8fa0c0a4;
            color: rgb(0, 0, 0);
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
    </style>
</style>
@endpush

@push('js')
    <script>
        function showDetail(id) {
            $.ajax({
                url: '{{ url("progressmhs/show-ajax") }}/' + id,
                type: 'GET',
                success: function(response) {
                    $('#modalContent').html(response);
                    $('#detailModal').modal('show');
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.statusText);
                }
            });
        }
        function uploadBukti(uuidKompen) {
            $.ajax({
                url: '{{ route("progressmhs.create-bukti", ":uuid") }}'.replace(':uuid', uuidKompen),
                type: 'GET',
                success: function(response) {
                    $('#uploadModal .modal-content').html(response);
                    $('#uploadModal').modal('show');
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.statusText);
                }
            });
        }

        function viewBukti(uuidKompen) {
            $.ajax({
                url: '{{ route("progressmhs.view-bukti", ":uuid") }}'.replace(':uuid', uuidKompen),
                type: 'GET',
                success: function(response) {
                    $('#modalContent').html(response);
                    $('#detailModal').modal('show');
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.statusText);
                }
            });
        }

        function downloadBukti(uuidKompen) {
            window.location.href = '{{ route("progressmhs.download-bukti", ":uuid") }}'.replace(':uuid', uuidKompen);
        }

        $(document).ready(function() {
            var dataProgress = $('#table_progress').DataTable({
                serverSide: true,
                searching: false, // Disable search bar
                ajax: {
                    "url": "{{ url('progressmhs/list') }}/{{ Auth::user()->ni }}",
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
        data: "pembuat_tugas",
        className: "",
        orderable: true,
        searchable: true
    },
    {
        data: "status",
        className: "text-center",
        orderable: true,
        searchable: true
    },
    {
        data: "aksi_request",
        className: "text-center",
        orderable: false,
        searchable: false
    },
    {
        data: "aksi_progress",
        className: "text-center",
        orderable: false,
        searchable: false
    }
]
            });
        });
    </script>
@endpush
