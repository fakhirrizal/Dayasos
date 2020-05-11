<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
            <h3>Catatan</h3>
            <p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi.</p>
            <p> 2. Ketentuan file yang diupload:</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.bmp</b></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-list-2"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Form Tambah Data
                </h3>
            </div>
        </div>
        <form class="kt-form" action="<?=base_url('spv_side/simpan_laporan_kegiatan');?>" method="post" enctype='multipart/form-data'>
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label>Unit <font color='red'>*</font></label>
                    <input type="text" class="form-control" name='unit' required>
                </div>
                <div class="form-group">
                    <label>Kegiatan <font color='red'>*</font></label>
                    <select type="text" class="form-control" name='id_kegiatan' required>
                        <option value=''>-- Pilih --</option>
                        <?php
                        foreach ($keg as $key => $value) {
                            echo"<option value='".$value->id_jadwal_kegiatan."'>". $value->kegiatan."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan </label>
                    <input type="text" class="form-control" name='keterangan'>
                </div>
                <div class="form-group">
                    <label>Foto Laporan&nbsp;
                    <a href="#" id="btAdd" title="Tambah" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-plus"></i></a> &nbsp;
                    <a href="#" id="btRemove" title="Hapus" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-minus"></i></a></label> 
                    &nbsp;&nbsp;<a id='jml'></a>
                    <script>
                        $(document).ready(function() {
                            var iCnt = 0;
                            var container = $(document.createElement('div'));
                            $('#btAdd').click(function() {
                                if (iCnt <= 19) {

                                    iCnt = iCnt + 1;

                                    $(container).append('<div id=tb' + iCnt + ' ' + '>'
                                    +'<div class="form-group row"> <div class="col-md-3"> <input type="file" name="files[]" class="form-control" required> </div> <div class="col-md-9"> <input type="text" name="keterangan_foto[]" class="form-control" placeholder="Keterangan foto" required> </div> </div> </div>');
                                    if (iCnt == 1) {

                                        var divSubmit = $(document.createElement('div'));
                                        $(divSubmit).append('<input type="hidden" class="bt"' +
                                            'onclick="GetTextValue()"' +
                                            'id=btSubmit value=Submit />');
                                    }
                                    $('#main').after(container, divSubmit);
                                    $('#jml').html('(' + iCnt + ')');
                                }
                                else {
                                    $(container).append('<label>Reached the limit</label>');
                                    $('#btAdd').attr('class', 'bt-disable');
                                    $('#btAdd').attr('disabled', 'disabled');
                                }
                            });
                            $('#btRemove').click(function() {
                                if (iCnt != 0) {
                                    $('#tb' + iCnt).remove();
                                    iCnt = iCnt - 1;
                                }
                                if (iCnt == 0) {
                                    $(container)
                                        .empty()
                                        .remove();
                                    $('#btSubmit').remove();
                                    $('#jml').html('(0)');
                                    $('#btAdd')
                                        .removeAttr('disabled')
                                        .attr('class="btn btn-clear"', 'bt');
                                }
                                $('#jml').html('(' + iCnt + ')');
                            });
                        });
                        var divValue, values = '';
                    </script>
                    <br>
                    <div id="main">
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>