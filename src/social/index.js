import {registerBlockType} from '@wordpress/blocks';
import {InspectorControls, RichText, useBlockProps, ColorPalette} from "@wordpress/block-editor";
import {
    Panel,
    PanelBody,
    PanelRow,
    ToggleControl,
    TextControl
} from '@wordpress/components';
import {__} from "@wordpress/i18n";

registerBlockType(
    'dmt-block/dmt-social-links-widget', {
        title: 'Dmt Social Links Widget',
        icon: 'phone',
        category: 'widgets',
        keywords: ['contact info', 'dmt', 'social'],
        attributes: {

            title: {
                type: 'string',
                source: 'html',
                selector: 'h4',
            },

            iconColor: {
                type: 'string',
            },

            textColor: {
                type: 'string',
            },

            phone: {
                type: 'string',
                source: 'html',
                selector: '.dmt-block-phone-number',
            },

            email: {
                type: 'string',
                source: 'html',
                selector: '.dmt-block-email-id',
            },

            location: {
                type: 'string',
                source: 'html',
                selector: '.dmt-block-location-address',
            },

            showSociallinks: {
                type: 'boolean',
                default: true
            },
            facebook: {
                type: 'string',
                source: 'attribute',
                selector: '.dmt-social-facebook',
                attribute: 'href'
            },

            twitter: {
                type: 'string',
                source: 'attribute',
                selector: '.dmt-social-twitter',
                attribute: 'href'
            },

            instagram: {
                type: 'string',
                source: 'attribute',
                selector: '.dmt-social-instagram',
                attribute: 'href'
            },
            dribbble: {
                type: 'string',
                source: 'attribute',
                selector: '.dmt-social-dribbble',
                attribute: 'href'
            },
            linkedin: {
                type: 'string',
                source: 'attribute',
                selector: '.dmt-social-linkedin',
                attribute: 'href'
            },
        },
        supports: {
            color: true // Enables background and text
        },


        edit: ({attributes, setAttributes}) => {
            const {
                title,
                facebook,
                twitter,
                instagram,
                dribbble,
                linkedin,
                iconColor,
                textColor,
                showSociallinks,
            } = attributes;

            return (
                <>
                    <InspectorControls>
                        <PanelBody title={__('Style')}>
                            <ColorPalette
                                label={__('Icon Color')}
                                value={ iconColor }
                                onChange={ ( colorValue ) => setAttributes( { iconColor: colorValue } ) }
                                styleHandle=".site-footer .widget ul li a"
                                allowReset
                            />

                            <ColorPalette
                                label={__('Text Color')}
                                value={ textColor }
                                onChange={ ( colorValue ) => setAttributes( { textColor: colorValue } ) }
                                allowReset
                            />
                        </PanelBody>
                        <PanelBody title={__('Social Links')}>
                            <ToggleControl label={__('Show Social links')} value={showSociallinks} checked={showSociallinks} onChange={val => setAttributes({showSociallinks: val})}/>

                            {showSociallinks &&
                            <>
                                <TextControl label={__('Facebook')} value={facebook} onChange={val => setAttributes({facebook: val})}/>
                                <TextControl label={__('Twitter')} value={twitter} onChange={val => setAttributes({twitter: val})}/>
                                <TextControl label={__('Instagram')} value={instagram} onChange={val => setAttributes({instagram: val})}/>
                                <TextControl label={__('Dribbble')} value={dribbble} onChange={val => setAttributes({dribbble: val})}/>
                                <TextControl label={__('Linkedin')} value={linkedin} onChange={val => setAttributes({linkedin: val})}/>
                            </>
                            }
                        </PanelBody>
                    </InspectorControls>
                    <div className="dmt_block_contact_info_widget">
                        {showSociallinks && (facebook || twitter || instagram || linkedin || dribbble || title) &&
                        <>

                            <RichText
                                key="title"
                                className="dmt-block-social-title"
                                tagName="h4"
                                value={title}
                                allowedFormats={['core/bold', 'core/italic']}
                                onChange={(title) => setAttributes({title})}
                                placeholder="Social Title..."
                            />

                            <ul className="dmt-block-social-link">
                                {facebook &&
                                <li>
                                    <a className="dmt-social-facebook"><i className="fab fa-facebook-f"/></a>
                                </li>
                                }
                                {twitter &&
                                <li>
                                    <a className="dmt-social-twitter"><i className="fab fa-twitter"/></a>
                                </li>
                                }
                                {instagram &&
                                <li>
                                    <a className="dmt-social-instagram"><i className="fab fa-instagram"/></a>
                                </li>
                                }
                                {linkedin &&
                                <li>
                                    <a className="dmt-social-linkedin"><i className="fab fa-linkedin-in"/></a>
                                </li>
                                }
                                {dribbble &&
                                <li>
                                    <a className="dmt-social-dribbble"><i className="fab fa-dribbble"/></a>
                                </li>
                                }
                            </ul>
                        </>
                        }
                    </div>

                </>
            )
        },

        save: ({attributes}) => {
            const {
                title,
                facebook,
                twitter,
                instagram,
                linkedin,
                dribbble,
                iconColor,
                textColor,
                showSociallinks
            } = attributes;

            return (
                <>
                    <div className="dmt_block_contact_info_widget">


                        {showSociallinks && (facebook || twitter || instagram || linkedin || dribbble || title) &&
                        <>
                            <h4 className="dmt-block-social-title">{title}</h4>
                            <ul className="dmt-block-social-link">
                                {facebook &&
                                <li>
                                    <a href={facebook} className="dmt-social-facebook" target="_blank" rel="noopener noreferrer"><i className="fab fa-facebook-f"/></a>
                                </li>
                                }
                                {twitter &&
                                <li>
                                    <a href={twitter} className="dmt-social-twitter" target="_blank" rel="noopener noreferrer"><i className="fab fa-twitter"/></a>
                                </li>
                                }
                                {instagram &&
                                <li>
                                    <a href={instagram} className="dmt-social-instagram" target="_blank" rel="noopener noreferrer"><i className="fab fa-instagram"/></a>
                                </li>
                                }
                                {linkedin &&
                                <li>
                                    <a href={linkedin} className="dmt-social-linkedin" target="_blank" rel="noopener noreferrer"><i className="fab fa-linkedin-in"/></a>
                                </li>
                                }
                                {dribbble &&
                                <li>
                                    <a href={dribbble} className="dmt-social-dribbble" target="_blank" rel="noopener noreferrer"><i className="fab fa-dribbble"/></a>
                                </li>
                                }
                            </ul>
                        </>
                        }
                    </div>
                </>
            )
        }
    }
);