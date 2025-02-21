<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generates a unique id for aria-controls.
$unique_id = wp_unique_id( 'p-' );

// Adds the global state.
wp_interactivity_state('create-block', array());

$questionData = [
	'correctAnswer' => $attributes['correctAnswer'],
	'question' => $attributes['question'],
	'isAnswered' => false,
];
$newAnswers = [];
for($i = 0; $i < count($attributes['answers']); $i++) {
	$newAnswers[$i]['index'] = $i;
	$newAnswers[$i]['text'] = $attributes['answers'][$i];
	$newAnswers[$i]['isRight'] = false;
}
$questionData['answers'] = $newAnswers;
?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
	data-wp-interactive="create-block"
	<?php echo wp_interactivity_data_wp_context( $questionData ); ?>
>
	<h1 data-wp-text="context.question"></h1>
	<ul>
		<?php foreach ($questionData['answers'] as $answer): ?>
			<li
				<?php echo wp_interactivity_data_wp_context( $answer ); ?>
				data-wp-on--click="actions.checkAnswer"
				data-wp-init="callbacks.initAnswer"
			>
				<div>
					<?php echo $answer['text'] ?>
				</div>
				<div data-wp-bind--hidden="!context.isAnswered" style="position:relative;">
					<span style="position:absolute;top:0;left:90%;z-index:10;background-color:green;">True</span>
					<span data-wp-bind--hidden="context.isRight" style="position:absolute;top:0;left:90%;z-index:20;background-color:green;">False</span>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
