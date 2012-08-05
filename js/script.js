
$(document).ready(function(){
	
	$('#modal-editarHood').modal({
		show: false,
		keyboard: false
	}, 'toggle');

	$('#modal-desactivarCuenta').modal({
		show: false,
		keyboard: false
	}, 'toggle');

	$('#link_search_user').click(function(){
		$('#icon_general_search').removeClass('icon-search icon-tag icon-envelope');
		$('#icon_general_search').addClass('icon-user');
	});

	$('#link_search_tag').click(function(){
		$('#icon_general_search').removeClass('icon-search icon-user icon-envelope');
		$('#icon_general_search').addClass('icon-tag');
	});

	$('#link_search_email').click(function(){
		$('#icon_general_search').removeClass('icon-search icon-tag icon-user');
		$('#icon_general_search').addClass('icon-envelope');
	});

	$('#formSearch').live('keypress', function(){
		
		var search_result = $('#icon_general_search').attr('class');
		var goSearchUser = window.location.protocol +"//"+ window.location.host +"/index.php/search/searchbyusername";
		var goSearchTag = window.location.protocol +"//"+ window.location.host +"/index.php/search/searchbytag";
		var goSearchEmail = window.location.protocol +"//"+ window.location.host +"/index.php/search/searchbyemail";

		if(search_result == 'icon-user'){
			$('#formSearch').attr('action', goSearchUser);
		}else{
			if(search_result == 'icon-tag'){
				$('#formSearch').attr('action', goSearchTag);
			}else{
				if(search_result == 'icon-envelope'){
					$('#formSearch').attr('action', goSearchEmail);
				}else{

				}
			}
		}
	});

});

function startLoading(){
	$('body').append('<div class="loading-box"><img src="'+ window.location.protocol +"//"+ window.location.host + '/img/loading.gif"></div>');
	$('.loading-box').fadeIn('fast');
}

function endLoading(){
	$('.loading-box').fadeOut('fast');
}

