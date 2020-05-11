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
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="<?=base_url('spv_side/tambah_laporan_kegiatan');?>" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Tambah Data Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped- table-bordered table-hover" id="tbl">
                <thead>
                    <tr>
                        <th style="text-align: center;" width="4%"> # </th>
                        <th style="text-align: center;"> Unit </th>
                        <th style="text-align: center;"> Kegiatan </th>
                        <th style="text-align: center;"> Pelapor </th>
                        <th style="text-align: center;"> Tanggal Lapor </th>
                        <th style="text-align: center;" width="7%"> Aksi </th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript" language="javascript" >
                $(document).ready(function(){
                    $('#tbl').dataTable({
                        "order": [[ 0, "asc" ]],
                        "bProcessing": true,
                        "ajax" : {
                            url:"<?= site_url('spv/Report/json_laporan_kegiatan'); ?>"
                        },
                        "aoColumns": [
                                    { mData: 'number', sClass: "alignCenter" },
                                    { mData: 'unit', sClass: "alignCenter" } ,
                                    { mData: 'kegiatan', sClass: "alignCenter" } ,
                                    { mData: 'pelapor', sClass: "alignCenter" },
                                    { mData: 'tanggal_lapor', sClass: "alignCenter" },
                                    { mData: 'action', sClass: "alignCenter" }
                                ]
                    });

                });
            </script>
        </div>
    </div>
</div>