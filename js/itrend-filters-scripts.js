jQuery(document).ready(function($) {
	console.log('scripts para filtros iniciados');
	//Inicializar en recarga
	var infoZone = $('#itrend-filters .filters-info-zone .append-zone-filter');
	var query;

	itrendScanCheckedFilters();
	itrendBuildQuery();

	 $('.collapsible').collapsible();

	//Inicializar al clicar un filtro
	$('#itrend-filters .itrend_select_taxonomy input.form-check-input').on('click', function(event) {
		itrendScanCheckedFilters();
	});

	$('#itrend-filters button[data-action="clean_filters"]').on('click', function(event) {
		var checkedFilters = $('.itrend_select_taxonomy input.form-check-input:checked');
		checkedFilters.each(function(index) {
			$(this).prop('checked', false);
		})
		infoZone.empty();
		itrendHasFilters();
		itrendScanCheckedFilters();
		itrendBuildQuery();
	});

	$('#itrend-filters button[data-action="apply_filters"]').on('click', function(event) {
		itrendScanCheckedFilters();
		itrendBuildQuery();
	});

	$('#itrend-filters form#itrend_search').on('submit', function(event) {
		event.preventDefault();
		var searchVal = $('input[data-action="search"]').val();
		itrendBuildSearch(searchVal);
	});

	function itrendScanCheckedFilters() {
		infoZone.empty();
		query = itrendInitializeQuery();

		var checkedFilters = $('.itrend_select_taxonomy input.form-check-input:checked');
	
		checkedFilters.each(function( index ) {
			var data = $(this).data();
			infoZone.append('<span class="filter-item" data-tax="' + data.tax + '" data-term="' + data.term + '">' + data.termlabel + ' <i class="fas fa-times"></i></span>');
			query[data.tax].push(data.term);	
			
		});

		itrendHasFilters();
	}

	function itrendBuildSearch(searchTerm) {
		const headers = new Headers({
			'Content-Type': 'application/json',
            'X-WP-Nonce': itrend_filters.nonce
		});

		itrendDisplayLoading();

		//console.log(searchTerm);

		var encodedTerm = encodeURIComponent(searchTerm);

		console.log(encodedTerm);

		var queryUrl = itrend_filters.search_url + '?keyword=' + encodedTerm + '&type=actor';

		fetch(queryUrl , {
			method: 'get',
			headers: headers,
			credentials: 'same-origin'
		})
		.then(function(response) {
			return response.json();
		})
		.then(function(itrendJson) {
			itrendBuildIdsTable(itrendJson)
		});
	}

	function itrendBuildIdsTable( json ) {
		
		const headers = new Headers({
			'Content-Type': 'application/json',
            'X-WP-Nonce': itrend_filters.nonce
		});

		itrendDisplayLoading();

		var ids = [];

		for(var i = 0; i < json.length; i++) {
			ids.push(json[i].id);
		} 

		var queryUrl = itrend_filters.ids_url + '?items=' + ids.join(',');

		console.log(queryUrl, 'idsqueryUrl:');

		fetch(queryUrl , {
			method: 'get',
			headers: headers,
			credentials: 'same-origin'
		})
		.then(function(response) {
			return response.json();
		})
		.then(function(itrendJson) {
			itrendPopulateTable(itrendJson);
		});
	}

	function itrendBuildQuery() {
		const headers = new Headers({
			'Content-Type': 'application/json',
            'X-WP-Nonce': itrend_filters.nonce
		});

		itrendDisplayLoading();

		var queryArray = [];

		var queries = Object.keys(query);
		var queryArray;

		for(tax in query) {
			if(query[tax].length > 0) {
				queryArray.push(tax + '=' + query[tax].join(','));	
			}
		}
		
		var joinedQuery = queryArray.join('&')
		var queryUrl = itrend_filters.rest_url + '/?' + joinedQuery;
		
		console.log(queryUrl);

		fetch(queryUrl , {
			method: 'get',
			headers: headers,
			credentials: 'same-origin'
		})
		.then(function(response) {
			return response.json();
		})
		.then(function(itrendJson) {
			itrendPopulateTable(itrendJson);
		});
	}

	function itrendInitializeQuery() {
		var query = {};
			for(var i = 0; i < itrend_filters.taxonomies.length; i++) {
				query[itrend_filters.taxonomies[i]] = [];
		}

		return query;
	}

	function itrendPopulateTable(json) {
		console.log(json);
		var table = $('#itrend_table_results > tbody.results');
		var filterButtons = $('button[data-action="apply_filters"]');
		var mobileTable = $('#itrend_mobile_results');
		var resultsCount = $('#itrend_results_count');
		var messages = $('#itrend_messages');
		
		console.log(json.length);

		if(json.length > 0) {
			messages.empty();
			table.empty();
			mobileTable.empty();
			resultsCount.empty().append('<i class="fas fa-chevron-right"></i> Mostrando ' + json.length + ' actores');

			if(jQuery.browser.mobile === true) {

				for(var i = 0; i < json.length; i++) {
					mobileTable.append(itrendRenderMobileRow(json[i]));
				}

			} else {

				for(var i = 0; i < json.length; i++) {
					table.append(itrendRenderRow(json[i]));
				}

			}


		} else {

			resultsCount.empty().append('<i class="fas fa-chevron-right"></i> Mostrando 0 actores');
			
			if(jQuery.browser.mobile === true) {
				mobileTable.empty().append('<div class="notfound-actors" role="alert">No se encontraron actores</div>');
			} else {
				table.empty().append('<div class="notfound-actors" role="alert">No se encontraron actores</div>');
			}
		
			//table.empty();
			
		}

		filterButtons.empty().append('Filtrar');
	}

	
	function itrendRenderRow(data) {
		var tableRowTemplate = `<tr>
									<td class="actor_name">
										<a href="{{permalink}}">
										{{if(options.codigo !== "undefined")}}
										<span class="codigo">{{codigo}}</span>
										{{/if}}
										<span class="title">{{post_title}}</span>
										</a>
									</td>
									<td class="sector">
										{{sector}}
									</td>
									<td class="alcance">
										{{alcance_territorial}}
									</td>
									<td class="tareas">
										{{tareas}}
									</td>
									<td class="acciones">
										{{acciones_grrd}}
									</td>
								</tr>`;

		

		var compiledTable = Sqrl.Compile(tableRowTemplate);

		return compiledTable({
			post_title: data.post_title, 
			permalink: data.permalink,
			postmeta: data.postmeta,
			codigo: data.postmeta.codigo,
			sector: data.sector,
			alcance_territorial: data.alcance_territorial,
			tareas: data.tareas,
			acciones_grrd: data.acciones_grrd
		}, Sqrl);
	}

	function itrendRenderMobileRow(data) {
		//Mobile version for actor output
		var mobileRowTemplate = `<div class="actor-mobile">
									<h2>
									<a href="{{permalink}}">{{if(options.codigo !== "undefined")}}
										<span class="codigo">{{codigo}}</span>
										{{/if}}
										<span class="title">{{post_title}}</span>
									</a>
									</h2>
									<p class="sector"><strong>Sector: </strong>{{sector}}</p>
									<p class="alcance"><strong>Alcance Territorial: </strong>{{alcance_territorial}}</p>
									<p class="tareas"><strong>Tareas: </strong>{{tareas}}</p>
									<p class="acciones_grrd"><strong>Acciones GRRD: </strong>{{acciones_grrd}}</p>
								</div>`;


		var compiledTable = Sqrl.Compile(mobileRowTemplate);

		return compiledTable({
			post_title: data.post_title, 
			permalink: data.permalink,
			postmeta: data.postmeta,
			codigo: data.postmeta.codigo,
			sector: data.sector,
			alcance_territorial: data.alcance_territorial,
			tareas: data.tareas,
			acciones_grrd: data.acciones_grrd
		}, Sqrl);
	}

	function itrendHasFilters() {
		var removeFiltersBtn = $('.btn[data-action="clean_filters"]');
		var appendZone = $('.append-zone-filter');
		removeFiltersBtn.hide();

		if(appendZone.is(':empty')) {
			removeFiltersBtn.hide();
		} else {
			removeFiltersBtn.show();
		}
	}

	function itrendDisplayLoading() {
		var table = $('#itrend_table_results > tbody.results');
		var filterButtons = $('button[data-action="apply_filters"]');
		table.empty().append('<p class="loadingmsg"><i class="fas fa-spinner fa-spin"></i> Buscando actores...</p>');
		filterButtons.empty().append('<i class="fas fa-spinner fa-spin"></i> Filtrando')
	}

	function itrendUglyRenderRow( data ) {
		return '<tr><td class="actor_name"><a href="' + data.permalink + '">' + data.postmeta.codigo + '<br />' + data.post_title + '</a></td><td>' + data.sector + '</td><td>' + data.alcance_territorial +'</td><td>' + data.tareas + '</td><td>' + data.acciones_grrd + '</td></tr>';
	}

	function itrend_download_csv(data) {
	    var csv = 'Institucion,Title\n';

	    data.forEach(function(row) {
	            csv += row.join(',');
	            csv += "\n";
	    });
	 
	    console.log(csv);
	    var hiddenElement = document.createElement('a');
	    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
	    hiddenElement.target = '_blank';
	    hiddenElement.download = 'people.csv';
	    hiddenElement.click();
	}

});