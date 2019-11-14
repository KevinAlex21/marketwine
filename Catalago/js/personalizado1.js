$(document).ready(function () {
	$('a[data-confirm]').click(function (ev) {
		var href = $(this).attr('href');
		if (!$('#confirm-delete').length) {
			$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-info text-white">Pedido Cadastrato<div class="modal-body">Seu pedido foi registrado,você pode acompanha-lo na sua pagina de pedidos</div><div class="modal-footer"><a class="btn btn-info text-white" id="dataComfirmOK">OK</a></div></div></div></div>');
		}
		$('#dataComfirmOK').attr('href', href);
		$('#confirm-delete').modal({ show: true });
		return false;

	});
});