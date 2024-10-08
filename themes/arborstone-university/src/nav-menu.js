const loadNavMenu = () => {
    const mask = document.querySelector('#mask')
    const linksList = document.querySelector('#links-list')
        linksList.style.maxHeight = '0px'
    const linksListItems = linksList.querySelectorAll('li a')
        linksListItems.forEach((item, index) => {
            item.style.transition = 'transform 0.3s ease-in-out, opacity 0.3s ease-in-out'
            item.style.transitionDelay = `${index * (0.3 / linksListItems.length)}s`
            item.style.transform = 'translateX(-150px)'
            item.style.opacity = '0'
        })
    
    // menu trigger
    const trigger = document.querySelector('#trigger')
    const handleMenuToggle = () => {
        if(linksList.style.maxHeight === '0px') {
            linksList.style.transitionDelay = `0s`
            linksList.style.maxHeight = linksList.scrollHeight + 'px'
            linksListItems.forEach(item => {
                item.style.transform = 'translateX(0px)'
                item.style.opacity = `1`
            })
            mask.style.opacity = '1'
        } else {
            linksList.style.transitionDelay = `0.4s`
            linksList.style.maxHeight = '0px'
            linksListItems.forEach(item => {
                item.style.transform = 'translateX(-150px)'
                item.style.opacity = `0`
            })
            mask.style.opacity = '0'
        }
    }
    trigger.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
            handleMenuToggle()
            event.preventDefault()
        } else if(event.key === 'Escape' && linksList.style.maxHeight !== '0px') {
            handleMenuToggle()
        }
    })
    trigger.addEventListener('click', handleMenuToggle)
}

export default loadNavMenu