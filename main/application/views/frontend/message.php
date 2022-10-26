<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class = "panel-body">
                <h4 class = "text-center"><?php echo $message; ?></h4>
            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function(){
   		$("#myModal").modal('show');
   });
</script>	


