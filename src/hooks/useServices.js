import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

export default function useServices(
	quantidade,
	somenteDestaques,
	categoria,
	ordenacao
) {
	const [ servicos, setServicos ] = useState( [] );
	const [ loading, setLoading ] = useState( true );

	useEffect( () => {
		setLoading( true );

		apiFetch( {
			path:
				'/mtb/v1/servicos?quantidade=' +
				quantidade +
				'&destaque=' +
				somenteDestaques +
				'&categoria=' +
				categoria +
				'&ordenacao=' +
				ordenacao,
		} ).then( ( response ) => {
			setServicos( response );
			setLoading( false );
		} );
	}, [ quantidade, somenteDestaques, categoria, ordenacao ] );

	return {
		servicos,
		loading,
	};
}