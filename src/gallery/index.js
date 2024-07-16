// Gutentberg Gallery Component

import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { InspectorControls, MediaUpload } from '@wordpress/block-editor'
import { Fragment } from '@wordpress/element'
import { PanelBody } from '@wordpress/components'

registerBlockType('dmt-block/dmt-gallery', {
	title: __('Dmt Gallery', 'create-block'),
	icon: 'shield',
	category: 'common',
	keywords: [
		__('Gallery', 'create-block'),
		__('Dmt', 'create-block'),
		__('Image', 'create-block'),
	],
	attributes: {
		images: {
			type: 'array',
			default: [],
		},
	},
	edit: (props) => {
		const { className, attributes, setAttributes } = props
		const { images } = attributes

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title="Settings" initialOpen={false}>
						<MediaUpload
							onSelect={(media) => {
								setAttributes({
									images: [...images, media]
								})

							}}
							multiple={true}
							render={({ open }) => (
								<>
									<button onClick={open}>
										{images.length === 0
											? '+ Upload file'
											: 'x Upload new file'}
									</button>
									<p>
										{images.length === 0
											? ''
											: '(' + images.length + ' images)'}
									</p>
								</>
							)}
						/>
					</PanelBody>
				</InspectorControls>
				<div className={className}>
					{images.length === 0
						? <p>Upload images</p>
						: images.map((image, index) => {
							return <img src={image.url} alt={image.alt} />

						})
					}
				</div>
			</Fragment>
		)
	},
	save: (props) => {
		const { className, attributes, setAttributes } = props
		const { images } = attributes

		return (
			<div className={className}>
				{images.length === 0
					? <p>Upload images</p>
					: images.map((image, index) => {
						return <img src={image.url} alt={image.alt} />
					} )
				}
			</div>
		)
	},
})
