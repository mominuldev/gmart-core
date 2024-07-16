import {InspectorControls, useBlockProps} from "@wordpress/block-editor";
import {registerBlockType} from '@wordpress/blocks';
import {
    Disabled,
    PanelBody,
    TextControl, ToggleControl
} from '@wordpress/components';

import ServerSideRender from '@wordpress/server-side-render';
import {__} from "@wordpress/i18n";

registerBlockType(
    'dmt-block/newsletter-widget', {
		apiVersion: 3,
        title: 'Dmt Newsletter',
        'icon': 'email-alt',
        'category': 'common',
        'keywords': ['newsletter', 'dmt', 'content box'],
        attributes: {
            title: {
                type: 'string',
            },
            content: {
                type: 'string',
            },
            btn_text: {
                type: 'string',
            },
            iconSwitch: {
                type: 'boolean',
                default: false
            },
        },

        edit: ({attributes, setAttributes}) => {
            const {
                content,
                btn_text,
                iconSwitch
            } = attributes;

			const blockProps = useBlockProps();

            return (
                <>
                    <div {...useBlockProps }>
                        <InspectorControls>
                            <PanelBody title={__('Newsletter Widget Content', 'gmart-core')}>
                                <TextControl
                                    label={__('Description', 'gmart-core')}
                                    value={content}
                                    onChange={(content) =>
                                        setAttributes({content})
                                    }
                                />
                                <TextControl
                                    label={__('Button Text', 'gmart-core')}
                                    value={btn_text}
                                    onChange={(btn_text) =>
                                        setAttributes({btn_text})
                                    }
                                />

                                <ToggleControl label={__('Show Icon')} value={iconSwitch} checked={iconSwitch} onChange={val => setAttributes({iconSwitch: val})}/>
                            </PanelBody>
                        </InspectorControls>
                        <Disabled>
                            <ServerSideRender
                                block="dmt-block/newsletter-widget"
                                attributes={attributes}
                            />
                        </Disabled>
                    </div>
                </>
            )
        },
    }
);