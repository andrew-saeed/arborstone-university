import './index.scss'

import Swiper from 'swiper'

window.onload = () => {
  const swiper = new Swiper('.swiper', {
    virtual: {
      enabled: true,
    },
  })
}