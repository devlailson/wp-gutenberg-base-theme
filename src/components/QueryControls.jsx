import { InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	ToggleControl,
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
			</PanelBody>
		</InspectorControls>
	);
}