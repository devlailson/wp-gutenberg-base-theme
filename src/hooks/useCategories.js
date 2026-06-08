import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

export default function useCategories() {
	const [ categorias, setCategorias ] = useState( [] );
	const [ loadingCategories, setLoadingCategories ] = useState( true );

	useEffect( () => {
		setLoadingCategories( true );

		apiFetch( {
			path: '/mtb/v1/categorias',
		} ).then( ( response ) => {
			setCategorias( response );
			setLoadingCategories( false );
		} );
	}, [] );

	return {
		categorias,
		loadingCategories,
	};
}