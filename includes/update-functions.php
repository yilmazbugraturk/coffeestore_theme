<?php

add_filter( 'site_transient_update_themes', 'coffeestore_update_themes' );

function coffeestore_update_themes( $transient ) {
	$stylesheet = get_template();
	$theme = wp_get_theme();
	$version = $theme->get( 'Version' );

	$remote = wp_remote_get(
		'https://themes.yilmazturk.site/updates/coffeestore.info.json',
		array(
			'timeout' => 10,
			'headers' => array(
				'Accept' => 'application/json'
			)
		)
	);

	if(
		is_wp_error( $remote )
		|| 200 !== wp_remote_retrieve_response_code( $remote )
		|| empty( wp_remote_retrieve_body( $remote ) )
	) {
		return $transient;
	}

	$remote = json_decode( wp_remote_retrieve_body( $remote ) );

	if( ! $remote ) {
		return $transient;
	}

	$data = array(
		'theme' => $stylesheet,
		'url' => $remote->details_url,
		'new_version' => $remote->version,
		'package' => $remote->download_url,
	);

	if(
		$remote
		&& version_compare( $version, $remote->version, '<' )
	) {

		$transient->response[ $stylesheet ] = $data;

	} else {

		$transient->no_update[ $stylesheet ] = $data;

	}

	return $transient;

}