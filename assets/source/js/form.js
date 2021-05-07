var ES6Promise = require("es6-promise")
require('formdata-polyfill')
require("es6-symbol/implement")

ES6Promise.polyfill()
const axios = require('axios')

export function formAddListeners() {
   const form = document.getElementById('inquiryForm')

   if(form) {
      form.addEventListener('submit', (e) => submit(e))
   }
}

function submit(e) {
   e.preventDefault()
   
   const endpoint = e.target.getAttribute('data-endpoint')
   const formData = new FormData(e.target)
   
   return axios.post(endpoint, formData)
   .then(() => {
      submitted(e.target)
   })
}

export function submitted(form) {
   const thanks = document.getElementById('formThanks')

   form.classList.add('hide')
   thanks.classList.add('active')
}