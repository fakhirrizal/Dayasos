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
            <p> 1. Ketika mengklik <b>Atur Ulang Sandi</b>, maka kata sandi otomatis menjadi "<b>12345</b>"</p>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="<?=base_url('admin_side/tambah_data_petugas');?>" class="btn btn-brand btn-elevate btn-icon-sm">
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
                        <th style="text-align: center;"> Nama </th>
                        <th style="text-align: center;"> Username </th>
                        <th style="text-align: center;"> Total Login </th>
                        <th style="text-align: center;"> Last Activity </th>
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
                            url:"<?= site_url('admin/Master/json_member'); ?>"
                        },
                        "aoColumns": [
                                    { mData: 'number', sClass: "alignCenter" },
                                    { mData: 'nama' } ,
                                    { mData: 'username', sClass: "alignCenter" } ,
                                    { mData: 'total_login', sClass: "alignCenter" },
                                    { mData: 'last_activity', sClass: "alignCenter" },
                                    { mData: 'action', sClass: "alignCenter" }
                                ]
                    });

                });
            </script>
        </div>
    </div>
</div>