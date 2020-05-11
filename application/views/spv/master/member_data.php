<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
            <h3>Catatan</h3>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__body">
            <table class="table table-striped- table-bordered table-hover" id="tbl">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="4%"> # </th>
                        <th style="text-align: center;"> Nama </th>
                        <th style="text-align: center;"> NIP </th>
                        <th style="text-align: center;"> Jabatan </th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript" language="javascript" >
                $(document).ready(function(){
                    $('#tbl').dataTable({
                        "order": [[ 0, "asc" ]],
                        "bProcessing": true,
                        "ajax" : {
                            url:"<?= site_url('spv/Master/json_member'); ?>"
                        },
                        "aoColumns": [
                                    { mData: 'number', sClass: "alignCenter" },
                                    { mData: 'nama' } ,
                                    { mData: 'nip', sClass: "alignCenter" } ,
                                    { mData: 'jabatan', sClass: "alignCenter" }
                                ]
                    });

                });
            </script>
        </div>
    </div>
</div>