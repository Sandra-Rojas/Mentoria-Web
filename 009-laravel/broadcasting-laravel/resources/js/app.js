require('./bootstrap');


    const listOrdenes = document.getElementById('listado-ordenes')

    const listMatriculas = document.getElementById('listado-matriculas')


window.Echo.channel('orders')
.listen('OrderStatusUpdated', (e) => {
    console.log(e)

    //cada vez que llegue evento de pusher se agregara un li con order
    var li = document.createElement("li")
    //li.appendChild(document.createTextNode("Un texto"))
    //li.appendChild(document.createTextNode(e.order.id + ' ' + e.order.product))
    li.appendChild(document.createTextNode(`${e.order.id} - ${e.order.product}`)) //otra forma de mostrar la info
    listOrdenes.appendChild(li)
    
    //otra opción con sentencia innerHTML se agrega una order
    listOrdenes.innerHTML += '<div class= "OrderStatusUpdated">' + e.order.id + e.order.product + ' con inner'+' </div>'
    
})

window.Echo.channel('matriculas')
.listen('MatriculaStatusUpdated', (e) => {
    console.log(e)

    //cada vez que llegue evento de pusher se agregara un li con matricula
    var li = document.createElement("li")
    li.appendChild(document.createTextNode(e.matricula.rut + ' ' + e.matricula.nombre))
    listMatriculas.appendChild(li)
    
    //otra opción con sentencia innerHTML se agrega una order
    //listMatriculas.innerHTML += '<div class= "MatriculaStatusUpdated">' + e.matricula.rut + e.matricula.nombre + ' con inner'+' </div>'
       
    
})