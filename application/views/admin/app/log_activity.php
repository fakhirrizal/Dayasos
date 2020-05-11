<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
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
                        <a href="<?=base_url('admin_side/cleaning_log');?>" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-trash"></i>
                            Kosongkan Log
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
						<th style="text-align: center;"> Tipe Aktifitas </th>
						<th style="text-align: center;"> Aktifitas </th>
						<th style="text-align: center;"> Pengguna </th>
						<th style="text-align: center;"> Waktu </th>
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
                            url:"<?= site_url('admin/App/json_log_activity'); ?>"
                        },
                        "aoColumns": [
                                    { mData: 'number', sClass: "alignCenter" },
                                    { mData: 'tipe', sClass: "alignCenter" } ,
                                    { mData: 'aktifitas', sClass: "alignCenter" } ,
                                    { mData: 'pengguna', sClass: "alignCenter" },
                                    { mData: 'date', sClass: "alignCenter" },
                                    { mData: 'action', sClass: "alignCenter" }
								],
						"drawCallback": function(data) {
										$('.detaildata').click(function(){
										var id = $(this).attr("id");
										var modul = 'modul_detail_log_aktifitas';
										$.ajax({
											type:"POST",
											url: "<?php echo site_url(); ?>admin/App/ajax_function",
											cache: false,
											data: {id:id,modul:modul},
											success:function(data){
											$('#formdetaildata').html(data);
											$('#detaildata').modal("show");
											}
										});
										});
									}
                    });

                });
            </script>
        </div>
    </div>
</div>
<div class="modal fade" id="detaildata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detail Data Aktifitas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="box box-primary" id='formdetaildata' >
                </div>
            </div>
        </div>
    </div>
</div>