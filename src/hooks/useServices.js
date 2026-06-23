import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

export default function useServices(
	quantidade,
	somenteDestaques,
	categoria,
	ordenacao,
	busca,
	pagina
) {
	const [ servicos, setServicos ] = useState( [] );

	const [ loading, setLoading ] = useState( true );

	const [ total, setTotal ] = useState( 0 );

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
				ordenacao +
				'&busca=' +
				busca +
				'&pagina=' +
				pagina,
		} ).then( ( response ) => {
			setServicos( response.items );
            setTotal( response.total );
		} );
	}, [ quantidade, somenteDestaques, categoria, ordenacao, busca, pagina ] );

	return {
		servicos,
		total,
		loading,
	};
}