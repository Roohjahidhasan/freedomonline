<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
	$("#btnSave").show();
    if($("#btnSave").attr("is_single") == 1){
        $(".edit").trigger("click");
    }
	$('#search').DataTable();
    $('select').select2();
</script>