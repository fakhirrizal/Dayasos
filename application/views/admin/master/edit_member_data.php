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
                    Form Ubah Data
                </h3>
            </div>
        </div>
        <form class="kt-form" action="<?=base_url('admin_side/perbarui_data_petugas');?>" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="user_id" value="<?= md5($data_utama->id); ?>">
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label>Nama Lengkap <font color='red'>*</font></label>
                    <input type="text" class="form-control" name='nama' value='<?= $data_utama->fullname; ?>' required>
                </div>
                <div class="form-group">
                    <label>Alamat </label>
                    <input type="text" class="form-control" name='alamat' value='<?= $data_utama->alamat; ?>'>
                </div>
                <div class="form-group">
                    <label>Nomor HP </label>
                    <input type="text" class="form-control" name='no_hp' value='<?= $data_utama->no_hp; ?>'>
                </div>
                <div class="form-group">
                    <label>Email </label>
                    <input type="email" class="form-control" name='email' value='<?= $data_utama->email; ?>'>
                </div>
                <div class="form-group">
                    <label>NIP </label>
                    <input type="text" class="form-control" name='nip' value='<?= $data_utama->nip; ?>'>
                </div>
                <div class="form-group">
                    <label>Jabatan </label>
                    <input type="text" class="form-control" name='jabatan' value='<?= $data_utama->jabatan; ?>'>
                </div>
                <hr>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username <font color='red'>*</font></label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value='<?= $data_utama->username; ?>' readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Kata Sandi </label>
                    <input type="password" class="form-control" name='ps' id="exampleInputPassword1" placeholder="Minimal 5 karakter" minlength='5'>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>