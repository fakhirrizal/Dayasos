<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
            <h3>Catatan</h3>
            <p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi.</p>
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
        <form class="kt-form" action="<?= base_url(); ?>admin/Master/simpan_data_timeline" method="post" enctype='multipart/form-data'>
			<input type="hidden" name="from" value="jadwal_kegiatan">
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label>Direktorat <font color='red'>*</font></label>
                    <input type="text" class="form-control" name='direktorat' required>
                </div>
                <div class="form-group">
                    <label>Sub-Direktorat </label>
                    <input type="text" class="form-control" name='subdirektorat' >
                </div>
                <div class="form-group">
                    <label>Kegiatan </label>
                    <input type="text" class="form-control" name='kegiatan' >
                </div>
                <div class="form-group">
                    <label>Tanggal </label>
                    <input type="date" class="form-control" name='tanggal' >
                </div>
                <div class="form-group">
                    <label>Lokasi </label>
                    <input type="text" class="form-control" name='lokasi' >
                </div>
                <div class="form-group">
                    <label>Peserta </label>
                    <input type="text" class="form-control" name='peserta' >
                </div>
                <div class="form-group">
                    <label>Surat </label>
                    <input type="file" class="form-control" name='foto' >
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