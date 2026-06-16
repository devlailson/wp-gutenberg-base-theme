import useCategories from '../hooks/useCategories';

import { InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	ToggleControl,
	SelectControl,
	TextControl,
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

				<TextControl
					label="Buscar serviço"
					value={ attributes.busca }
					placeholder="Digite uma palavra..."
					onChange={ ( value ) =>
						setAttributes( {
							busca: value,
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

				<SelectControl
					label="Ordenação"
					value={ attributes.ordenacao }
					options={ [
						{
							label: 'Mais recentes',
							value: 'recentes',
						},
						{
							label: 'Mais antigos',
							value: 'antigos',
						},
						{
							label: 'A-Z',
							value: 'az',
						},
						{
							label: 'Z-A',
							value: 'za',
						},
					] }
					onChange={ ( value ) =>
						setAttributes( {
							ordenacao: value,
						} )
					}
				/>
				
			</PanelBody>
		</InspectorControls>
	);
}