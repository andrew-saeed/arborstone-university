import loadNavMenu from "./nav-menu"

window.onload = () => {
    // init mask
    const mask = document.querySelector('#mask')
    mask.addEventListener('transitionend', () => {
        if(mask.style.opacity === '0') {
            mask.style.visibility = 'hidden'
        }
    })
    mask.addEventListener('transitionstart', () => {
        if(mask.style.opacity === '1') { 
            mask.style.visibility = 'visible'
            document.body.style.overflowY = 'hidden'
        } else if(mask.style.opacity === '0') {
            document.body.style.overflowY = 'scroll'
        }
    })
    // load nav menu
    loadNavMenu()
}