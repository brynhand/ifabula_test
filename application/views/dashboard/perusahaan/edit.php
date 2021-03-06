<form id="parsley-form" class="form-horizontal" novalidate name="form_edit">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label">Kode Perusahaan<span class="required">*</span></label>
        <input type="text" class="form-control" name="kode" required="required" value="<?php echo $record->kode ?>">
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label">Nama Perusahaan<span class="required">*</span></label>
        <input type="text" class="form-control" name="nama" required="required" value="<?php echo $record->nama ?>">
    </div>
    <div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> <?php echo lang('btn_update') ?></button>
            <button type="button" class="btn btn-danger cancel"><i class="fas fa-undo"></i> <?php echo lang('btn_cancel') ?></button>
        </div>
    </div>
</form>
<script>
    $("#parsley-form").parsley().on('field:validated',function(){}).on('form:submit', function(){
        var link = "<?php echo base_url('app/update_perusahaan/'.$record->id) ?>",
            form_selector = "form[name='form_edit']";

        submitForm(null, form_selector, link);
        return false;
    });

    $(".cancel").on('click', function() {
        if(confirm('<?php echo lang('dialog_abandon_changes') ?>')) {
            // Load Form Add
            let form_add = sendAjax('<?php echo base_url('app/create_perusahaan') ?>');
            $(".form-action-panel .x_panel .x_content").html(form_add);
        } else {
            return false;
        }
    });
</script>