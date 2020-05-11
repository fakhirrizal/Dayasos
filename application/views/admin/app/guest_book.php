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
						<th style="text-align: center;"> Email </th>
						<th style="text-align: center;"> IP </th>
						<th style="text-align: center;"> Device </th>
						<th style="text-align: center;"> OS </th>
						<th style="text-align: center;"> Browser </th>
						<th style="text-align: center;"> Waktu </th>
                    </tr>
				</thead>
			</table>
			<script type="text/javascript" language="javascript" >
                $(document).ready(function(){
                    $('#tbl').dataTable({
                        "order": [[ 0, "asc" ]],
                        "bProcessing": true,
                        "ajax" : {
                            url:"<?= site_url('admin/App/json_guest_book'); ?>"
                        },
                        "aoColumns": [
                                    { mData: 'number', sClass: "alignCenter" },
                                    { mData: 'nama', sClass: "alignCenter" } ,
                                    { mData: 'email', sClass: "alignCenter" } ,
                                    { mData: 'ip', sClass: "alignCenter" } ,
                                    { mData: 'device', sClass: "alignCenter" },
                                    { mData: 'os', sClass: "alignCenter" },
                                    { mData: 'browser', sClass: "alignCenter" },
                                    { mData: 'date', sClass: "alignCenter" }
								]
                    });

                });
            </script>
        </div>
    </div>
</div>