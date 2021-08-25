document.addEventListener('DOMContentLoaded', () => {
    //codigo a ejecutar cuando las eqiquetas html se hayan cargado y parseado    
    // se tiene la refrencia DOM del div
    const character = document.querySelector('.character')
    const MAXIMUM_HEIGHT = 250
    const GRAVITY = 0.9
    const KEY_UP = 38
    const KEY_LEFT = 37
    const KEY_RIGHT = 39
    const KEY_DOWN = 40
    let bottom = 0
    let left = 0

    let timerLeft
    let timerRight
    let isGoingLeft = false
    let isGoingRight = false
    let isJumping = false

    //funcion jump de forma tradicional
    /*function jump(){
        //codigo salto
        //para acceder a hojas de estilo en javascript
        //character.style.bottom = '250px';
        //ejecuta codigo cada cierta cantidad de miliseg 20 miliseg
        //setInterval(() => {
        let timerUp = setInterval(() => {
            if (bottom >= MAXIMUM_HEIGHT){
                //detener salto, desactivar interval
                clearInterval(timerUp)
            }
            //le suma 30 px al bottom
            bottom += 30
            character.style.bottom = (bottom * GRAVITY) + 'px';
        }, 20)
    }*/

    //escribir function jump con sintaxis function arrow 
    let jump = () => {
        //metodo DOM : classList permite agregar o eliminar clase
        character.classList.add('character')
        character.classList.remove('character-sliding')

        //si ya esta saltando si isJumping = true no hace nada mas, evita saltar dos veces
        if (isJumping) return

        isJumping = true

        let timerUp = setInterval(() => {
            if (bottom >= MAXIMUM_HEIGHT){
                //detener salto, desactivar interval
                //console.log(timerUp)
                clearInterval(timerUp)
                //para que el cubo baje
                let timerDown = setInterval(() =>{
                    //controla que el cubo se detenga al bajar
                    if (bottom <=0){
                        //para que deje de ejecutarse la funcion que hace que baje el cubo
                        clearInterval(timerDown)
                        //cuando llega al suelo queda en false
                        isJumping = false
                    }
                    bottom -=5
                    character.style.bottom = bottom + 'px'
                },20)
             }
                 bottom += 30
                 character.style.bottom = (bottom * GRAVITY) + 'px';
        }, 20)
    }

    //
    function slideLeft() {
        //se agrega nueva clase y se elimina la anterior
        character.classList.add('character-sliding')
        character.classList.remove('character')

        if (isGoingRight){
            clearInterval(timerRight)
            isGoingRight = false
        }

        if (isGoingLeft) return
        isGoingLeft = true

        //let timerLeft = setInterval(() => {
        //usar variables como globales    
        timerLeft = setInterval(() => {
            left -= 5
            //desde la posic izquierda de la pantalla se disminuye 5 px
            //al presionar tecla  flecha izquierda, por lo que se desplaza  a la izquierda
            character.style.left = left + 'px'
        }, 20)
    }

    function slideRight() {
        character.classList.add('character-sliding')
        character.classList.remove('character')

        if (isGoingLeft){
            clearInterval(timerLeft)
            isGoingLeft = false
        }

        if (isGoingRight) return
        isGoingRight = true

        //let timerRight = setInterval(() => {
        timerRight = setInterval(() => {            
            left += 5
            //desde la posic izquierda de la pantalla se aunmenta 5 px
            //al presionar tecla  flecha derecha, por lo que se desplaza  a la derecha
            character.style.left = left + 'px'
        }, 20)
    }

    function slideDown() {
        character.classList.add('character')
        character.classList.remove('character-sliding')
        clearInterval(timerLeft)
        clearInterval(timerRight)
        isGoingRight = false
        isGoingLeft = false
        isGoingJumping = false
    }

    document.addEventListener('keydown',(event) =>{
        //console.log('aca!!')
        switch(event.keyCode){
            case KEY_UP:
                jump()
                break
            case KEY_LEFT:
                slideLeft()
                break    
            case KEY_RIGHT:
                slideRight()
                break    
            case KEY_DOWN:
                slideDown()
                break    
    
        }
    })
})