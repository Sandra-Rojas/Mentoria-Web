//instanciar objeto
kaboom({
    global: true,
    fullscreen: true,
    scale: 2,
    debug: true,
    clearColor: [0, 0, 0, 1]
})

loadSprite('brick','assets/brick.png')
loadSprite('coin','assets/coin.png')
loadSprite('evil-shroom','assets/evil-shroom.png')
loadSprite('block','assets/block.png')
loadSprite('mario','assets/mario.png')
loadSprite('mushroom','assets/mushroom.png')
loadSprite('surprise','assets/surprise-block.png')
loadSprite('unboxed', 'assets/unboxed.png')
loadSprite('pipe-top-left', 'assets/pipe-top-left.png')
loadSprite('pipe-top-right', 'assets/pipe-top-right.png')
loadSprite('pipe-bottom-left', 'assets/pipe-top-left.png')
loadSprite('pipe-bottom-right', 'assets/pipe-top-right.png') 

//cargar musica
loadSound('mario-theme', 'assets/super-mario-theme.ogg')

const MOVE_SPEED = 120
const ENEMY_SPEED = 20 //40
const MUSHROOM_SPEED = 30 //revisar 60
const JUMP_FORCE = 370
const JUMP_FORCE_BIG = 570 //revisar


let isJumping = false

scene("game", () => {
    layers(['bg', 'obj', 'ui'], 'obj')

    const map = [
        '                                                  ',
        '                                                  ',
        '                                                  ',
        '                                                  ',
        '                                                  ', 
        '                                                  ',
        '        %               |                  ^      ',
        '                                                  ',
        '                   ========                       ',
        '                                                  ',
        '     %    =*=%=                                   ',
        '                                                  ',
        '                                                  ',
        '                      -+      ^                   ',
        '                 ^       (  )           $         ',
        '==================================      ==========',
    ]

    //objeto se crea y se define al mismo tiempo
    const levelConfig = {
        width: 20,
        height: 20,
        '=': [sprite('brick'), solid()], //sprite imagenes a cargar
        '$': [sprite('coin'), 'coin'],
        '{': [sprite('mushroom'), 'mushroom', body()],//define boby , para que el hongo caiga cuando no tienen ninguna caja bajo ella
        '}': [sprite('unboxed'), solid()],
        '%': [sprite('surprise'), solid(), scale(0.5), 'coin-surprise'],
        '*': [sprite('surprise'), solid(), scale(0.5), 'mushroom-surprise'],
        '^': [sprite('evil-shroom'), solid(), 'dangerous'], 
        '-': [sprite('pipe-top-left'), scale(0.5), solid(),'pipe'],
        '+': [sprite('pipe-top-right'), scale(0.5), solid(), 'pipe'],
        '(': [sprite('pipe-bottom-left'), scale(0.5), solid(),],
        ')': [sprite('pipe-bottom-right'), scale(0.5), solid(),],
    }

    const gameLevel = addLevel(map, levelConfig)    

    const player = add([
        sprite('mario'),
        solid(),
        pos(30, 0),
        body(),
        big(), //define una funcion
        origin('bot')
    ])

    const music = play("mario-theme");

    //equivalente en php
    // class Mario{
    //     public function getBigger(){

    //     }
    // }

    function big(){
        //console.log('estamos en big')
        let isBig = false
        return{
            getBigger(){
                isBig = true
                //copia de sprite y aumenta tamaño vec2(1) =x=1, y=1
                this.scale = vec2(2)
            },
            isBig(){
                //this.scale = vec2(1)//revisar
                return isBig
            }
        }
    }

    keyDown('left', () => {
        //mueve a la izquierda eje x negativo, y=0
        player.move(-MOVE_SPEED, 0)
    })

    keyDown('right', () => {
        player.move(MOVE_SPEED, 0)
    })

    //salto
    keyDown('space', () => {
        //controla si mario está en el suelo, de lo contrario da doble salto
        if(player.grounded()){
            isJumping = true
            if (player.isBig()){
                player.jump(JUMP_FORCE_BIG)
            }else{
                player.jump(JUMP_FORCE)
            }    
        }
    })

    //al objeto player se le pueden asignar eventos con on
    //headpunch no resulta
    //player.on("headpunch", (obj) => {
    //headbump golpea cabezaso   
    player.on("headbump", (obj) => {
        //console.log(obj)
        //si golpea la caja de sorpresa. (sprite surprise)
        if (obj.is('coin-surprise')){
            //con gamelevel se puede agregar o eliminar sprite que estan en pantalla
            //gamelevel tiene toda la info 
            
            //con spawm llama al nuevo sprite, con $ aparece coin, 
            //se obtiene la pos del objeto y se reemplaza por la posocion 0, 1
            //1 es un nivel mas arriba (la moneda aparece sobre la caja)
            gameLevel.spawn('$', obj.gridPos.sub(0,1))
            //destruye el objeto que golpeo ejemplo caja sorpresa
            destroy(obj)
            //luego que destruye el objeto, aparece una caja solida
            gameLevel.spawn('}', obj.gridPos.sub(0,0))

        //si golpea la caja de sorpresa (sprite surprise)    
        }else if (obj.is('mushroom-surprise')){
            //hace aparecer el hongo, una posicion mas arriba que la caja de srpresa
            gameLevel.spawn('{', obj.gridPos.sub(0,1))
            //destruye la caja de sorpresa
            destroy(obj)
            //hace aparecer una caja solida
            gameLevel.spawn('}', obj.gridPos.sub(0,0))
        }
    })

    //si el jugador choca (dangerous son los pajaron)
    // Mario colisiona con birds
    player.collides('dangerous', (d) =>{
        //si esta saltando
        if (isJumping){
            //matamos al enemigo
            destroy(d)
        }else{
            //perdimos, choca de frente con birds
            //console.log('perdimos')   
            //va a la escena game_over que no tiene definido nada, pantalla en negro 
            go('game_over')
        }
    })

    //mario colisiona con hongo
    player.collides('mushroom', (d) => {
        //console.log('Mario crece')
        destroy(d) 
        player.getBigger()
    })
    

    // player.collides('coin', (d) => {
    //     //console.log('Mario crece')
    //     destroy(d)
    // })
    
    player.collides('coin', (d) => {
        destroy(d)
        player.getBigger()
    })

    //los bird se mueven a la izquierda
    action('dangerous', (b) => {
        b.move(-ENEMY_SPEED, 0)
    })

    //mover los hongos a la derecha
    action('mushroom', (b) => {
        b.move(MUSHROOM_SPEED, 0)
    })

})

//define una escenay ejecuta codigo que va ejecuatr, ahora sin nada, pantalla en negro
scene("game_over", () => {

})


start('game')
