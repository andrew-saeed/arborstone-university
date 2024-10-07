import loadNavMenu from "./nav-menu"

window.onload = () => {
    // init mask
    const mask = document.querySelector('#mask')
    mask.addEventListener('transitionend', () => {
        if(mask.style.opacity === '0') mask.style.visibility = 'hidden'
    })
    // load nav menu
    loadNavMenu()
}