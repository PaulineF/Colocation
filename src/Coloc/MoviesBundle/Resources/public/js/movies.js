function searchFilm(elt){
	var title = $(elt).val();

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

				$(selectDom).attr("onchange", "selectMovie(this)");
				$(selectDom).attr("class", "form-control");
				$(elt).parent().append(selectDom);
				selectMovie(elt);
			}
			
		})
	}else{
		$(elt).parent().find("select").remove();
	}
	
}

function selectMovie(elt){
	$("#coloc_moviesbundle_choice_filmId").val($(elt).val());
}