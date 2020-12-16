		<footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    
                </nav>
                <p class="copyright pull-right">
                    © 2015 <a href="#">sieuthikhoadientu.com</a> - sieuthikhoadientu.com
                </p>
            </div>
        </footer>
	</div>
</div>

	<script src="<?=base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/jquery-migrate-1.2.1.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/jquery-ui.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/plugins/fancybox/jquery.easing-1.3.pack.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/plugins/fancybox/jquery.fancybox-1.3.4.pack.js')?>" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			$("#ProductCatSlider_form").on("focusin", function(){
				$('.iframe-btn').fancybox({	
					'width'		: 900,
					'height'	: 600,
					'type'		: 'iframe',
					'autoScale'    	: false
				});
			});
			$('.iframe-btn').fancybox({	
				'width'		: 900,
				'height'	: 600,
				'type'		: 'iframe',
				'autoScale'    	: false,
				'relative_url' : 1,
			});
			$('.fancy-img').fancybox({	
				'type'		: 'image',
				'autoScale'    	: true,
				'autoDimensions' :true,
				'relative_url' : 1,
			});
			$(".chosen-select").chosen();
		});
		
	</script>

	<script src="<?=base_url('assets/js/jquery.validate.min.js')?>"></script>
	<script src="<?=base_url('assets/js/moment.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-datetimepicker.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-selectpicker.js')?>"></script>
	<script src="<?=base_url('assets/js/bootstrap-checkbox-radio-switch.js')?>"></script>
	<script src="<?=base_url('assets/js/chartist.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-notify.js')?>"></script>
    <script src="<?=base_url('assets/js/chosen.jquery.min.js')?>"></script>
	<script src="<?=base_url('assets/js/sweetalert2.js')?>"></script>
	<script src="<?=base_url('assets/plugins/ckeditor/ckeditor.js')?>"></script>

	<script src="<?=base_url('assets/plugins/ckeditor/config.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery-jvectormap.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.bootstrap.wizard.min.js')?>"></script>
	<script src="<?=base_url('assets/js/bootstrap-table.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery.datatables.js')?>"></script>
    <script src="<?=base_url('assets/js/fullcalendar.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.sharrre.js')?>"></script>
    <script src="<?=base_url('assets/js/demo.js')?>"></script>
	<script src="<?=base_url('assets/js/light-bootstrap-dashboard.js')?>"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$(".chosen-select").chosen();
			$('#nml-sidebar').perfectScrollbar();
			$('#content-scroll').perfectScrollbar();
		});
	</script>