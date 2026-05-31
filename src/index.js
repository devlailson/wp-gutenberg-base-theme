import ServicesList from './components/ServicesList';
import { registerBlockType } from '@wordpress/blocks';
import { useEffect, useState } from '@wordpress/element';
import {
	InspectorControls
} from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	ToggleControl,
	Spinner
} from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';

registerBlockType(
	'meu-tema-base/servicos-lista',
	{
		edit( props ) {
			const { attributes, setAttributes } = props;

			const [ servicos, setServicos ] = useState( [] );
			const [ loading, setLoading ] = useState( true );

			useEffect( () => {
				setLoading( true );

				apiFetch( {
					path:
						'/mtb/v1/servicos?quantidade=' +
						attributes.quantidade +
						'&destaque=' +
						attributes.somenteDestaques,
				} ).then( ( response ) => {
					setServicos( response );
					setLoading( false );
				} );
			}, [ attributes.quantidade, attributes.somenteDestaques ] );

			return (
				<div className="mtb-editor-preview">
					<InspectorControls>
						<PanelBody title="Configurações" initialOpen={ true }>
							<RangeControl
								label="Quantidade"
								value={ attributes.quantidade }
								onChange={ ( value ) =>
									setAttributes( { quantidade: value } )
								}
								min={ 1 }
								max={ 12 }
							/>

							<ToggleControl
								label="Somente destaques"
								checked={ attributes.somenteDestaques }
								onChange={ ( value ) =>
									setAttributes( {
										somenteDestaques: value,
									} )
								}
							/>
						</PanelBody>
					</InspectorControls>

					<h3>Lista de Serviços</h3>

					{ loading ? (
						<Spinner />
					) : (
						<ServicesList servicos={ servicos } />
					) }
				</div>
			);
		},

		save() {
			return null;
		},
	}
);