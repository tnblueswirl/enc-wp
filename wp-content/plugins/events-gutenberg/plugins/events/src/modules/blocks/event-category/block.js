/**
 * External dependencies
 */
import classNames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';

import {
	InspectorControls,
} from '@wordpress/editor';

/**
 * Internal dependencies
 */
import { getSetting } from '@moderntribe/events/editor/settings';
import './style.pcss';

import {
	TermsList,
} from '@moderntribe/events/elements';

/**
 * Module Code
 */

export default class EventCategory extends Component {
	constructor() {
		super( ...arguments );
	}

	render() {
		return [
			this.renderUI(),
		];
	}

	renderUI() {
		return (
			<section key="event-category-box" className="tribe-editor__block">
				<div className="tribe-editor__event-category">
					{ this.renderList() }
				</div>
			</section>
		);
	}

	renderList() {
		return (
			<TermsList
				slug="tribe_events_cat"
				label={ __( 'Event Category', 'events-gutenberg' ) }
				renderEmpty={ __( 'Add Event Categories in document settings', 'events-gutenberg' ) }
			/>
		);
	}
}

