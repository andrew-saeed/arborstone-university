/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

import {TextControl, Flex, FlexBlock, FlexItem, Icon, Button} from '@wordpress/components'

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

	const updateQuestion = (value) => {
		props.setAttributes({question: value})
	}

	const addNewAnswer = () => {
		props.setAttributes({answers: [...props.attributes.answers, '']})
	}

	const deleteAnAnswer = (answerToDeleteindex) => {
		const newAnswers = props.attributes.answers.filter( (_, index) => index != answerToDeleteindex )
		props.setAttributes({answers: newAnswers})

		if(props.attributes.correctAnswer === answerToDeleteindex) {
			props.setAttributes({correctAnswer: null})
		}
	}

	const setCorrectAnswer = (index) => {
		props.setAttributes({correctAnswer: index})   
	}
	
	return <div { ...blockProps }>
		<div className="quize-edit-block" >
			<TextControl className="question" label="question" placeholder="question" value={props.attributes.question} onChange={updateQuestion} />
			<p>Answers:</p>
			<ul>
				{
					props.attributes.answers.map( (answer, index) => {
						return <li key={index}>
							<Flex>
								<FlexBlock>
									<TextControl className="answer" placeholder="answer" value={answer} onChange={ newValue => {
										const newAnswers = [...props.attributes.answers]
										newAnswers[index] = newValue
										props.setAttributes({answers: newAnswers})
									} } />
								</FlexBlock>
								<FlexItem>
									<Icon onClick={() => setCorrectAnswer(index)} className="mark-as-correct" icon={props.attributes.correctAnswer === index ? 'star-filled' : 'star-empty'} />
								</FlexItem>
								<FlexItem>
									<Button onClick={()=>deleteAnAnswer(index)}>Delete</Button>
								</FlexItem>
							</Flex>
						</li>
					})
				}
			</ul>
			<p>
				<Button onClick={()=>addNewAnswer()} isPrimary>Add New Answer</Button>
			</p>
		</div>
	</div>
}
