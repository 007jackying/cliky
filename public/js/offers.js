var pager = 1;
var retailer = document.querySelector('#retailer').value;
var department = document.querySelector('#department').value;
var type = document.querySelector('#type').value;
var price = document.querySelector('#price').value;
var discount = document.querySelector('#discount').value;
console.log(retailer);

function createOffer(data) {
    var wrapper = document.createElement('div');
    wrapper.className = 'col-lg-3 col-md-4 mb-4 col-sm-4 col-6';
    var card = document.createElement('card');
    card.className = 'card';
    var cardImage = document.createElement('div');
    cardImage.className = 'card-image';
    var item = document.createElement('div');
    item.className='item';
    var image_badge = document.createElement('a');
    image_badge.href = '#';
    var spanOfferBadge = document.createElement('span');
    spanOfferBadge.className='notify-badge';
    spanOfferBadge.textContent = data.discount_offer;
    var image = document.createElement('img');
    image.src=data.image_url;
    image.className="img-responsive lazy";
    image.alt = data.product;
    image_badge.appendChild(image);
    image_badge.appendChild(spanOfferBadge);
    item.appendChild(image_badge);
    cardImage.appendChild(item);
    card.appendChild(cardImage);
    wrapper.appendChild(card);
    var cardContent = document.createElement('card-content');
    var product = document.createElement('p');
    var productLink = document.createElement('a');
    productLink.href=data.offer_url;
    productLink.target = "_blank";
    var productLabel = document.createElement('span');
    productLabel.textContent = data.product;
    productLink.appendChild(productLabel);
    product.appendChild(productLink);
    cardContent.appendChild(product);
    var cardAction = document.createElement('div');
    cardAction.className = 'card-action';
    var currentPrice = document.createElement('p');
    currentPrice.textContent = 'Current Price: $'+data.current_price;
    cardAction.appendChild(currentPrice);
    var retailer = document.createElement('p');
    discount.textContent = 'Retailer: '+data.retailer;
    cardAction.appendChild(retailer);
    card.appendChild(cardContent);
    card.appendChild(cardAction);
    wrapper.appendChild(card);
    document.querySelector('#list-offers').appendChild(wrapper);
}

function updateUI(data) {
    for(var i = 0; i<data.length; i++){
        createOffer(data[i]);
    }
}
if(retailer || department || type || price || discount)
    //offerUrl = 'http://'+window.location.hostname+'/cliky/public/api/offers/'+retailer+'/'+department+'/'+type+'/'+price+'/'+discount+'?page='+pager;
    offerUrl = 'http://'+window.location.hostname+'/api/offers/'+retailer+'/'+department+'/'+type+'/'+price+'/'+discount+'?page='+pager;
    //offerUrl = 'http://'+window.location.hostname+'/api/offers?page=1';
else
    //offerUrl = 'http://localhost/cliky/public/api/offers?page='+pager;
    offerUrl = 'http://'+window.location.hostname+'/api/offers?page=1';
    //offerUrl = 'https://'+window.location.hostname+'/api/offers?page=1';
fetch(offerUrl, {
    headers: {
        'Accept': 'application/json'
    }
})
    .then(function (response) {
        return response.json();
    }).then(function (data) {
    return data.offers.data;
}).then(function (data) {
    var dataArray = [];
    for (var key in data) {
        dataArray.push(data[key]);
    }
    updateUI(dataArray);
}).catch(function (err) {
    console.log(err);
});
pager++;
console.log(offerUrl);

window.addEventListener('scroll',function(){
    var bodyRect = document.querySelector('body').getBoundingClientRect();
    if (bodyRect.bottom - window.innerHeight <= 40){
        if(retailer || department || type || price || discount)
            offerUrl = 'http://'+window.location.hostname+'/api/offers/'+retailer+'/'+department+'/'+type+'/'+price+'/'+discount+'?page='+pager;
            //offerUrl = 'http://'+window.location.hostname+'/cliky/public/api/offers/'+retailer+'/'+department+'/'+type+'/'+price+'/'+discount+'?page='+pager;
        else
            //offerUrl = 'http://localhost/cliky/public/api/offers?page='+pager;
            offerUrl = 'http://'+window.location.hostname+'/api/offers?page='+pager;
        // offerUrl = 'https://'+window.location.hostname+'/api/offers?page='+pager;
        fetch(offerUrl, {
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(function (response) {
                return response.json();
            }).then(function (data) {
            return data.offers.data;
        }).then(function (data) {
            var dataArray = [];
            for (var key in data) {
                dataArray.push(data[key]);
            }
            updateUI(dataArray);
        }).catch(function (err) {
            console.log(err);
        });
        pager++;
        console.log(offerUrl);
    }
}, true);