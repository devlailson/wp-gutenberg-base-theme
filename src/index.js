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
				total,
				loading,
			} = useServices(
				attributes.quantidade,
				attributes.somenteDestaques,
				attributes.categoria,
				attributes.ordenacao,
				attributes.busca
			);

			return (
				<div className="mtb-editor-preview">
					<QueryControls
						attributes={ attributes }
						setAttributes={ setAttributes }
					/>

					<h3>Lista de Serviços</h3>

					<p>
						{ total === 1
							? '1 serviço encontrado'
							: `${ total } serviços encontrados` }
					</p>

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