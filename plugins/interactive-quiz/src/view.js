/**
 * WordPress dependencies
 */
import { store, getContext } from '@wordpress/interactivity';

store( 'quiz-block', {
	actions: {
		guessingHandler() {
			const context = getContext()

			if(context.isAnswered) return

			context.isPending = false
			context.isCorrect = context.key == context.correctAnswer
			context.isWrong = context.key != context.correctAnswer
			context.isRight = context.key == context.correctAnswer
			context.feedbackMsg = context.isRight ? 'correct answer' : 'wrong answer'
		}
	},
	callbacks: {
		initQuiz() {
			const context = getContext()
			const feedbackBoxs = document.querySelectorAll('.feedback')
			feedbackBoxs.forEach((item) => {
				item.addEventListener('animationend', () => {
					if(item.classList.contains('wrong')) {
						context.isWrong = false
					}
					if(item.classList.contains('correct')) {
						context.isCorrect = false
						context.isAnswered = true
					}
					context.isPending = true
				})
			})
		}
	}
});
