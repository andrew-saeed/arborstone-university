import React, {useState, useEffect, useRef} from 'react'
import ReactDOM from 'react-dom'

import './frontend.scss'

const quizeBoxes = document.querySelectorAll('.quize-box')

quizeBoxes.forEach(function(div) {
    const data = JSON.parse(div.querySelector('pre').innerHTML)
    ReactDOM.render(<Quize {...data} />, div)
})

function Quize(props) {
    const [isCorrect, setIsCorrect] = useState("pending")
    const feedbackBox = useRef(null)

    useEffect(() => {
        feedbackBox.current.addEventListener('animationend', () => {
            if(feedbackBox.current.parentNode.classList.contains('wrong')) setIsCorrect('pending')
        })
    }, [])

    const checkAnswer = (index) => {

        if(props.correctAnswer === index) {
            setIsCorrect("correct")
        } else {
            setIsCorrect("wrong")
        }
    }

    return <div className="quiz">
        <p>{props.question}</p>
        <ul>
            {
                props.answers.map( (answer, index) => {
                    return <li onClick={() => checkAnswer(index)}>{answer}</li>
                })
            }
        </ul>
        <div className={"feedback " + isCorrect}>
            <div ref={feedbackBox} className="box">
                { isCorrect === 'correct' && <div>correct answer</div> }
                { isCorrect === 'wrong' && <div>worng answer</div> }
            </div>
        </div>
    </div>
}