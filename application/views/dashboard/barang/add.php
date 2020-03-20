<form id="parsley-form" class="form-horizontal" novalidate name="form_add">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label">Kode Barang<span class="required">*</span></label>
        <input type="text" class="form-control" name="kode" required="required">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label">Nama Barang<span class="required">*</span></label>
        <input type="text" class="form-control" name="nama" required="required">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label">Harga<span class="required">*</span></label>
        <input type="text" class="form-control" name="harga" required="required">
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label class="control-label">Stok<span class="required">*</span></label>
        <input type="text" class="form-control" name="stok" required="required">
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> <?php echo lang('btn_save') ?></button>
        </div>
    </div>
</form>
<script>
    $("#parsley-form").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('app/create_barang') ?>",
            form_selector = "form[name='form_add']";

        submitForm(null, form_selector, link);
        return false;
    });
</script>