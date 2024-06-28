<div class="form-group d-block mb-5">
	<div class="row g-0 ms-sm-n2 p-2">
		<div class="col-md-12 d-sm-flex align-items-center justify-content-between">
			<#
			var marketTerms = <?php echo json_encode(get_terms(array(
				'taxonomy' => 'market',
				'hide_empty' => false,
			))); ?>;

			if (marketTerms.length) { #>
			<div class="dropdown" data-bs-toggle="select" data-id="{{ marketTerms[0].term_id }}" id="market-select">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
					<span class="dropdown-toggle-label"> {{ marketTerms[0].name }} </span>
				</button>
				<ul class="dropdown-menu filter-dropdown" data-select="market-select">
					<#
					_.each(marketTerms, function(item) { #>
					<li data-id="{{ item.term_id }}"><a class="dropdown-item" href="#"><span class="dropdown-item-label">{{ item.name }}</span></a></li>
					<# }); #>
				</ul>
			</div>
			<# }

			var cityTerms = <?php echo json_encode(get_terms(array(
				'taxonomy' => 'localization',
				'hide_empty' => false,
			))); ?>;

			if (cityTerms.length) { #>
			<div class="dropdown" data-bs-toggle="select" data-id="{{ cityTerms[0].term_id }}" id="city-select">
				<button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
					<span class="dropdown-toggle-label"> {{ cityTerms[0].name }} </span>
				</button>
				<ul class="dropdown-menu filter-dropdown" data-select="city-select">
					<#
					_.each(cityTerms, function(item) { #>
					<li data-id="{{ item.term_id }}"><a class="dropdown-item" href="#"><span class="dropdown-item-label">{{ item.name }}</span></a></li>
					<# }); #>
				</ul>
			</div>
			<# } #>

			<# if (marketTerms.length || cityTerms.length) { #>
			<div class="elementor-button-wrapper">
				<a href="#" class="elementor-button elementor-button-link elementor-size-sm" id="listing-filter-submit">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-text">Procurar</span>
                            </span>
				</a>
			</div>
			<# } #>
		</div>
	</div>
</div>
