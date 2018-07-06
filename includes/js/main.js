! function(t){
  (function($) { 
  let url = 'https://min-api.cryptocompare.com/data/price'  
  let ticker = new XMLHttpRequest();
  getPrices();
  ticker.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {
            // setInterval(gotValue(this), 5000);
            gotValue(this)
    }
        
  }
  
  function getPrices(){
    var fsyms = 'fsym=USD',
        tsyms = 'tsyms=BTC,ETH,BCH';
      ticker.open( 'get', url + '?' + fsyms + '&' + tsyms, true );
      ticker.send();
      // alert('asdf')

  }
  function gotValue(a){
    let a1 = JSON.parse(a.responseText);
    var e = document.createElement("div");
    e.id = "ibx-calc-";
    for(let val in a1){
      console.log(val+'  '+(1 / a1[val]).toFixed(2))
    }
  }
})(jQuery);

  var e = t.createElement("div");
  e.id = "ibx-calc-", t.write(e.outerHTML);

  var i = document.getElementById("ibx-calc-"),
      n = i.previousElementSibling;
}(document);
