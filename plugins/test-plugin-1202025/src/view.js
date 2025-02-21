/**
 * WordPress dependencies
 */
import { store, getContext } from '@wordpress/interactivity';

const { state } = store( 'create-block', {
	actions: {
		checkAnswer() {
			const context = getContext()
			context.isAnswered = true
		}
	},
	callbacks: { 
		initAnswer() {
			const context = getContext()
			context.isRight = context.correctAnswer === context.index
		}
	},
} );
