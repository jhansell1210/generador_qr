!function() 
{
    document.addEventListener("DOMContentLoaded", ()=> {
        
        const form = document.getElementById("form")
        const form2 = document.getElementById("form2")
       
        
         if (form) empezar()
         else busquedaQR()

        function empezar() 
        {
            
            const url = document.getElementById("url")
            const nombre = document.getElementById("nombre")

            form.addEventListener("submit", (e)=> 
            {   
                const url2 = url.value.trim()
                const nombre2 = nombre.value.trim()
                e.preventDefault()
                if (url2 == "" || nombre2 == "") alert("escribe algo ctm");
                else generadorQR(url2,nombre2)   
            })
        }

        function generadorQR(url,nombre) 
        { 
            const img = document.getElementById("img")
            const contenedor = document.getElementById("contenedor") 
            const api = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${url}`
            img.src = api
            
            let datos = {
                nombre: nombre,
                url: api
            };

            fetch("./php/guardar_imagen.php", {
                method: 'POST', 
                body: JSON.stringify(datos)
            })
            .then(response => response.text() )
            .then(data => contenedor.innerHTML = data)
        }

    
        function busquedaQR() 
        {
            const Busqueda = document.getElementById("Busqueda")
           

            form2.addEventListener("submit", (e)=> 
            {   
                const Busqueda2= Busqueda.value.trim()
                e.preventDefault()
                if (Busqueda2 == "") alert("escribe algo ctm");
                else buscar(Busqueda2)   
            })     
        }

        function buscar(nombre) 
        {
         
            const img2 = document.getElementById("img2")
            const msg = document.getElementById("msg")
              msg.style.display = "none"
            let datos = {
                nombre: nombre
            };

             fetch("./php/buscar_imagen.php", {
                method: 'POST', 
                body: JSON.stringify(datos)
            })
            .then(response => response.text() )
            .then(data => {
               img2.src = data
               img2.alt = data
              
            })
        }
    })
}()