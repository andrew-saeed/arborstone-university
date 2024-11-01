import './index.scss'
import {TextControl, Flex, FlexBlock, FlexItem, Icon, Button} from '@wordpress/components'

(() => {
    let locked = false

    wp.data.subscribe(() => {
        const results = wp.data.select('core/block-editor').getBlocks().filter((block) => {
            return block.name === 'quize/quize' && block.attributes.correctAnswer === null
        })

        if(results.length && locked == false) {
            locked = true
            wp.data.dispatch('core/editor').lockPostSaving('noanswer')
        }

        if(!results.length && locked) {
            locked = false
            wp.data.dispatch('core/editor').unlockPostSaving('noanswer')
        }
    })
})()

wp.blocks.registerBlockType('quize/quize', {
    title: 'Quize',
    icon: 'smiley',
    category: 'common',
    attributes: {
        question: {type: 'string'},
        answers: {type: 'array', default: []},
        correctAnswer: {type: 'number', default: null}
    },
    edit(props) {
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

        return <div className="quize-edit-block">
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
    },
    save(props) {
        return null
    }
})