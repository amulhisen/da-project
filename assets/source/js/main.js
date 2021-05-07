import { setupAccordions } from './accordion'
import { formAddListeners } from './form'

window.addEventListener('load', () => {
   
   const [...toggles] = document.getElementsByClassName('toggle')

   function initial() {
      setupAccordions(toggles)
      formAddListeners()
   }
      
   initial()

})