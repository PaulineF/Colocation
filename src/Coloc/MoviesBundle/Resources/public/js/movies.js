function searchFilm(){
	var title = $("#searchFilmTitle").val();

	if(title){
		$.ajax("http://www.omdbapi.com/?apikey=8bb45b28&type=movie&s="+title)
		.done(function(response){
			if(response.Error){
				alert(response.Error)
			}else{
				var selectDom = document.createElement("select");
				$.each( response.Search, function( key, value ) {
					var option = document.createElement("option");
					option.value = value.imdbID;
					option.innerHTML  = value.Title;
				  	selectDom.append(option)
				});

				$(selectDom).attr("onchange", "selectMovie()");
				$('#resultSearch').html(selectDom);

			}
			
		})
	}else{
		$('#resultSearch').html("");
	}
	
}

function selectMovie(){
	$("#coloc_moviesbundle_choice_filmId").val($('#resultSearch').find("select").val());
}