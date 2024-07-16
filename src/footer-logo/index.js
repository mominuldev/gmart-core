// Footer Logo Gutenberg Block

import {registerBlockType} from '@wordpress/blocks';
import {__} from '@wordpress/i18n';
import { InspectorControls, MediaUpload } from '@wordpress/block-editor'
import { Fragment } from '@wordpress/element'
import { PanelBody } from '@wordpress/components'

registerBlockType('dmt-block/dmt-footer-logo', {
    title: __('Footer Logo', 'create-block'),
    icon: 'shield',
    category: 'common',
    keywords: [
        __('Footer Logo', 'create-block'),
        __('Footer', 'create-block'),
        __('Logo', 'create-block'),
    ],
    attributes: {
        logo: {
            type: 'string',
            source: 'attribute',
            selector: 'img',
            attribute: 'src',
        }
    },
    edit: (props) => {
        const { className, attributes, setAttributes } = props
        const { show } = attributes

        return (
            <Fragment>
                <InspectorControls>
                    <PanelBody title="Settings" initialOpen={false}>
                        <MediaUpload
                            onSelect={(media) => {
                                setAttributes({
                                    downloadFile: {
                                        title: media.title,
                                        filename: media.filename,
                                        url: media.url,
                                        updated: ''
                                    }
                                })
                            }}
                            multiple={false}
                            render={({ open }) => (
                                <>
                                    <button onClick={open}>
                                        {attributes.downloadFile === null
                                            ? '+ Upload file'
                                            : 'x Upload new file'}
                                    </button>
                                    <p>
                                        {attributes.downloadFile === null
                                            ? ''
                                            : '(' + attributes.downloadFile.title + ')'}
                                    </p>
                                </>
                            )}
                        />
                    </PanelBody>
                </InspectorControls>
                <div>My Block Content</div>
            </Fragment>
        )
    }
});


