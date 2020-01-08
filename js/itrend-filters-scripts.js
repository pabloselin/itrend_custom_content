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
		var resultsCount = $('#itrend_results_count');
		var messages = $('#itrend_messages');
		
		if(json.length > 0) {
			messages.empty();
			table.empty();
			resultsCount.empty().append('<i class="fas fa-chevron-right"></i> Mostrando ' + json.length + ' actores');

			for(var i = 0; i < json.length; i++) {
				table.append(itrendRenderRow(json[i]));
				//console.log(itrendRenderRow(json[i]));
			}
		} else {

			resultsCount.empty().append('<i class="fas fa-chevron-right"></i> Mostrando 0 actores');
			messages.empty().append('<div class="alert alert-warning" role="alert">No se encontraron actores</div>');
			
		}
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
									<td>
										{{sector}}
									</td>
									<td>
										{{alcance_territorial}}
									</td>
									<td>
										{{tareas}}
									</td>
									<td>
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

	function itrendUglyRenderRow( data ) {
		return '<tr><td class="actor_name"><a href="' + data.permalink + '">' + data.postmeta.codigo + '<br />' + data.post_title + '</a></td><td>' + data.sector + '</td><td>' + data.alcance_territorial +'</td><td>' + data.tareas + '</td><td>' + data.acciones_grrd + '</td></tr>';
	}

});