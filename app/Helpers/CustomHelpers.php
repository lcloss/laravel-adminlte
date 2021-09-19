<?php

if ( !function_exists( 'check_if_tenant_is_present' ) ) {
    function check_if_tenant_id_is_present()
    {
        return ( session()->has('tenant_id') && !is_null( session()->get('tenant_id') ) );
    }
}

if ( !function_exists( 'get_formatted_currency' ) ) {
    function get_formatted_currency(int|float $value, string $currency = null): string {
        if ( is_null( $value ) ) {
            return '';
        }

        if ( app()->getLocale() == 'en' ) {
            $decimal_point = '.';
            $thousand_separator = ',';
            $currency_symbol = ( $currency ?? '$' );
        } else {
            $decimal_point = ',';
            $thousand_separator = '.';
            $currency_symbol = ( $currency ?? '€' );
        }

        return sprintf('%s ' . $currency_symbol, number_format( $value, 2, $decimal_point, $thousand_separator ) );
    }
}

if ( !function_exists( 'get_badge' ) ) {
    function get_badge(string $text, string $color, string $icon = '') {
        if ( $icon == '' ) {
            $icon = '<i class="bx bxs-circle me-1"></i>';
        }
        return '<div class="badge rounded-pill text-' . $color . ' bg-light-' . $color . ' p-2 px-3" style="font-size: 1em;">' . $icon . ' ' .  $text . '</div>';
        // return '<div class="badge rounded-pill text-light bg-' . $color . ' p-2 px-3" style="font-size: 1.05em;">' . $icon . ' ' .  $text . '</div>';
    }
}

if ( !function_exists('get_icons_list' ) ) {
    function get_icons_list() {
        $icons = [];
        $config_icons = config('constants.icons');
        foreach( $config_icons as $code => $panel_icon ) {
            $icons[$code] = __('global.icons.' . $code);
        }
        return $icons;
    }
}

if ( !function_exists( 'get_colors_list') ) {
    function get_colors_list()
    {
        $colors = [];
        $config_colors = config('constants.colors');
        foreach ($config_colors as $code => $panel_color) {
            $colors[$code] = __('global.colors.' . $code);
        }
        return $colors;
    }
}
