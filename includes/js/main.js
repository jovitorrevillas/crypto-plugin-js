(function($) { 
  $('.js-example-basic-multiple').select2({placeholder: "Select cryptocurrencies"}).prop("disabled", true);
  $('.select2-search__field').attr("placeholder", "");
  printLetter('Please wait...', $('.select2-search__field'), 0);
  let url = 'https://min-api.cryptocompare.com/data/all/coinlist'  
  let ticker = new XMLHttpRequest();
  getPrices();
  ticker.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {
            // setInterval(gotValue(this), 5000);
            gotValue(this)
    }
        
  }

  function printLetter(string, el, pH) {
    // split string into character seperated array
    var arr = string.split(''),
      input = el,
      // store full placeholder
      origString = string,
      phCount = pH,
      // get current placeholder value
      curPlace = $(input).attr("placeholder"),
      // append next letter to current placeholder
      placeholder = curPlace + arr[phCount];
      
    setTimeout(function(){
      // print placeholder text
      $(input).attr("placeholder", placeholder);
      // increase loop count
      phCount++;
      // run loop until placeholder is fully printed
      if (phCount < arr.length) {
        printLetter(origString, input, phCount);
      }
    // use random speed to simulate
    // 'human' typing
    }, 250);
  }  
  
  function getPrices(){
      ticker.open( 'GET', url, true );
      ticker.send();
      // alert('asdf')
  }
  function gotValue(a){
    let b1 = cryptoSymbols[0].split(',');
    let a1 = JSON.parse(a.responseText);
    var data = [];
    var cnt = 0;

    for(let i in a1.Data){
      if( b1.includes(a1.Data[i].Symbol) )
        data.push({id: a1.Data[i].Symbol, text: a1.Data[i].FullName, selected: true});
      else
        data.push({id: a1.Data[i].Symbol, text: a1.Data[i].FullName});
        cnt++;
    }
    
    $('.js-example-basic-multiple').select2({
      placeholder: "Select cryptocurrencies",
      data: data
    }).prop("disabled", false);
  }
})(jQuery);