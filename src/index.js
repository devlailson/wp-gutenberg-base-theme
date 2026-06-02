import useServices from './hooks/useServices';
import ServicesList from './components/ServicesList';
import QueryControls from './components/QueryControls';

import { registerBlockType } from '@wordpress/blocks';
import { Spinner } from '@wordpress/components';

registerBlockType(
	'meu-tema-base/servicos-lista',
	{
		edit( props ) {
			const { attributes, setAttributes } = props;

			const {
				servicos,
				loading,
			} = useServices(
				attributes.quantidade,
				attributes.somenteDestaques
			);

			return (
				<div className="mtb-editor-preview">
					<QueryControls
						attributes={ attributes }
						setAttributes={ setAttributes }
					/>

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