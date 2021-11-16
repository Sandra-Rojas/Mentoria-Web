require('./bootstrap');
//const { default: axios } = require('axios')

//DOM JS
const message_el= document.getElementById('messages')
const username_input = document.getElementById('username')
const message_input = document.getElementById('message_input')
const message_form = document.getElementById('message_form')

message_form.addEventListener('submit', function(e){
    e.preventDefault()

    let hasError = false

    if (username_input.value ==''){
        alert ('Enter a username')
        hasError= true
    }

    if (message_input.value ==''){
        alert ('Enter a message')
        hasError= true
    }

    // console.log(username_input.value)
    // console.log(message_input.value)

    if (hasError){
        return
    }

    const options = {
        method: 'post',
        url: '/send-message',    
        data: {
            username: username_input.value,
            message:  message_input.value        
        }
    }

    window.axios(options)

})

window.Echo.channel('chat')
.listen('.message', (e) => {
    //console.log(e)
    message_el.innerHTML += '<div class= "message"><strong>' + e.username + ':</strong>' + e.message + '</div>'
})