<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Schedule</h4>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table id="order-listing" class="table">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(document).ready(function() {
        get_schedule()
    })

    function get_schedule() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };


        var t = $("#order-listing").DataTable({
            "scrollY": 310,
            "iDisplayLength": 10,
            "bLengthChange": false,
            initComplete: function() {
                var api = this.api();
                $('#table_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            bDestroy: true,
            ajax: {
                "url": "<?= base_url('schedule/get_schedule/') ?>",
                "type": "POST"
            },
            columns: [{
                    "data": "no",
                    "title": "No",
                    "orderable": false
                },
                {
                    "data": "date",
                    "title": "Tanggal"
                },
                {
                    "data": "time",
                    "title": "Waktu"
                },
                {
                    "data": "tuan_rumah",
                    "title": "Tim Tuan Rumah"
                },
                {
                    "data": "tamu",
                    "title": "Tim Tamu"
                },
                {
                    "data": "action",
                    "title": "Action",
                    "orderable": false
                },

            ],
            order: [
                [0, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        $('#order-listing').each(function() {
            var datatable = $(this);
            // SEARCH - Add the placeholder for Search and Turn this into in-line form control
            var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
            search_input.attr('placeholder', 'Sort');
            var s = datatable.closest('.dataTables_wrapper').find(".dataTables_filter").append('<a onclick="directAddSchedule()" data-whatever="@mdo" class="btn btn-info ml-2 text-white"><b>Tambah Jadwal Pertandingan</b></a>');
        });
    }

    function directAddSchedule()
    {
        window.location.href = '<?= base_url('schedule/add_schedule') ?>';
    }

    function showReport(id){
        window.location.href = '<?= base_url('report?schedule_id=') ?>' + id
    }

    function editData(id){
        window.location.href = '<?= base_url('schedule/edit_schedule/') ?>' + id
    }

    function deleteData(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('schedule/remove/') ?>" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 500) {
                            getError(response.message)
                        } else {
                            getSuccess(response.message)
                        }
                    },
                    error: function(e) {
                        getError(e)
                    }
                })
            }
        })
    }

    function getSuccess(msg) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: msg,
            showConfirmButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                get_schedule()
            }
        })
    }

    function getWarning(msg) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: msg
        })
    }

    function getError(msg) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: msg
        })
    }
</script>