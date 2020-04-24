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
        <!--begin::Form-->
        <form class="kt-form" action="<?=base_url('admin_side/simpan_data_admin');?>" method="post" enctype='multipart/form-data'>
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label>Nama Lengkap <font color='red'>*</font></label>
                    <input type="text" class="form-control" name='nama' required>
                    <!-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> -->
                </div>
                <hr>
                <div class="form-group">
                    <label for="exampleInputPassword1">Username <font color='red'>*</font></label>
                    <input type="text" class="form-control" name='un' id="exampleInputPassword1" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Kata Sandi <font color='red'>*</font></label>
                    <input type="password" class="form-control" name='ps' id="exampleInputPassword1" placeholder="Minimal 5 karakter" minlength='5' required>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>
</div>

<!-- end:: Content -->