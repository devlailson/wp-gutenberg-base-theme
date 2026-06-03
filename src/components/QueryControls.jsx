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
					options={ [
						{
							label: 'Todas',
							value: '',
						},
						{
							label: 'Design',
							value: 'design',
						},
						{
							label: 'Marketing',
							value: 'marketing',
						},
						{
							label: 'Desenvolvimento',
							value: 'desenvolvimento',
						},
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