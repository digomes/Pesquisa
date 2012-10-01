$(function () {
	function removeCampo() {
		$(".removerCampo").unbind("click");
		$(".removerCampo").bind("click", function () {
			i=0;
			$(".modelos p.campomodelos").each(function () {
				i++;
			});
			if (i>1) {
				$(this).parent().remove();
			}
		});
	}
	removeCampo();
	$(".adicionarCampo").click(function () {
		novoCampo = $(".modelos p.campomodelos:first").clone();
		novoCampo.find("input").val("");
		novoCampo.insertAfter(".modelos p.campomodelos:last");
		removeCampo();
	});
});
