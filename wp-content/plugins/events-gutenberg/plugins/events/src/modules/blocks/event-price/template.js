/**
 * External dependencies
 */
import { Fragment } from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import {
	CheckboxControl,
	TextControl,
	PanelBody,
} from '@wordpress/components';
import { InspectorControls } from '@wordpress/editor';

/**
 * Internal dependencies
 */
import { Dashboard } from '@moderntribe/events/elements';
import { parser } from '@moderntribe/events/editor/utils/range';
import { sendValue } from '@moderntribe/events/editor/utils/input';
import './style.pcss';

/**
 * Module Code
 */

const renderCurrency = ({ showCurrencySymbol, currencySymbol }) => (
	showCurrencySymbol && (
		<span className="tribe-editor__event-price__currency">
			{ currencySymbol }
		</span>
	)
);

const renderPlaceholder = ({ showCost, currencySymbol, currencyPosition }) => {
	let placeholder = __( 'Add Price', 'events-gutenberg' );

	placeholder = ( 'prefix' === currencyPosition )
		? currencySymbol + ' ' + placeholder
		: placeholder + ' ' + currencySymbol;


	return ! showCost && (
		<span className="tribe-editor__event-price__label">{ placeholder }</span>
	);
};

const renderCost = ({ showCost, isFree, cost }) => {
	const parsed = parser( cost );

	let value = parsed;

	if ( isFree ) {
		value = __( 'Free', 'events-gutenberg' );
	}

	return showCost && (
		<span className="tribe-editor__event-price__cost">{ value }</span>
	);
};

const renderDescription = ({ showCostDescription, costDescription }) => (
	showCostDescription && (
		<span className="tribe-editor__event-price__description">{ costDescription }</span>
	)
);

const renderLabel = ( props ) => {
	const { currencyPosition, openDashboard } = props;
	const containerClass = classNames(
		'tribe-editor__event-price__price',
		`tribe-editor__event-price__price--${ currencyPosition }`,
	);

	return (
		<div
			className={ containerClass }
			onClick={ openDashboard }
		>
			{ renderCurrency( props ) }
			{ renderPlaceholder( props ) }
			{ renderCost( props ) }
			{ renderDescription( props ) }
		</div>
	);
};

const renderDashboard = ({
	isDashboardOpen,
	cost,
	costDescription,
	setCost,
	setDescription
}) => (
	<Dashboard isOpen={ isDashboardOpen }>
		<Fragment>
			<section className="tribe-editor__event-price__dashboard">
				<input
					className={ classNames( 'tribe-editor__event-price__input', 'tribe-editor__event-price__input--price' ) }
					name="description"
					type="text"
					placeholder={ __( 'Fixed Price or Range', 'events-gutenberg' ) }
					onChange={ sendValue( setCost ) }
					value={ cost }
				/>
				<input
					className={ classNames( 'tribe-editor__event-price__input', 'tribe-editor__event-price__input--description' ) }
					name="description"
					type="text"
					placeholder={ __( 'Description', 'events-gutenberg' ) }
					onChange={ sendValue( setDescription ) }
					value={ costDescription }
				/>
			</section>
			<footer className="tribe-editor__event-price__dashboard__footer">
				{ __( 'enter 0 as price for free events', 'events-gutenberg' ) }
			</footer>
		</Fragment>
	</Dashboard>
);

const renderUI = ( props ) => (
	<section key="event-price-box" className="tribe-editor__block">
		<div className="tribe-editor__event-price">
			{ renderLabel( props ) }
			{ renderDashboard( props ) }
		</div>
	</section>
);

const renderControls = ({
	isSelected,
	currencySymbol,
	currencyPosition,
	setSymbol,
	setCurrencyPosition,
}) => (
	isSelected && (
		<InspectorControls key="inspector">
			<PanelBody title={ __( 'Price Settings', 'events-gutenberg' ) }>
				<TextControl
					className="tribe-editor__event-price__currency-symbol-setting"
					label={ __( ' Currency Symbol', 'events-gutenberg' ) }
					value={ currencySymbol }
					placeholder={ __( 'E.g.: $', 'events-gutenberg' ) }
					onChange={ setSymbol }
				/>
				<CheckboxControl
					label={ __( 'Currency symbol follows price', 'events-gutenberg' ) }
					checked={ 'suffix' === currencyPosition }
					onChange={ setCurrencyPosition }
				/>
			</PanelBody>
		</InspectorControls>
	)
);

class EventPrice extends Component {

	componentDidMount() {
		const { onKeyDown, onClick } = this.props;
		document.addEventListener( 'keydown', onKeyDown );
		document.addEventListener( 'click', onClick );
	}

	componentWillUnmount() {
		const { onKeyDown, onClick } = this.props;
		document.removeEventListener( 'keydown', onKeyDown );
		document.removeEventListener( 'click', onClick );
	}

	render() {
		return [
			renderUI( this.props ),
			renderControls( this.props ),
		];
	}

}

EventPrice.propTypes = {
	isDashboardOpen: PropTypes.bool,
	cost: PropTypes.string,
	currencyPosition: PropTypes.oneOf( [ 'prefix', 'suffix', '' ] ),
	currencySymbol: PropTypes.string,
	costDescription: PropTypes.string,
	showCurrencySymbol: PropTypes.bool,
	showCost: PropTypes.bool,
	showCostDescription: PropTypes.bool,
	isFree: PropTypes.bool,
	setCost: PropTypes.func,
	setSymbol: PropTypes.func,
	setDescription: PropTypes.func,
	setCurrencyPosition: PropTypes.func,
	onKeyDown: PropTypes.func,
	onClick: PropTypes.func,
	openDashboard: PropTypes.func,
};

export default EventPrice;
