$(document).ready(function(){
	'use strict';
	if ($("#showmsg").length) {
		$("#send").click(function() {
			$.ajax({
				type: 'POST',
				url: '/messages',
				data: "_token=" + $('meta[name="csrf-token"]').attr('content') + '&user=' + document.location.href.split("messages/")[1] + "&message=" + $("#message").val(),
				dataType: 'html',
				success: function () {
					$("#message").val("");
				},
				complete: function () {
					setTimeout(doAjax, interval);
				}
			});
		});
		function doAjax3() {
			$.ajax({
				type: 'GET',
				url: '/' + document.location.href.split("8000/")[1],
				success: function (data) {
					data = data.split('<!-- debut -->')[1].split("<!-- fin -->")[0];
					$(".row").html(data);
				},
				complete: function () {
					setTimeout(doAjax2, interval2);
				}
			});
			setTimeout(doAjax3, interval);
		}
		setTimeout(doAjax3, interval);
	}
	 var interval = 2000;  // 1000 = 1 second, 3000 = 3 seconds
	 function doAjax() {
	 	if ($("#multi").length) {
	 		$.ajax({
	 			type: 'POST',
	 			url: '/files/' + document.location.href.split("8000/share/")[1].split("/edit")[0],
	 			data: "_method=PATCH&_token=" + $('meta[name="csrf-token"]').attr('content') + '&textarea=' + $(textarea).html(),
	 			dataType: 'html',
	 			complete: function () {
	 				setTimeout(doAjax, interval);
	 			}
	 		});
	 	}
	 }
	 setTimeout(doAjax, interval);
	 var interval2 = 10000;
	 function doAjax2() {
	 	if ($("#multi").length) {
	 		console.log('/files/' + document.location.href.split("8000/share/")[1]);
	 		$.ajax({
	 			type: 'GET',
	 			url: '/files/' + document.location.href.split("8000/share/")[1],
	 			success: function (data) {
	 				data = data.split('<div class="form-control" id="textarea" contenteditable="true" style="height: 300px;">')[1].split("<!-- findiv -->")[0];
	 				$("textarea").html(data);
	 				$("#textarea").html(data);
	 			},
	 			complete: function () {
	 				setTimeout(doAjax2, interval2);
	 			}
	 		});
	 	}
	 }
	 setTimeout(doAjax2, interval2);

	 setTimeout(function(){
	 	$('.content').addClass('wow animated fadeIn');
	 	$('.loader-container').addClass('hidden');
	 }, 100);

	 $("#order").click(function() {
	 	document.execCommand('insertOrderedList', false, "");
	 });
	 $("#unorder").click(function() {
	 	document.execCommand('insertUnorderedList', false, "");
	 });
	 $("#title").click(function() {
	 	document.execCommand('formatBlock', false, 'h1');
	 });
	 $(".type").click(function() {
	 	document.execCommand($(this).data('style'), false, '');
	 });
	 $('#link').click(function () {
	 	document.execCommand("createLink", false, prompt("Quel est le lien de votre site?"));
	 });
	 $('#image').click(function () {
	 	document.execCommand("insertImage", false, prompt("Quel est le lien de votre image?"));
	 });
	 if ($('#color') !== undefined) {
	 	$('#color').change(function () {
	 		document.execCommand('foreColor', false, $('#color')[0].value);
	 	});
	 }
	 $("textarea").text($("#textarea").html());
	 $("#textarea").bind('input propertyChange', function() {
	 	$("textarea").text($("#textarea").html());
	 });




	});
