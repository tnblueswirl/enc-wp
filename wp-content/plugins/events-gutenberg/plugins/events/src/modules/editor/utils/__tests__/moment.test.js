/**
 * External dependencies
 */
import moment from 'moment/moment';

/**
 * Internal dependencies
 */
import * as m from '@moderntribe/events/editor/utils/moment';

import { HALF_HOUR_IN_SECONDS, HOUR_IN_SECONDS } from '@moderntribe/events/editor/utils/time';
import { FORMATS } from '@moderntribe/events/editor/utils/date';

const FORMAT = 'MM-DD-YYYY HH:mm:ss';

describe( 'Tests for moment.js', () => {
	let console;
	beforeAll( () => {
		console = window.console;
		window.console = {
			...console,
			warn: jest.fn(),
		};
	} );

	afterAll( () => {
		window.console = console;
	} );

	test( 'roundTime', () => {
		const test1 = m.roundTime(
			moment( '05-09-2018 12:26:02', FORMAT ),
		);
		expect( test1 ).toBeInstanceOf( moment );
		expect( test1.hour() ).toEqual( 12 );
		expect( test1.minutes() ).toEqual( 0 );
		expect( test1.seconds() ).toEqual( 0 );

		const test2 = m.roundTime(
			moment( '05-09-2018 15:30:02', FORMAT ),
		);
		expect( test2 ).toBeInstanceOf( moment );
		expect( test2.hour() ).toEqual( 15 );
		expect( test2.minutes() ).toEqual( 30 );
		expect( test2.seconds() ).toEqual( 0 );

		const test3 = m.roundTime(
			moment( '05-09-2018 23:59:59', FORMAT ),
		);
		expect( test3 ).toBeInstanceOf( moment );
		expect( test3.hour() ).toEqual( 23 );
		expect( test3.minutes() ).toEqual( 30 );
		expect( test3.seconds() ).toEqual( 0 );

		const test4 = m.roundTime(
			moment( '05-09-2018 08:01:59', FORMAT ),
		);
		expect( test4 ).toBeInstanceOf( moment );
		expect( test4.hour() ).toEqual( 8 );
		expect( test4.minutes() ).toEqual( 0 );
		expect( test4.seconds() ).toEqual( 0 );
	} );

	test( 'toMoment', () => {
		const input = m.toMoment( new Date( 'January 2, 2015 08:01:59 UTC' ).toISOString() );

		expect( input ).toBeInstanceOf( moment );
		expect( input.date() ).toEqual( 2 );
		expect( input.month() ).toEqual( 0 );
		expect( input.year() ).toEqual( 2015 );
		expect( input.hour() ).toEqual( 8 );
		expect( input.minutes() ).toEqual( 1 );
		expect( input.seconds() ).toEqual( 59 );
		expect( input.milliseconds() ).toEqual( 0 );
		expect( input.format( FORMAT ) ).toEqual( '01-02-2015 08:01:59' );
	} );

	test( 'replaceDate', () => {
		expect( () => m.replaceDate( 'Sample string', 123123 ) ).toThrowError();

		const a = moment( '02-28-2010 14:24:40', FORMAT );
		const b = moment( '05-10-2012 20:14:20', FORMAT );

		const replaced = m.replaceDate( a, b );
		expect( replaced ).toBeInstanceOf( moment );
		expect( replaced.date() ).toEqual( 10 );
		expect( replaced.month() ).toEqual( 4 );
		expect( replaced.year() ).toEqual( 2012 );
		expect( replaced.hour() ).toEqual( 14 );
		expect( replaced.minute() ).toEqual( 24 );
		expect( replaced.second() ).toEqual( 40 );
		expect( replaced.format( FORMAT ) ).toEqual( '05-10-2012 14:24:40' );
	} );

	test( 'setTimeInSeconds', () => {
		expect( () => m.setTimeInSeconds( 'Sample String', 123123 ) ).toThrowError();

		const a = moment( '02-28-2010 14:24:40', FORMAT );
		const SECONDS = ( 12.5 ) * 60 * 60;
		const replaced = m.setTimeInSeconds( a, SECONDS );
		expect( replaced ).toBeInstanceOf( moment );
		expect( replaced.date() ).toEqual( 28 );
		expect( replaced.month() ).toEqual( 1 );
		expect( replaced.year() ).toEqual( 2010 );
		expect( replaced.hour() ).toEqual( 12 );
		expect( replaced.minute() ).toEqual( 30 );
		expect( replaced.seconds() ).toEqual( 0 );
		expect( replaced.milliseconds() ).toEqual( 0 );

		const test2 = m.setTimeInSeconds( a, 0 );
		expect( test2.date() ).toEqual( 28 );
		expect( test2.month() ).toEqual( 1 );
		expect( test2.year() ).toEqual( 2010 );
		expect( test2.hour() ).toEqual( 0 );
		expect( test2.minute() ).toEqual( 0 );
		expect( test2.seconds() ).toEqual( 0 );
		expect( test2.milliseconds() ).toEqual( 0 );
	} );

	test( 'totalSeconds', () => {
		expect( m.totalSeconds( null ) ).toEqual( 0 );
		expect( m.totalSeconds( new Date() ) ).toEqual( 0 );
		expect( m.totalSeconds( moment().startOf( 'day' ) ) ).toEqual( 0 );
		expect( m.totalSeconds( moment( 'May 23, 2018 12:30 am', 'MMM D, YYYY k:m a' ) ) )
			.toEqual( HALF_HOUR_IN_SECONDS );
	} );

	test( 'toDateTime', () => {
		const converted = m.toDateTime( moment() );
		expect( typeof converted ).toBe( 'string' );
		const format = m.toFormat( FORMATS.DATABASE.datetime );
		expect( converted ).toBe( moment().format( format ) );
	} );

	test( 'toDate', () => {
		const converted = m.toDate( moment() );
		expect( typeof converted ).toBe( 'string' );
		expect( typeof converted ).toBe( 'string' );
		const format = m.toFormat( FORMATS.WP.date );
		expect( converted ).toBe( moment().format( format ) );
	} );

	test( 'toDateNoYear', () => {
		const converted = m.toDateNoYear( moment() );
		expect( typeof converted ).toBe( 'string' );
		expect( converted ).toBe( moment().format( 'MMMM D' ) );
	} );

	test( 'toTime', () => {
		const converted = m.toTime( moment() );
		expect( typeof converted ).toBe( 'string' );
		expect( converted ).toBe( moment().format( 'h:mm a' ) );
	} );

	test( 'toDatePicker', () => {
		const converted = m.toDatePicker( moment() );
		expect( typeof converted ).toBe( 'string' );
		expect( converted ).toBe( moment().format( 'YYYY-MM-DDTHH:mm:ss' ) );
	} );

	test( 'isSameDay', () => {
		expect( m.isSameDay( moment(), moment().endOf( 'day' ) ) ).toBeTruthy();
		expect( m.isSameDay( moment().endOf( 'day' ), moment().endOf( 'day' ) ) ).toBeTruthy();
		expect( m.isSameDay( moment(), moment().add( 10, 'days' ) ) ).toBeFalsy();
		expect( m.isSameDay( new Date(), new Date() ) ).toBeTruthy();
	} );

	test( 'isSameYear', () => {
		expect( m.isSameYear(
			moment( 'May 23, 2018 12:30 am', 'MMM D, YYYY k:m a' ),
			moment( 'September 15, 2018 5:30 am', 'MMM D, YYYY k:m a' )
		) ).toBeTruthy();
		expect( m.isSameYear(
			moment( 'May 23, 2022 12:30 am', 'MMM D, YYYY k:m a' ),
			moment( 'September 15, 2022 5:30 am', 'MMM D, YYYY k:m a' )
		) ).toBeTruthy();
		expect( m.isSameYear(
			moment( 'May 23, 2018 12:30 am', 'MMM D, YYYY k:m a' ),
			moment( 'September 15, 2022 5:30 am', 'MMM D, YYYY k:m a' )
		) ).toBeFalsy();
	} );

	test( 'toMomentFromDate', () => {
		expect( () => m.toMomentFromDate( '' ) ).toThrowError();
		expect( () => m.toMomentFromDate( moment() ) ).toThrowError();
		Date.now = jest.fn( () => '2018-05-04T05:23:19.000Z' );
		const format = 'YYYY-MM-DD HH:mm:ss';
		const now = new Date( 'December 17, 2015 03:24:00' );
		expect( m.toMomentFromDate( now ) ).toBeInstanceOf( moment );
		const expected = m.toMomentFromDate( now ).format( format );
		expect( expected ).toBe( '2015-12-17 00:00:00' );
	} );

	test( 'toFormat', () => {
		expect( m.toFormat( '' ) ).toEqual( '' );
		expect( m.toFormat( 'Y-m-d H:i:s' ) ).toEqual( 'YYYY-MM-DD HH:mm:ss' );
		expect( m.toFormat( 'F j, Y g:i a' ) ).toEqual( 'MMMM D, YYYY h:mm a' );
		expect( m.toFormat( 'tLBIOPTZcr' ) ).toEqual( '' );
		expect( m.toFormat( 'd' ) ).toEqual( 'DD' );
		expect( m.toFormat( 'D' ) ).toEqual( 'ddd' );
		expect( m.toFormat( 'j' ) ).toEqual( 'D' );
		expect( m.toFormat( 'l' ) ).toEqual( 'dddd' );
		expect( m.toFormat( 'N' ) ).toEqual( 'E' );
		expect( m.toFormat( 'S' ) ).toEqual( 'o' );
		expect( m.toFormat( 'w' ) ).toEqual( 'e' );
		expect( m.toFormat( 'z' ) ).toEqual( 'DDD' );
		expect( m.toFormat( 'W' ) ).toEqual( 'W' );
		expect( m.toFormat( 'F' ) ).toEqual( 'MMMM' );
		expect( m.toFormat( 'm' ) ).toEqual( 'MM' );
		expect( m.toFormat( 'M' ) ).toEqual( 'MMM' );
		expect( m.toFormat( 'n' ) ).toEqual( 'M' );
		expect( m.toFormat( 'o' ) ).toEqual( 'YYYY' );
		expect( m.toFormat( 'Y' ) ).toEqual( 'YYYY' );
		expect( m.toFormat( 'y' ) ).toEqual( 'YY' );
		expect( m.toFormat( 'a' ) ).toEqual( 'a' );
		expect( m.toFormat( 'A' ) ).toEqual( 'A' );
		expect( m.toFormat( 'g' ) ).toEqual( 'h' );
		expect( m.toFormat( 'G' ) ).toEqual( 'H' );
		expect( m.toFormat( 'h' ) ).toEqual( 'hh' );
		expect( m.toFormat( 'H' ) ).toEqual( 'HH' );
		expect( m.toFormat( 'i' ) ).toEqual( 'mm' );
		expect( m.toFormat( 's' ) ).toEqual( 'ss' );
		expect( m.toFormat( 'u' ) ).toEqual( 'SSS' );
		expect( m.toFormat( 'e' ) ).toEqual( 'zz' );
		expect( m.toFormat( 'U' ) ).toEqual( 'X' );
	} );

	describe( 'parseFormats', () => {
		test( 'Use DB format', () => {
			const format = 'YYYY-MM-DD HH:mm:ss';
			const expected = m.parseFormats( '2019-11-19 22:32:00' );
			expect( expected.format( format ) ).toBe( '2019-11-19 22:32:00' );
		} );

		test( 'Use WP datetime format', () => {
			const format = 'MMMM D, YYYY h:mm a';
			const expected = m.parseFormats( 'November 19, 2019 10:32 pm' );
			expect( expected.format( format ) ).toBe( 'November 19, 2019 10:32 pm' );
		} );

		test( 'Invalid date', () => {
			Date.now = jest.fn( () => new Date( 'July 1, 2018 00:07:31 UTC' ).toISOString() );
			const format = 'YYYY-MM-DD HH:mm:ss';
			const expected = m.parseFormats( 'No date!' );
			expect( expected.format( format ) ).toBe( '2018-07-01 00:07:31' );
			expect( window.console.warn ).toHaveBeenCalled();
		} );
	} );

	describe( 'resetTimes', () => {
		const format = 'YYYY-MM-DD HH:mm:ss';
		it( 'Should add an hour in seconds', () => {
			const startMoment = moment( new Date( 'July 19, 2018 19:30:00 UTC' ).toISOString() );
			const { start, end } = m.resetTimes( startMoment );
			expect( start.format( format ) ).toBe( '2018-07-19 19:30:00' );
			expect( end.format( format ) ).toBe( '2018-07-19 20:30:00' );
		} );

		it( 'Should add hour in seconds on start of the day', () => {
			const startMoment = moment( new Date( 'July 19, 2018 00:00:00 UTC' ).toISOString() );
			const { start, end } = m.resetTimes( startMoment );
			expect( start.format( format ) ).toBe( '2018-07-19 00:00:00' );
			expect( end.format( format ) ).toBe( '2018-07-19 01:00:00' );
		} );

		it( 'Should prevent overflow to the next day', () => {
			const startMoment = moment( new Date( 'July 19, 2018 23:59:59 UTC' ).toISOString() );
			const { start, end } = m.resetTimes( startMoment );
			expect( start.format( format ) ).toBe( '2018-07-19 22:59:59' );
			expect( end.format( format ) ).toBe( '2018-07-19 23:59:59' );
		} );
	} );

	describe( 'adjustStart', () => {
		const format = 'YYYY-MM-DD HH:mm:ss';
		it( 'Should keep the same order when start is before', () => {
			const start = moment( new Date( 'July 10, 2018 14:30:00 UTC' ).toISOString() );
			const end = moment( new Date( 'July 10, 2018 20:35:00 UTC' ).toISOString() );
			const output = m.adjustStart( start, end );
			expect( output.start.format( format ) ).toBe( '2018-07-10 14:30:00' );
			expect( output.end.format( format ) ).toBe( '2018-07-10 20:35:00' );
		} );

		it( 'Should adjust the start and end time', () => {
			const start = moment( new Date( 'July 10, 2018 20:35:00 UTC' ).toISOString() );
			const end = moment( new Date( 'July 10, 2018 10:30:00 UTC' ).toISOString() );
			const output = m.adjustStart( start, end );
			expect( output.start.format( format ) ).toBe( '2018-07-10 20:35:00' );
			expect( output.end.format( format ) ).toBe( '2018-07-10 21:35:00' );
		} );
	} );
} );
