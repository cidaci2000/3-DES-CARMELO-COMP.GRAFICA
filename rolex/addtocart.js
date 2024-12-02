const product = [
    {
        id: 0,
        image: 'relogio.jpg',
        title: '<p class="caption">1/ROLEX aquarium SEGUNDA CLASSE </p>',
        price:  18.324,
    },
    {
        id: 1,
        image: 'bct.jpeg',
        title: '<p class="caption">2/ROLEX Ayrton Senna (edição unica)</p>',
        price:  280.324,
    },
    {
        id: 2,
        image: 'TEMPO.webp',
        title: '<p class="caption">3/ROLEX atemporal quantum  </p>',
        price:  34.568,
    },
    {
        id: 3,
        image: 'images1.jpeg',
        title: '<p class="caption">4/ROLEX la voiture</p>',
        price:  45.324,

    },
    {
        id: 4,
        image: 'family-yacht-master_portrait.webp',
        title: '<p class="caption">5/ROLEX brisa de verao </p>',
        price:  14.334,
    },
    
    {
        id: 5,
        image: 'images2.jpeg',
        title: '<p class="caption">6/ROLEX sombra da noite</p>',
        price: 123.439,
    }
   
   
];

const categories = [...new Set(product.map((item)=>
    {return item}))]
    let i=0;
document.getElementById('root').innerHTML = categories.map((item)=>
{
    var {image, title, price} = item;
    return(
        `<div class='box'>
        <div class='img-box'>
            <img class='images' src=${image}></img>
        </div>
    <div class='bottom'>
    <p>${title}</p>
    <h2>R$ ${price}.00</h2>`+
    "<button onclick='addtocart("+(i++)+")'>COMPRAR</button>"+
    `</div>
    </div>`
    )
}).join('')

var cart =[];

function addtocart(a){
    cart.push({...categories[a]});
    displaycart();
}
function delElement(a){
    cart.splice(a, 1);
    displaycart();
}

function displaycart(){
    let j = 0, total=0;
    document.getElementById("count").innerHTML=cart.length;
    if(cart.length==0){
        document.getElementById('cartItem').innerHTML = "Seu carrinho está vazio";
        document.getElementById("total").innerHTML = "R$ "+0+".00";
    }
    else{
        document.getElementById("cartItem").innerHTML = cart.map((items)=>
        {
            var {image, title, price} = items;
            total=total+price;
            document.getElementById("total").innerHTML = "R$ "+total+".00";
            return(
                `<div class='cart-item'>
                <div class='row-img'>
                    <img class='rowimg' src=${image}>
                </div>
                <p style='font-size:12px;'>${title}</p>
                <h2 style='font-size: 15px;'>R$ ${price}.00</h2>`+
                "<i class='fa-solid fa-trash' onclick='delElement("+ (j++) +")'></i></div>"
                
            );
        }).join('');
    }
    document.getElementById("cartItem").innerHTML += `<button onclick='createOrder(carrinho.php)'>Inserir Pedidos</button>`;
    
    fetch('config.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(pedidos)
      })
      .then(response => response.json())
      .then(data => {
        console.log('Pedido inserido com sucesso:', data);
        // Limpar o carrinho após o pedido ser inserido
        cart = [];
        displaycart();
      })
      .catch((error) => {
        console.error('Erro ao inserir pedido:', error);
        alert('Ocorreu um erro ao inserir o pedido. Por favor, tente novamente.');
      });
    };
   
    
    

