<!-- Validation JS -->
<script src="<?php echo base_url('assets/plugins/jquery-validation/js/languages/jquery.validationEngine-en.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-validation/js/jquery.validationEngine.js'); ?>" type="text/javascript"></script>

<!-- Form Validation JS -->
<script>
    $(document).ready(function(){
        $("#validationForm").validationEngine({
            promptPosition : "topLeft:0"
        });
    });
</script>