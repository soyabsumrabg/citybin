<h3 class="text-center">Price Plan</h3>
<form id="step1-form">
    <input type="hidden" name="selected_plan_id" id="selected_plan_id" value="">
    <input type="hidden" name="selected_plan_title" id="selected_plan_title" value="">
    <input type="hidden" name="selected_plan_price" id="selected_plan_price" value="">
    <input type="hidden" name="selected_plan_period" id="selected_plan_period" value="">
</form>
<label class='switch'>
    <input type='checkbox' id='period-switch' value='1'>
    <span class='slider'></span>
</label>
<div class='switch-labels'>
    <span id='label-1' class='active'>Billed Monthly</span>
    <span id='label-12'>Billed Annually</span>
</div>
<?php 
	$json_content = citybin_fetch_price_plans_with_highest_price_grouped();
    $data = json_decode($json_content, true);
    $output = '';
    foreach ($data as $key => $priceplan) {
        $style = 'display: none;';
        $active_cls = '';
        if($key==1){
            $style = 'display: block;';
            $active_cls = 'active';
        }

        // Create a hidden section for each allowance_period
        $month_year_label = '';
        if($key==1){
            $month_year_label = 'Monthly';
        }elseif($key==12){
            $month_year_label = 'Annually';
        }
        $output .= "<div class='period-data' id='period-$key' data-period='$key' style='".$style."'>";
        $output .= "<h3>Allowance Period: $month_year_label</h3><div class='row'>";

        foreach ($priceplan as $index => $item) {
            $period = ($item['allowance_period']==1) ? 'per month' : 'per year';
            $output .= '<div class="col-md-4 mb-4" id="item_' . esc_html($item['id']) . '">'; // 3 columns per row
            $output .= '<div class="card h-100">';
            $output .= '<div class="card-body">';
            $output .= '<h5 class="card-title">' . esc_html($item['title']) . '</h5>';

            $output .= '<p class="card-text"><strong>Value:</strong> <span class="card-price">&euro; ' . esc_html($item['value']) . '</span> '.$period.'</p>';
            $output .= '<p class="card-text"><strong>Type:</strong> <span class="card-type">' . esc_html($item['type']) . '</span></p>';
            $output .= '<p class="card-text"><strong>Monthly/Annually:</strong><span class="card-period">' . esc_html($item['allowance_period']) . '</span></p>';

            // Add description with Read More button
            $output .= '<div class="description-container">';
                $output .= '<div class="short-description" id="short-desc-' . $key.$index . '">' . wp_trim_words($item['description'], 20, '...') . '</div>';
                if(str_word_count($item['description'])>20){
                    $output .= '<div class="full-description" id="full-desc-' . $key.$index . '" style="display: none;">' . $item['description'] . '</div>';
                    $output .= '<button class="btn btn-link read-more-btn" data-index="' . $key.$index . '">Read More</button>';
                }
            $output .= '</div>';
            $output .= '<button class="btn get_this_plan btn-danger" data-id="' . esc_html($item['id']) . '">Get This Plan</button>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        $output .= '</div></div>'; // Close Bootstrap row and container
    }
    echo $output;
?>