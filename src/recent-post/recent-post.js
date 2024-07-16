// Post Gutenberg Block: Recent Post

import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';

// Panel
import { InspectorControls } from '@wordpress/block-editor';

registerBlockType( 'mytheme-blocks/recent-post', {
    title: __( 'Recent Post', 'mytheme-blocks' ),
    description: __( 'A custom block for displaying recent post.', 'mytheme-blocks' ),
    category: 'widgets',
    icon: 'admin-post',
    keywords: [ __( 'recent post', 'mytheme-blocks' ) ],
    attributes: {
        title: {
            type: 'string',
            source: 'html',
            selector: 'h2',
        },
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },
        postPerPage: {
            type: 'number',
            default: 3,
        },
        category: {
            type: 'string',
            default: 'all',
        },
        showMeta: {
            type: 'boolean',
            default: true,
        },
        postType: {
            type: 'string',
            default: 'post',
        }
    },
    edit: ( props ) => {
        const { attributes: { title, content, postPerPage, category, showMeta, postType }, className, setAttributes } = props;

        const onChangeTitle = ( value ) => {
            setAttributes( { title: value } );
        };

        const onChangeContent = ( value ) => {
            setAttributes( { content: value } );
        };

        const onChangePostPerPage = ( value ) => {
            setAttributes( { postPerPage: value } );
        };

        const onChangeCategory = ( value ) => {
            setAttributes( { category: value } );
        };

        const onChangeShowMeta = ( value ) => {
            setAttributes( { showMeta: value } );
        };

        const onChangePostType = ( value ) => {
            setAttributes( { postType: value } );
        };

        return (
            <div className={ className }>
                <InspectorControls>
                    <div className="components-base-control">
                        <div className="components-base-control__field">
                            <label className="components-base-control__label" htmlFor="post-type">Post Type</label>
                            <select
                                id="post-type"
                                className="components-select-control__input"
                                value={ postType }
                                onChange={ ( event ) => onChangePostType( event.target.value ) }
                            >
                                <option value="post">Post</option>
                                <option value="page">Page</option>
                            </select>
                        </div>
                    </div>
                    <div className="components-base-control">
                        <div className="components-base-control__field">
                            <label className="components-base-control__label" htmlFor="post-per-page">Post Per Page</label>
                            <input
                                id="post-per-page"
                                className="components-text-control__input"
                                type="number"
                                value={ postPerPage }
                                onChange={ ( event ) => onChangePostPerPage( event.target.value ) }
                            />
                        </div>
                    </div>
                    <div className="components-base-control">
                        <div className="components-base-control__field">
                            <label className="components-base-control__label" htmlFor="category">Category</label>
                            <select
                                id="category"
                                className="components-select-control__input"
                                value={ category }
                                onChange={ ( event ) => onChangeCategory( event.target.value ) }
                            >
                                <option value="all">All</option>
                                <option value="1">Category 1</option>
                                <option value="2">Category 2</option>
                                <option value="3">Category 3</option>
                            </select>
                        </div>
                    </div>
                    <div className="components-base-control">
                        <div className="components-base-control__field">
                            <label className="components-base-control__label" htmlFor="show-meta">Show Meta</label>
                            <input
                                id="show-meta"
                                className="components-checkbox-control__input"
                                type="checkbox"
                                checked={ showMeta }
                                onChange={ ( event ) => onChangeShowMeta( event.target.checked ) }
                            />
                        </div>
                    </div>
                </InspectorControls>
                <RichText
                    tagName="h2"
                    placeholder={ __( 'Write title…', 'mytheme-blocks' ) }
                    value={ title }
                    onChange={ onChangeTitle }
                />
                <RichText
                    tagName="p"
                    placeholder={ __( 'Write content…', 'mytheme-blocks' ) }
                    value={ content }
                    onChange={ onChangeContent }
                />
            </div>
        );
    }

});