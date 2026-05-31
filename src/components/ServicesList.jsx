export default function ServicesList( { servicos } ) {

	return (
		<div className="grid-servicos">

			{ servicos.map( ( servico ) => (

				<article
					className="card-servico"
					key={ servico.id }
				>

					{ servico.thumbnail && (

						<img
							src={ servico.thumbnail }
							alt={ servico.title }
							style={ {
								width: '100%',
								height: 'auto',
								borderRadius: '10px',
							} }
						/>

					) }

					<h4>{ servico.title }</h4>

					{ servico.categoria && (

						<p>
							<strong>Categoria:</strong>{' '}
							{ servico.categoria }
						</p>

					) }

					{ servico.preco && (

						<p>
							<strong>Preço:</strong> R$ { servico.preco }
						</p>

					) }

				</article>

			) ) }

		</div>
	);

}