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
    'dmt-block/dmt-contact-info-widget', {
        title: 'Dmt Contact Info Widget',
        icon: 'phone',
        category: 'widgets',
        keywords: ['contact info', 'dmt', 'contact'],
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
                default: false
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
                phone,
                email,
                location,
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
                            <ToggleControl label={__('Show Social-links')} value={showSociallinks} checked={showSociallinks} onChange={val => setAttributes({showSociallinks: val})}/>

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
                        <ul className="dmt-block-contact-info">

                            <li className="dmt-block-location">
                                <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.00002 11.6053C10.5987 11.6053 11.8947 10.3093 11.8947 8.71059C11.8947 7.11191 10.5987 5.81592 9.00002 5.81592C7.40134 5.81592 6.10535 7.11191 6.10535 8.71059C6.10535 10.3093 7.40134 11.6053 9.00002 11.6053Z" stroke="white" stroke-width="1.5"/>
                                    <path d="M1.22522 7.02129C3.05295 -1.01328 14.9564 -1.004 16.7748 7.03057C17.8418 11.7437 14.91 15.7331 12.34 18.201C10.4752 20.0009 7.52485 20.0009 5.65073 18.201C3.09006 15.7331 0.158278 11.7344 1.22522 7.02129Z" stroke="white" stroke-width="1.5"/>
                                </svg>

                                <RichText
                                    key="location"
                                    className="dmt-block-location-address"
                                    tagName="span"
                                    value={location}
                                    allowedFormats={['core/bold', 'core/italic']}
                                    onChange={(location) => setAttributes({location})}
                                    placeholder="Location..."
                                />
                            </li>

                            <li className="dmt-block-phone">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.976 14.064C16.976 14.352 16.912 14.648 16.776 14.936C16.64 15.224 16.464 15.496 16.232 15.752C15.84 16.184 15.408 16.496 14.92 16.696C14.44 16.896 13.92 17 13.36 17C12.544 17 11.672 16.808 10.752 16.416C9.832 16.024 8.912 15.496 8 14.832C7.08 14.16 6.208 13.416 5.376 12.592C4.552 11.76 3.808 10.888 3.144 9.976C2.488 9.064 1.96 8.152 1.576 7.248C1.192 6.336 1 5.464 1 4.632C1 4.088 1.096 3.568 1.288 3.088C1.48 2.6 1.784 2.152 2.208 1.752C2.72 1.248 3.28 1 3.872 1C4.096 1 4.32 1.048 4.52 1.144C4.728 1.24 4.912 1.384 5.056 1.592L6.912 4.208C7.056 4.408 7.16 4.592 7.232 4.768C7.304 4.936 7.344 5.104 7.344 5.256C7.344 5.448 7.288 5.64 7.176 5.824C7.072 6.008 6.92 6.2 6.728 6.392L6.12 7.024C6.032 7.112 5.992 7.216 5.992 7.344C5.992 7.408 6 7.464 6.016 7.528C6.04 7.592 6.064 7.64 6.08 7.688C6.224 7.952 6.472 8.296 6.824 8.712C7.184 9.128 7.568 9.552 7.984 9.976C8.416 10.4 8.832 10.792 9.256 11.152C9.672 11.504 10.016 11.744 10.288 11.888C10.328 11.904 10.376 11.928 10.432 11.952C10.496 11.976 10.56 11.984 10.632 11.984C10.768 11.984 10.872 11.936 10.96 11.848L11.568 11.248C11.768 11.048 11.96 10.896 12.144 10.8C12.328 10.688 12.512 10.632 12.712 10.632C12.864 10.632 13.024 10.664 13.2 10.736C13.376 10.808 13.56 10.912 13.76 11.048L16.408 12.928C16.616 13.072 16.76 13.24 16.848 13.44C16.928 13.64 16.976 13.84 16.976 14.064Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
                                    <path d="M14.1999 6.60078C14.1999 6.12078 13.8239 5.38478 13.2639 4.78478C12.7519 4.23278 12.0719 3.80078 11.3999 3.80078" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.9999 6.6C16.9999 3.504 14.4959 1 11.3999 1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>


                                <RichText
                                    key="phone"
                                    className="icon-label dmt-block-phone-number"
                                    tagName="span"
                                    value={phone}
                                    allowedFormats={['core/bold', 'core/italic']}
                                    onChange={(phone) => setAttributes({phone})}
                                    placeholder="Phone..."
                                />
                            </li>


                            <li className="dmt-block-email">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1761 12.864L14.4881 15.392C14.5681 16.056 13.8561 16.52 13.2881 16.176L9.93607 14.184C9.56807 14.184 9.20808 14.16 8.85608 14.112C9.44808 13.416 9.80007 12.536 9.80007 11.584C9.80007 9.31198 7.83207 7.47202 5.40007 7.47202C4.47207 7.47202 3.61608 7.736 2.90408 8.2C2.88008 8 2.87207 7.79999 2.87207 7.59199C2.87207 3.95199 6.03207 1 9.93607 1C13.8401 1 17.0001 3.95199 17.0001 7.59199C17.0001 9.75199 15.8881 11.664 14.1761 12.864Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.8 11.5846C9.8 12.5366 9.44801 13.4166 8.85601 14.1126C8.06401 15.0726 6.808 15.6886 5.4 15.6886L3.312 16.9286C2.96 17.1446 2.512 16.8486 2.56 16.4406L2.76 14.8646C1.688 14.1206 1 12.9286 1 11.5846C1 10.1766 1.752 8.93664 2.904 8.20063C3.616 7.73663 4.472 7.47266 5.4 7.47266C7.832 7.47266 9.8 9.31262 9.8 11.5846Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>


                                <RichText
                                    key="email"
                                    className="dmt-block-email-id"
                                    tagName="span"
                                    value={email}
                                    allowedFormats={['core/bold', 'core/italic']}
                                    onChange={(email) => setAttributes({email})}
                                    placeholder="Email..."
                                />
                            </li>

                        </ul>


                        {showSociallinks && (facebook || twitter || instagram || linkedin || dribbble || title) &&
                        <>


                                <h4 className="dmt-block-social-title">{title}</h4>


                            <ul className="dmt-block-social-link">
                                {facebook &&
                                <li>
                                    <a className="dmt-social-facebook"><i className="fab fa-facebook"/></a>
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
                                    <a className="dmt-social-linkedin"><i className="fab fa-linkedin-in"></i></a>
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
                phone,
                email,
                location,
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

                        {(phone || email || location) &&
                        <ul className="dmt-block-contact-info">
                            {location &&
                                <li className="dmt-block-location">
                                    <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.00002 11.6053C10.5987 11.6053 11.8947 10.3093 11.8947 8.71059C11.8947 7.11191 10.5987 5.81592 9.00002 5.81592C7.40134 5.81592 6.10535 7.11191 6.10535 8.71059C6.10535 10.3093 7.40134 11.6053 9.00002 11.6053Z" stroke="white" stroke-width="1.5"/>
                                        <path d="M1.22522 7.02129C3.05295 -1.01328 14.9564 -1.004 16.7748 7.03057C17.8418 11.7437 14.91 15.7331 12.34 18.201C10.4752 20.0009 7.52485 20.0009 5.65073 18.201C3.09006 15.7331 0.158278 11.7344 1.22522 7.02129Z" stroke="white" stroke-width="1.5"/>
                                    </svg>

                                    <span className="dmt-block-location-address" style={{ color: textColor }}> {location}</span>
                                </li>
                            }

                            {phone &&
                            <li className="dmt-block-phone">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.976 14.064C16.976 14.352 16.912 14.648 16.776 14.936C16.64 15.224 16.464 15.496 16.232 15.752C15.84 16.184 15.408 16.496 14.92 16.696C14.44 16.896 13.92 17 13.36 17C12.544 17 11.672 16.808 10.752 16.416C9.832 16.024 8.912 15.496 8 14.832C7.08 14.16 6.208 13.416 5.376 12.592C4.552 11.76 3.808 10.888 3.144 9.976C2.488 9.064 1.96 8.152 1.576 7.248C1.192 6.336 1 5.464 1 4.632C1 4.088 1.096 3.568 1.288 3.088C1.48 2.6 1.784 2.152 2.208 1.752C2.72 1.248 3.28 1 3.872 1C4.096 1 4.32 1.048 4.52 1.144C4.728 1.24 4.912 1.384 5.056 1.592L6.912 4.208C7.056 4.408 7.16 4.592 7.232 4.768C7.304 4.936 7.344 5.104 7.344 5.256C7.344 5.448 7.288 5.64 7.176 5.824C7.072 6.008 6.92 6.2 6.728 6.392L6.12 7.024C6.032 7.112 5.992 7.216 5.992 7.344C5.992 7.408 6 7.464 6.016 7.528C6.04 7.592 6.064 7.64 6.08 7.688C6.224 7.952 6.472 8.296 6.824 8.712C7.184 9.128 7.568 9.552 7.984 9.976C8.416 10.4 8.832 10.792 9.256 11.152C9.672 11.504 10.016 11.744 10.288 11.888C10.328 11.904 10.376 11.928 10.432 11.952C10.496 11.976 10.56 11.984 10.632 11.984C10.768 11.984 10.872 11.936 10.96 11.848L11.568 11.248C11.768 11.048 11.96 10.896 12.144 10.8C12.328 10.688 12.512 10.632 12.712 10.632C12.864 10.632 13.024 10.664 13.2 10.736C13.376 10.808 13.56 10.912 13.76 11.048L16.408 12.928C16.616 13.072 16.76 13.24 16.848 13.44C16.928 13.64 16.976 13.84 16.976 14.064Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
                                    <path d="M14.1999 6.60078C14.1999 6.12078 13.8239 5.38478 13.2639 4.78478C12.7519 4.23278 12.0719 3.80078 11.3999 3.80078" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.9999 6.6C16.9999 3.504 14.4959 1 11.3999 1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <span className="dmt-block-phone-number" style={{ color: textColor }}>{phone}</span>
                            </li>
                            }

                            {email &&
                            <li className="dmt-block-email">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1761 12.864L14.4881 15.392C14.5681 16.056 13.8561 16.52 13.2881 16.176L9.93607 14.184C9.56807 14.184 9.20808 14.16 8.85608 14.112C9.44808 13.416 9.80007 12.536 9.80007 11.584C9.80007 9.31198 7.83207 7.47202 5.40007 7.47202C4.47207 7.47202 3.61608 7.736 2.90408 8.2C2.88008 8 2.87207 7.79999 2.87207 7.59199C2.87207 3.95199 6.03207 1 9.93607 1C13.8401 1 17.0001 3.95199 17.0001 7.59199C17.0001 9.75199 15.8881 11.664 14.1761 12.864Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.8 11.5846C9.8 12.5366 9.44801 13.4166 8.85601 14.1126C8.06401 15.0726 6.808 15.6886 5.4 15.6886L3.312 16.9286C2.96 17.1446 2.512 16.8486 2.56 16.4406L2.76 14.8646C1.688 14.1206 1 12.9286 1 11.5846C1 10.1766 1.752 8.93664 2.904 8.20063C3.616 7.73663 4.472 7.47266 5.4 7.47266C7.832 7.47266 9.8 9.31262 9.8 11.5846Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <span className="dmt-block-email-id" style={{ color: textColor }}>{email}</span>
                            </li>
                            }
                        </ul>
                        }

                        {showSociallinks && (facebook || twitter || instagram || linkedin || dribbble || title) &&
                        <>
                            {title &&
                                <h4 className="dmt-block-social-title">{title}</h4>
                            }
                            <ul className="dmt-block-social-link">
                                {facebook &&
                                <li>
                                    <a href={facebook} className="dmt-social-facebook" target="_blank"
                                       rel="noopener noreferrer"><i className="fab fa-facebook-f"/></a>
                                </li>
                                }
                                {twitter &&
                                <li>
                                    <a href={twitter} className="dmt-social-twitter" target="_blank"
                                       rel="noopener noreferrer"><i className="fab fa-twitter"/></a>
                                </li>
                                }
                                {instagram &&
                                <li>
                                    <a href={instagram} className="dmt-social-instagram" target="_blank"
                                       rel="noopener noreferrer"><i className="fab fa-instagram"/></a>
                                </li>
                                }
                                {linkedin &&
                                <li>
                                    <a href={linkedin} className="dmt-social-linkedin" target="_blank"
                                       rel="noopener noreferrer"><i className="fab fa-linkedin-in"></i></a>
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

// Question: Please provide a short explanation of how you have developed git skill.

// Answer: I have been using git for the last 3 years. I have used git for my personal projects and also for my company projects. I have used git for version control and also for collaboration with my team members. I have used git for merging branches and also for resolving conflicts. I have used git for creating branches and also for creating pull requests. I have used git for creating tags and also for creating releases. I have used git for creating stash and also for creating rebase. I have used git for creating cherry-pick and also for creating reset. I have used git for creating revert and also for creating fetch. I have used git for creating pull and also for creating push. I have used git for creating clone and also for creating commit. I have used git for creating checkout and also for creating branch. I have used git for creating init and also for creating status. I have used git for creating log and also for creating diff. I have used git for creating add and also for creating remote. I have used git for creating stash and also for creating rebase. I have used git for creating cherry-pick and also for creating reset. I have used git for creating revert and also for creating fetch. I have used git for creating pull and also for creating push. I have used git for creating clone and also for creating commit. I have used git for creating checkout and also for creating branch. I have used git for creating init and also for creating status. I have used git for creating log and also for creating diff. I have used git for creating add and also for creating remote.

