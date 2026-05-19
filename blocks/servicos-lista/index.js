( function (
	blocks,
	element,
	components,
	blockEditor,
	apiFetch
) {

	const el = element.createElement;

	const useState = element.useState;
	const useEffect = element.useEffect;

	const InspectorControls = blockEditor.InspectorControls;

	const PanelBody = components.PanelBody;
	const RangeControl = components.RangeControl;
	const ToggleControl = components.ToggleControl;
	const Spinner = components.Spinner;

	blocks.registerBlockType(
		'meu-tema-base/servicos-lista',
		{

			edit: function ( props ) {

				const attributes = props.attributes;

				const [ servicos, setServicos ] = useState( [] );

				const [ loading, setLoading ] = useState( true );

				useEffect( function () {

					setLoading( true );

					apiFetch( {
						path:
							'/mtb/v1/servicos?quantidade=' +
							attributes.quantidade +
							'&destaque=' +
							attributes.somenteDestaques
					} )

					.then( function ( response ) {

						setServicos( response );

						setLoading( false );

					} );

				}, [ attributes.quantidade, attributes.somenteDestaques ] );

				return el(

					'div',

					{
						className: 'mtb-editor-preview'
					},

					el(

						InspectorControls,

						{},

						el(

							PanelBody,

							{
								title: 'Configurações',
								initialOpen: true
							},

							el(

								RangeControl,

								{
									label: 'Quantidade',

									value:
										attributes.quantidade,

									onChange: function (
										value
									) {

										props.setAttributes(
											{
												quantidade:
													value
											}
										);

									},

									min: 1,
									max: 12
								}

							),

							el(

								ToggleControl,

								{
									label:
										'Somente destaques',

									checked:
										attributes.somenteDestaques,

									onChange: function (
										value
									) {

										props.setAttributes(
											{
												somenteDestaques:
													value
											}
										);

									}
								}

							)

						)

					),

					el(
						'h3',
						{},
						'Lista de Serviços'
					),

					loading

						? el( Spinner, {} )

						: el(

							'div',

							{
								className:
									'grid-servicos'
							},

							servicos.map(
								function ( servico ) {

									return el(

										'article',

										{
											className:
												'card-servico',

											key:
												servico.id
										},

										servico.thumbnail &&

											el(
												'img',
												{
													src:
														servico.thumbnail,

													alt:
														servico.title,

													style:
														{
															width:
																'100%',

															height:
																'auto',

															borderRadius:
																'10px'
														}
												}
											),

										el(
											'h4',
											{},
											servico.title
										),

										servico.categoria &&

											el(
												'p',
												{},
												'Categoria: ' +
													servico.categoria
											),

										servico.preco &&

											el(
												'p',
												{},
												'Preço: R$ ' +
													servico.preco
											)

									);

								}

							)

						)

				);

			},

			save: function () {

				return null;

			}

		}

	);

} )(
	window.wp.blocks,
	window.wp.element,
	window.wp.components,
	window.wp.blockEditor,
	window.wp.apiFetch
);