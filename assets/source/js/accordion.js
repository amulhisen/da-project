export function setupAccordions(toggles) {
   if(toggles.length) {
      toggles.forEach(toggle => {
         toggle.addEventListener('click', accordionHandler)
      })
   }
}

function accordionHandler() {
   const button = this
   const panel = this.parentNode.nextElementSibling

   /* true/false value comes through as string and not boo */
   if(button.getAttribute('aria-expanded') === 'false') {
      button.ariaExpanded = true
   }
   else {
      button.ariaExpanded = false
   }

   button.classList.toggle('active')
   panel.classList.toggle('active')
}