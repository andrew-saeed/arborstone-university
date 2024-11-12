<? $blockContext = [
	'isPending' => true,
	'isCorrect' => false,
	'isWrong' => false,
	'isAnswered' => false,
	'feedbackMsg' => '',
	'answers' => $attributes['answers'],
	'question' => $attributes['question'],
	'correctAnswer' => $attributes['correctAnswer']
] ?>

<div 
	data-wp-interactive="quiz-block" 
	<?= wp_interactivity_data_wp_context($blockContext) ?>
	data-wp-init="callbacks.initQuiz"
>
	<div class="quiz">
        <p class="quiz-question" data-wp-text="context.question" data-wp-class--standout="context.isAnswered"></p>
        <ul class="quiz-answers">
			<!-- <template data-wp-each="context.answers">
				<li class="test-class" data-wp-on--click="actions.guessingHandler" data-wp-text="context.item"></li>
			</template> -->
			<? foreach($attributes['answers'] as $key => $value): ?>
				<li
					data-wp-context='{"key":"<?= $key ?>", "isRight":false}' 
					data-wp-on--click="actions.guessingHandler"
					data-wp-class--standout="context.isRight"
				>
					<?= $value ?>
				</li>
			<? endforeach ?>
        </ul>
		<div class="feedback-mask" data-wp-class--standout="context.isAnswered"></div>
        <div class="feedback"
			data-wp-class--pending="context.isPending"
			data-wp-class--correct="context.isCorrect"
			data-wp-class--wrong="context.isWrong"
		>
            <div class="box">
				<div data-wp-text="context.feedbackMsg"></div>
            </div>
        </div>
    </div>
</div>
