class Filter{
    constructor() {
        this.dropdownElement = document.querySelectorAll('.filter-dropdown')
        this.filterButton = document.getElementById('listing-filter-submit')
        this.marketSelect = document.getElementById('market-select')
        this.citySelect = document.getElementById('city-select')
        this.cityId = this.citySelect.getAttribute('data-id')
        this.marketId = this.marketSelect.getAttribute('data-id')
        this.preloader = document.getElementById('preloader')
        this.overlay = document.getElementById('fadeOverlay')
        this.events()
    }
    events(){
        this.dropdownElement.forEach(function (item) {
            const selectId = item.getAttribute('data-select')
            const selectDiv = document.getElementById(selectId)

            const liElements = item.querySelectorAll('li')

            liElements.forEach(function (li){
                li.addEventListener('click', function() {
                    selectDiv.setAttribute('data-id', li.getAttribute('data-id'))
                })
            })
        })

        if(this.filterButton){

            const loader = this.preloader
            const overlay = this.overlay
            this.filterButton.addEventListener('click', (e) => {
                const cityId = document.getElementById('city-select').getAttribute('data-id')
                const marketId = document.getElementById('market-select').getAttribute('data-id')
                console.log(cityId,marketId)
                e.preventDefault()
                loader.classList.remove('d-none')
                overlay.style.display = "block"
                jQuery.ajax({
                    type: 'POST',
                    url: elementorListingsAjax.ajaxurl,
                    data: {
                        action: 'elementor_listings_ajax_request',
                        nonce: elementorListingsAjax.nonce,
                        city_id: cityId,
                        market_id: marketId
                    },
                    success: function(response) {
                        loader.classList.add('d-none')
                        overlay.style.display = "none"
                        console.log('AJAX response:', response)
                        document.getElementById('listing-wrapper').innerHTML = ''
                        const content = response.data.map(item => `
                        <div class="card listing-widget-item">
                    <img src="${item.image}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary">${item.market}</h4>
                        <a href="${item.link}"><h5 class="card-title">${item.title}</h5></a>
                        <p class="mb-2 fs-sm text-muted">${item.adress}</p>
                        <div class="hp-listing__attributes hp-listing__attributes--primary">
                            <div class="fw-bold">
                                <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>
                                $ ${item.price}
                            </div>
                        </div>
                        <div class="card-footer mt-4 d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap hp-listing__attributes hp-listing__attributes--secondary">
                            <span class="d-inline-block mx-1 px-2 fs-sm">${item.rooms}
                                <i class="finder-icon ms-1 mt-n1 fs-lg text-muted fi-bed"></i>
                            </span>
                            <span class="d-inline-block mx-1 px-2 fs-sm">${item.bathroom}
                                <i class="finder-icon ms-1 mt-n1 fs-lg text-muted fi-bath"></i>
                            </span>
                            ${item.parking === 'on' ? `<span class="d-inline-block mx-1 px-2 fs-sm"><i class="finder-icon ms-1 mt-n1 fs-lg text-muted fi-car"></i></span>` : ''}
                           
                        </div>
                    </div>
                </div>
                        `).join('')
                        document.getElementById('listing-wrapper').insertAdjacentHTML('beforeend', content)
                        // Update UI or perform other actions based on response
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('AJAX request failed');
                        console.error(xhr.responseText);
                    }
                })
            })
        }


    }
}

export default Filter