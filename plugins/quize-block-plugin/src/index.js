wp.blocks.registerBlockType('quize/quize', {
    title: 'Quize',
    icon: 'smiley',
    category: 'common',
    attributes: {
        question: {type: 'string'},
        answer1: {type: 'string'},
        answer2: {type: 'string'},
        answer3: {type: 'string'},
        answer4: {type: 'string'}
    },
    edit(props) {
        const updateQuestion = (e) => {
            props.setAttributes({question: e.target.value})
        }
        const updateAnswer1 = (e) => {
            props.setAttributes({answer1: e.target.value})
        }
        const updateAnswer2 = (e) => {
            props.setAttributes({answer2: e.target.value})
        }
        const updateAnswer3 = (e) => {
            props.setAttributes({answer3: e.target.value})
        }
        const updateAnswer4 = (e) => {
            props.setAttributes({answer4: e.target.value})
        }

        return <div>
            <h4><input type="text" placeholder="question" value={props.attributes.question} onChange={updateQuestion} /></h4>
            <ul>
                <li>
                    <input type="text" placeholder="answer 1" value={props.attributes.answer1} onChange={updateAnswer1} />
                </li>
                <li>
                    <input type="text" placeholder="answer 2" value={props.attributes.answer2} onChange={updateAnswer2} />
                </li>
                <li>
                    <input type="text" placeholder="answer 3" value={props.attributes.answer3} onChange={updateAnswer3} />
                </li>
                <li>
                    <input type="text" placeholder="answer 4" value={props.attributes.answer4} onChange={updateAnswer4} />
                </li>
            </ul>
        </div>
    },
    save(props) {
        return null
    }
})