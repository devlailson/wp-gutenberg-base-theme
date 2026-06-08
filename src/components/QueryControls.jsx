import useCategories from '../hooks/useCategories';

import { InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	ToggleControl,
	SelectControl,
} from '@wordpress/components';

export default function QueryControls( {
	attributes,
	setAttributes,
} ) {

	const {
		categorias,
		loadingCategories,
	} = useCategories();

	return (
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
				<SelectControl
				label="Categoria"
				value={ attributes.categoria }
				disabled={ loadingCategories }
				options={ [
					{
						label: loadingCategories
							? 'Carregando categorias...'
							: 'Todas',
						value: '',
					},
					...categorias.map( ( categoria ) => ( {
						label: categoria,
						value: categoria,
					} ) ),
				] }
				onChange={ ( value ) =>
					setAttributes( {
						categoria: value,
					} )
				}
			/>
			
			</PanelBody>
		</InspectorControls>
	);
}