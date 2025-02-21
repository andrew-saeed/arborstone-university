import { Button, TextControl } from '@wordpress/components'

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {Element} Element to render.
 */

export default function Edit( props ) {
	const blockProps = useBlockProps();
	
	const addAnswer = () => {
		props.setAttributes({answers: [...props.attributes.answers, '']})
	}

	const updateAnswer = (value, index) => {
		const answers = [...props.attributes.answers]
		answers[index] = value
		props.setAttributes({answers})
	}

	const removeAnswer = (targetAnswerIndex) => {
		const answers = props.attributes.answers.filter((_, index) => index !== targetAnswerIndex)
		props.setAttributes({answers})

		if(props.attributes.correctAnswer === targetAnswerIndex) props.setAttributes({correctAnswer: null})
	}
	
	return <div { ...blockProps }>
		<p>
			<TextControl value={props.attributes.question} onChange={(value)=>props.setAttributes({question: value})} />
		</p>
		<ul>
			{
				props.attributes.answers.map((answer, index) => {
					return <li>
						<TextControl value={answer} onChange={(value)=>updateAnswer(value, index)} />
						<button onClick={()=>removeAnswer(index)}>remove</button>
						<button onClick={()=>props.setAttributes({correctAnswer: index})}>
							{
								props.attributes.correctAnswer === index && <span>correct answer</span>
							}
							{
								props.attributes.correctAnswer !== index && <span>set as correct answer</span>
							}
						</button>
					</li>
				})
			}
		</ul>
		<p>
			<Button onClick={()=>addAnswer()}>add answer</Button>
		</p>
	</div>
}
