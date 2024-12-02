{{-- resources/views/kompen/showreq.blade.php --}}
<div class="modal fade animate shake" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Requests</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>NI</th>
                            <th>Nama</th>
                            <th>Status Acc</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="request-body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
