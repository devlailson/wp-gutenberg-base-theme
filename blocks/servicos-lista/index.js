( function ( blocks, element ) {

	const el = element.createElement;

	blocks.registerBlockType( 'meu-tema-base/servicos-lista', {

		edit: function () {

			return el(
				'div',
				{
					style: {
						padding: '20px',
						border: '1px solid #ddd',
						borderRadius: '12px'
					}
				},

				el( 'h3', {}, 'Lista de Serviços' ),

				el(
					'p',
					{},
					'Meu primeiro bloco Gutenberg personalizado.'
				)

			);

		},

		save: function () {

			return null;

		}

	} );

} )( window.wp.blocks, window.wp.element );