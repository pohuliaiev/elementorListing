<?php
$market = get_terms(array(
	'taxonomy' => 'market',
	'hide_empty' => false, // Set to false to include empty terms
));
$city = get_terms(array(
	'taxonomy' => 'localization',
	'hide_empty' => false, // Set to false to include empty terms
));?>
<div class="form-group d-block mb-5">
    <div class="row g-0 ms-sm-n2 p-2">
        <div class="col-md-12 d-sm-flex align-items-center justify-content-between">
            <?php if($market){?>
            <div class="dropdown" data-bs-toggle="select" data-id="<?php echo $market[0]->term_id;?>" id="market-select">
                <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="dropdown-toggle-label"> <?php echo $market[0]->name;?> </span>
                </button>
                <ul class="dropdown-menu filter-dropdown" data-select="market-select">
                    <?php foreach ($market as $item){
                        echo '<li data-id="'.$item->term_id.'"><a class="dropdown-item" href="#"><span class="dropdown-item-label">'.$item->name.'</span></a></li>';
                    }?>

                </ul>
            </div>
            <?php }?>
            <?php if($city){?>
            <div class="dropdown" data-bs-toggle="select" data-id="<?php echo $city[0]->term_id;?>" id="city-select">
                <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="dropdown-toggle-label"> <?php echo $city[0]->name;?>  </span>
                </button>
                <ul class="dropdown-menu filter-dropdown" data-select="city-select">
	                <?php foreach ($city as $item){
		                echo '<li data-id="'.$item->term_id.'"><a class="dropdown-item" href="#"><span class="dropdown-item-label">'.$item->name.'</span></a></li>';
	                }?>
                </ul>
            </div>
            <?php }?>
            <?php if($city || $market){?>
            <div class="elementor-button-wrapper">
                <a href="#" class="elementor-button elementor-button-link elementor-size-sm" id="listing-filter-submit">
                    <span class="elementor-button-content-wrapper">
                        <span class="elementor-button-text">Procurar</span>
                    </span>
                </a>
            </div>
            <?php }?>
        </div>


    </div>
</div>
